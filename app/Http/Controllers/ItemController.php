<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('items')
            ->select(DB::raw('count(id) as id, category'))
            ->groupBy('category')
            ->get();
        $items = Item::select('id', 'code', 'name', 'price', 'type', 'stock')->get();
        if (\request()->has('category')) {
            $category = \request('category');
            $items = Item::where('category', $category)->select('id', 'code', 'name', 'price', 'type', 'stock')->get();
        }

        $arr = [
            0 => [
                'provider' =>'XL',
                'nomor' => 123,
            ],
            1 => [
                'provider' =>'XL',
                'nomor' => 123,
            ],
            3 => [
                'provider' =>'Telkomsel',
                'nomor' => 812,
            ],
            4 => [
                'provider' =>'Telkomsel',
                'nomor' => 812,
            ],
        ];
        return \view('items.index', \compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $req)
    {
        $code = strtolower($req->category[0]) .'-'.
                strtolower($req->name[0]) .'-'.
                strtolower($req->type[0]).'-'.
                date('ymdHi') . '_' .
                uniqid();

        $item = Item::create([
            'name'=>$req->name,
            'code'=>$code,
            'stock'=>$req->stock,
            'price'=>$req->price,
            'type'=>$req->type,
            'category'=>$req->category
        ]);
        return \redirect()->back()->with('msg', "Berhasil menambah barang $item->name");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return \view('items.edit', \compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return \view('items.edit', \compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $req, Item $item)
    {
        $item->update([
            'name'=>$req->name,
            'stock'=>$req->stock,
            'price'=>$req->price,
            'type'=>$req->type,
            'category'=>$req->category
        ]);
        return redirect()->route('items.index')->with('msg', "Berhasil merubah data barang $item->name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if (isset($item->transactions)) return back()->with('msg', "Tidak bisa menghapus barang $item->name, karena sudah ada transaksi");
        $item->delete();
        return back()->with('msg', "Berhasil menghapus data barang $item->name");
    }
}
