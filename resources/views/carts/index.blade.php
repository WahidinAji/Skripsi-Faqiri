@extends('layouts.main')
@section('title','Carts')
@section('style')
<style>
    i.text-success, i.text-secondary{
        font-size: x-large;
    }
    /* input#paying {
        width: 21%;
    } */
</style>
@section('main-content')
@if($errors->any())
<div class="row align-items-start m-0">
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show mr-2" role="alert" aria-live="polite" aria-atomic="true"  data-delay="50000">
        {{ $error }}
        <div type="button" class="close" data-dismiss="alert">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-backspace-fill"
                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2V3zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8 5.829 5.854z" />
            </svg>
        </div>
    </div>
    @endforeach
</div>
@endif
<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class="col col-sm-7 mt-2">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Items</h6>
            </div>
            <div class="col col-sm-5 text-right">
                <form action="{{ url()->current() }}">
                    <div class="form-row">
                        <div class="col col-md-7 text-right">
                            <select name="category" id="category" class="form-control form-control-sm">
                                @foreach ($categories as $c)
                                <option value="{{ $c->category }}" {{ $c->category == request('category') ? "selected" : null }}>{{ $c->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col col-md-5 text-right">
                            <button type="submit" class="btn btn-sm btn-info">urutkan</button>
                            <a href="{{ route('carts.index') }}" class="btn btn-sm btn-primary">clear</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
    <div class="card-body">
        <table class="table table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr class="text-dark">
                    <th class="align-middle" scope="col">#</th>
                    <th class="align-middle" scope="col">Nama</th>
                    <th class="align-middle" scope="col">Kode</th>
                    <th class="align-middle" scope="col">Stock</th>
                    <th class="align-middl" scope="col">Harga <small><strong>Rp.</strong></small></th>
                    <th class="align-middl" scope="col">jenis</th>
                    <th class="align-middle text-center" scop5e="col">Jumlah</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="align-middle" scope="col">#</th>
                    <th class="align-middle text-center" scope="col" colspan="6">Barang</th>
                </tr>
            </tfoot>
            <tbody>
                @forelse ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->stock }}</td>
                    <td id="money">{{ $item->price }}</td>
                    <td>
                        @if($item->type == 'unit')
                        satuan
                        @else
                        box
                        @endif
                    </td>
                    <td class="text-center">
                        <form action="{{ route('carts.store') }}" class="btn btn-sm btn-transparent p-0 m-0" method="POST">
                            @csrf
                            <input type="number" class="form-contro form-control-sm" name="total" placeholder="input jumlah" max="{{ $item->stock }}" maxlength="{{ $item->stock }}">
                            <input type="hidden" value="{{ $item->id }}" name="item_id">
                            <button type="submit" class="btn btn-sm btn-primary">Add</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Data kosong!!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <table class="table table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr class="text-dark">
                    <th class="align-middle" scope="col">#</th>
                    <th class="align-middle" scope="col">Nama</th>
                    <th class="align-middle" scope="col">Harga <small><strong>Rp.</strong></small></th>
                    <th class="align-middle" scope="col">Jumlah</th>
                    <th class="align-middle" scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($carts as $cart)
                <tr>
                    <td width="5%">{{ $loop->iteration }}</td>
                    <td>{{ $cart->items->name }}</td>
                    <td id="money">{{ $cart->price }}</td>
                    <form action="{{ route('carts.update',$cart->id) }}" class="btn btn-sm btn-transparent p-0 m-0" method="POST">
                        <td width="10%">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="{{ $cart->items->id }}" name="item_id">
                            <input type="number" class="form-control form-control-sm" value="{{ $cart->total }}" name="total">
                        </td>
                        <td class="m-0" width="12%">
                            <button type="submit" class="btn btn-sm btn-outline-warning">Update jumlah</button>
                        </td>
                    </form>
                    <td>
                        <form action="{{ route('carts.destroy',$cart->id) }}" class="btn btn-sm btn-transparent p-0 m-0" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" onclick="return confirm('Apakah anda yakin ingin mengahapus barang?')" class="btn btn-sm btn-outline-danger">Hapur barang</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Kosong</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    @foreach ($sum as $cart)
                    <tr>
                        <th colspan="2"><strong>Total Harga</strong></th>
                        <th colspan="4"><strong id="money">{{ $cart->sum }}</strong></th>
                    </tr>
                    <tr>
                        <th colspan="2"><strong>Dibayarkan</strong></th>
                        <th width="15%">
                            <input type="number" class="form-control form-control-sm @error('paying') is-invalid @enderror" value="{{ old('paying') }}" name="paying" id="cash">
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2"><strong>Dikembalikan</strong></th>
                        <th width="15%">
                            <input type="number" class="form-control form-control-sm" name="refund" id="kembalian" readonly>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">
                            <input type="hidden" name="price_total" value="{{ $cart->sum }}" id="price_total">
                            <button onclick="return confirm('Selesaikan transaksi?')" class="btn btn-sm btn-success">Selesai</button>
                        </th>
                    </tr>
                    @endforeach
                </form>
            </tfoot>
        </table>
    </div>
</div>
@endsection
@push('script')
<script>
    let x = document.querySelectorAll("#money");
    for (let i = 0, len = x.length; i < len; i++) {
        let num = Number(x[i].innerHTML)
                  .toLocaleString('ID');
        x[i].innerHTML = num;
        x[i].classList.add("currSign");
    }
    $("#cash").keyup(function (e) {
        e.preventDefault();
        let pricetotal = $("#price_total").val();
        let cash = $("#cash").val();

        kembalian = cash - pricetotal;

       if(kembalian)
       {
            $("#kembalian").val(kembalian);
       }
    });
</script>
@endpush
