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
     * $transactions = Transaction::select(DB::raw("count('id') as id, MONTH(date) month_, YEAR(date) as year_, sum(price_total) as price"))->groupBy('month_', 'year_');
     *  $years = Transaction::select(DB::raw("count('id') as id, YEAR(date) as year_"))->groupBy('year_')->get();
     *  if (\request()->has('years')) {
     *      $year = \request('years');
     *      $transactions = $transactions->whereYear('date', $year);
     *  } else {
     *      $transactions = $transactions->whereYear('date', 2021);
     *  }
     *  $transactions = $transactions->get();
     */
    public function index()
    {
        $transactions = Transaction::select(DB::raw("count('id') as total, MONTH(date) month_, YEAR(date) as year_, sum(price_total) as price"))->groupBy('month_', 'year_');
        $days = Transaction::select('id', 'code', 'price_total', 'date')->orderBy('updated_at', 'desc');
        $years = Transaction::select(DB::raw("count('id') as id, YEAR(date) as year_"))->groupBy('year_')->get();
        if (\request()->has('years')) {
            $year = \request('years');
            $transactions = $transactions->whereYear('date', $year);
            $days = $days->whereYear('date', $year);
        } else {
            $transactions = $transactions->whereYear('date', 2021);
            $days = $days->whereYear('date', 2021);
        }
        $transactions = $transactions->get();
        $days = $days->get();
        return \view('transactions.index', \compact('transactions',  'years', 'days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * * Menu Carts proses setelah selesai, barang masuk ke laporan Dashboard.
     */
    public function store(TransactionRequest $req)
    {
        if (empty($req->price_total)) {
            return back()->with('msg', 'Silahkan tambah barang terlebih dahulu!!');
        }
        if ($req->paying < $req->price_total) {
            return back()->with('msg', 'Uang yang dibayarkan harus sama dengan atau lebih besar dari total harga!!');
        }
        $code = \str_replace('.00', '', $req->price_total) . '_' . \date('Hi') . '_' . \uniqid();
        DB::beginTransaction();
        try {
            DB::table('carts')->where('status', '0')->update(['code' => $code]);
            DB::table('carts')->update(['status' => '1']);
            $transaction = Transaction::create([
                'code' => $code,
                'date' => \now(),
                'price_total' => $req->price_total,
                'paying' => $req->paying,
                'refund' => $req->refund ?? '0',
                'user_id' => \auth()->user()->getAuthIdentifier()
            ]);
            DB::commit();
            return \back()->with('msg', "Berhasil melakukan transaksi dengan kode transaksi $transaction->code");
        } catch (Exception $e) {
            DB::rollBack();
            return \back()->with('msg', 'Something Went Wrong!, tidak berhasil merubah data!!' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        // \dd($transaction->carts);
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return back();
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
