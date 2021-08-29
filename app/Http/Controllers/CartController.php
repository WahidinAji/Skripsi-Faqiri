<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::take(100)->paginate(10);
        $carts = Cart::with('items')->where('status', '0')->get();
        $sum = Cart::select(DB::raw("sum(IF(status = '0',price,0)) as sum"))->get();
        return \view('create', \compact('items', 'carts', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Item::where('id', $request->item_id)->first();
        if ($request->total > $item->stock || $request->total == '0' || $request->total == null) return back()->with('msg', 'Tidak boleh lebih dari stock atau 0 atau kosong');
        DB::beginTransaction();
        try {
            $cart = new Cart();
            $cart->item_id = $item->id;
            $cart->price = $item->price;
            $cart->name = $item->name;
            $cart->total = $request->total;
            $cart->status = '0';
            $item->stock = $item->stock - $request->total;
            $cart->save();
            $item->save();
            DB::commit();
            return \back()->with('msg', 'Succcess');
        } catch (Exception $e) {
            DB::rollBack();
            return \back()->with('msg', 'Something Went Wrong!, tidak berhasil merubah data!!' . $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
