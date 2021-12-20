@extends('layouts.main')
@section('title','Transactions')
@section('main-content')
<div class="row">
    {{-- @foreach ($transaction->carts as $cart)
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Categori : {{ ucfirst($cart->items->category) }}</h5>
                <table class="table table-sm table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">nama</th>
                            <th scope="col">kode</th>
                            <th scope="col">harga</th>
                            <th scope="col">tipe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $cart->items->name }}</td>
                            <td>{{ $cart->items->code }}</td>
                            <td>{{ $cart->items->price }}</td>
                            <td>{{ $cart->items->type }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="#" class="btn btn-primary">{{ $cart->code }}</a>
            </div>
        </div>
    </div>
    @endforeach --}}
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col">
                        <h5>Kode transaksi : {{ $transaction->code }}</h5>
                    </div>
                    <div class="col">
                        <h5>Pembayaran : Rp. {{ number_format($transaction->paying, 2, ',', '.') }}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>Harga total : Rp. {{ number_format($transaction->price_total, 2, ',', '.') }}</h5>
                    </div>
                    <div class="col">
                        <h5>Kembalian : Rp. {{ number_format($transaction->refund, 2, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card mt-2">
                            <div class="card-body">
                                <h5 class="card-title">Transaksi</h5>
                                <table class="table table-sm table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">kategory</th>
                                            <th scope="col">harga</th>
                                            <th scope="col">jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction->carts as $cart)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cart->items->category }}</td>
                                            <td>{{ number_format($cart->price, 2, ',', '.') }}</td>
                                            <td>{{ $cart->total }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card mt-2">
                            <div class="card-body">
                                <h5 class="card-title">Barang</h5>
                                <table class="table table-sm table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">nama</th>
                                            <th scope="col">kode</th>
                                            <th scope="col">harga</th>
                                            <th scope="col">tipe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction->carts as $cart)""
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cart->items->name }}</td>
                                            <td>{{ $cart->items->code }}</td>
                                            <td>{{ number_format($cart->items->price, 2, ',', '.') }}</td>
                                            <td>{{ $cart->items->type_label }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('transactions.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
    {{-- {{ $transaction->carts }} --}}
    {{-- <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Featured
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                    </ul>
                </div>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div> --}}
</div>
@endsection
