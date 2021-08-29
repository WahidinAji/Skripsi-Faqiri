<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $items = Item::orderBy('id', 'DESC')->take(50)->get();
        if (\request()->has('daterange')) {
            $date = \explode("- ", \request('daterange'));
            $from = Carbon::parse($date[0])->format('Y-m-d H:i:s');
            $to = Carbon::parse($date[1])->format('Y-m-d H:i:s');
            $date1 = \date_create($from);
            $date2 = \date_create($to);
            $interval = \date_diff($date1, $date2);
            if ($interval->days > 30) {
                $days = $interval->days + 1;
                return \back()->with(['msg' => "anda menginput range waktu sebanyak $days hari, range waktu tidak boleh lebih dari 31 hari."]);
            }
            $items = Item::whereBetween('created_at', [$from, $to])->get();
        }
        return \view('items.index', \compact('items'));
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
        $item = Item::create($req->all());
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
        $item->update($req->all());
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
