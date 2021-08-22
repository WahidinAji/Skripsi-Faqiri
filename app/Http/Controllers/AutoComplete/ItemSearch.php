<?php

namespace App\Http\Controllers\AutoComplete;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemSearch extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // $items = [];
        // if ($request->has('search')) {
        //     $search = $request->search;
        //     $items = Item::select('name', 'code')
        //         ->where('name', 'like', "${$search}")
        //         // ->where('code', 'like', "${$search}")
        //         ->orderBy('name', 'ASC')
        //         ->take(100)
        //         ->get();
        // }
        $items = DB::table('items')->orderBy('id', 'DESC')->get();
        return \response()->json($items);
    }
}
