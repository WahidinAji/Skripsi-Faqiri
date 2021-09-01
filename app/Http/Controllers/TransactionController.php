<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
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
        // $transactions = Transaction::select(DB::raw("count('id')"))->groupBy('code')->take(5)->get();
        // $transactions = Transaction::with('items')->orderBy('id', 'DESC')->take(10)->get();
        if (\request()->has('daterange')) {
            $date = \explode("- ", \request('daterange'));
            $from = \date_create(Carbon::parse($date[0])->format('Y-m-d H:i:s'));
            $to = \date_create(Carbon::parse($date[1])->format('Y-m-d H:i:s'));
            $interval = \date_diff($from, $to);
            if ($interval->days > 30) {
                $days = $interval->days + 1;
                return \back()->with(['msg' => "anda menginput range waktu sebanyak $days hari, range waktu tidak boleh lebih dari 31 hari."]);
            }
            $transactions = Transaction::with('items')->whereBetween('created_at', [$from, $to])->get();
        }
        
        $transactions = Transaction::select(DB::raw("count('id') as id, MONTH(date) month_, sum(price_total) as price"))->groupBy('month_')->get();
        $trans = Transaction::select(DB::raw("count('id') as id, MONTH(date) month_, YEAR(date) as year_, sum(price_total) as price"))->groupBy('month_', 'year_')->get();
        return \view('transactions.index', \compact('transactions', 'trans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $code = \str_replace('.00', '', $req->price_total) . '_' . \date('Hi') . '_' . \uniqid();
        // $code = \hash('md5', $replace);
        // \dd($code, $replace);
        DB::beginTransaction();
        try {
            DB::table('carts')->where('status', '0')->update(['code' => $code]);
            DB::table('carts')->update(['status' => '1']);
            $transaction = Transaction::create([
                'code' => $code,
                'date' => \now(),
                'price_total' => $req->price_total,
                'user_id' => \auth()->user()->getAuthIdentifier()
            ]);
            DB::commit();
            return \back()->with('msg', "Berhasil melakukan transaksi dengan kode transaksi $transaction->code");
        } catch (Exception $e) {
            DB::rollBack();
            return \back()->with('msg', 'Something Went Wrong!, tidak berhasil merubah data!!' . $e);
        }
    }
    public function store1(TransactionRequest $req)
    {
        \dd($req->all());
        /*
            $var = array(
                0 => 1,
                1 => 4
            );
            $sum = 0;
            foreach ($var as $value) {
                # code...
                $item = DB::table('items')->where('id', $value)->get();
                // \dd(array_sum($item->price));
                // $sum = 0;
                // foreach ($item as $a) {
                //     // $v = $a->price;
                //     // \dd(array_sum($v));
                //     $sum += $a->price;
                //     \dd($sum);
                // }
                // \dd($item);
                // dd($item[0]->price);
                // echo $item;
                \dump($item);
                // \var_dump($item);
            }
            \dd($item);
        */

        // \dd(array_sum($req->price));
        $item_id = $req->item_id;
        // if (\is_array($item_id)) {
        //     foreach ($item_id as $var) {
        //         \dd("array", \array_sum($var));
        //     }
        // }
        // \dd("bukan array");
        $sum = 0;
        // $item = DB::table('items')->where('id', $item_id)->get();
        // foreach ($item as $key => $val) {
        //     // \dd($val->price);
        //     $a = $sum += $val->price;
        //     \dd($a);
        // }

        if (\is_array($item_id)) {
            foreach ($item_id as $value) {
                $item = DB::table('items')->where('id', $item_id)->get();
                foreach ($item as $key => $value) {
                    // $v = int $value->price;
                    $transaction = Transaction::create([
                        'item_id' => $value,
                        'code' => $req->code,
                        'date' => \now(),
                        'price_total' => $value->price,
                        'items_total' => \rand(1, 5)
                    ]);
                }
            }
            return \back()->with('msg', "Berhasil melakukan transaksi dengan code transaksi $transaction->code");
        }
        $transaction = Transaction::create([
            'item_id' => $item_id,
            'code' => $req->code,
            'date' => \now(),
            'price_total' => \rand(30000, 40000),
            'items_total' => \rand(1, 5)
        ]);
        return \back()->with('msg', "Berhasil melakukan transaksi dengan code transaksi $transaction->code");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return \view('transaction.edit', \compact('trasnsaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return \view('transaction.edit', \compact('trasnsaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $req, Transaction $transaction)
    {
        if ($transaction->status == 1) return \back()->with('msg', 'Transaksi sudah di selesai, tidak boleh diubah');
        $transaction->update($req->all());
        return \redirect()->route('transactions.index')->with('msg', 'Berhasil memperbaharui data transaksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return \back()->with('msg', 'Berhasil menghapus data transaksi');
    }
}
