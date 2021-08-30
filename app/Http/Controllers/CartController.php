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
        $items = Item::all();
        $carts = Cart::with('items')->where('status', '0')->get();
        $sum = Cart::select(DB::raw("sum(IF(status = '0',price,0)) as sum"))->get();
        return \view('carts.index', \compact('items', 'carts', 'sum'));
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
        $invalid = $request->total > $item->stock || $request->total <= '0' || $request->total == null;
        if ($invalid) return back()->with('msg', 'Tidak boleh lebih dari stock, 0, kosong atau minus');
        $item_id = Cart::where('item_id', $request->item_id)->where('status', '0')->first(); //check if id is already or not, include condition where status is 0
        DB::beginTransaction();
        try {
            $cart = new Cart();
            $cart->item_id = $item->id;
            $cart->name = $item->name;
            $cart->status = '0';
            $item->stock = $item->stock - $request->total;
            $total = $request->total;
            if (isset($item_id)) {
                //total updating if $team_id is true
                $total = $item_id->total + $request->total;
                $item_id->price = $item->price * $total; //sum price of total
                $item_id->total = $total;
                $item_id->save();
                $item->save();
                DB::commit();
                return \back()->with('msg', 'Success update stock');
            }
            $cart->price = $item->price * $request->total;
            $cart->total = $total;
            $cart->save();
            $item->save();
            DB::commit();
            return \back()->with('msg', 'Success to add item');
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
        return \back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        return \back();
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
        $total_cart = $cart->items->stock + $cart->total;
        $invalid = $request->total > $total_cart || $request->total == $cart->total || $request->total == null || $request->total <= '0';
        if ($invalid) return back()->with('msg', 'Tidak boleh melebihi stock!!');
        DB::beginTransaction();
        try {
            $cart->total = $request->total;
            $cart->items->stock = $total_cart - $request->total;
            $cart->price = $cart->items->price * $request->total;
            $cart->save();
            $cart->items->save();
            DB::commit();
            return back()->with('msg', 'Berhasil memperbaharui jumlah barang!!');
        } catch (Exception $e) {
            DB::rollBack();
            return \back()->with('msg', 'Something Went Wrong!, tidak berhasil merubah data!!' . $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        if ($cart->status == '1') return back()->with('msg', 'Tidak boleh dihapus!!');
        DB::beginTransaction();
        try {
            $stock = $cart->total + $cart->items->stock;
            $cart->items->stock = $stock;
            $cart->items->save();
            $cart->delete();
            DB::commit();
            return \back()->with('msg', 'Berhasil menghapus barang!!');
        } catch (Exception $e) {
            DB::rollback();
            return \back()->with('msg', 'Something Went Wrong!, tidak berhasil menghapus data!!' . $e);
        }
    }
}
