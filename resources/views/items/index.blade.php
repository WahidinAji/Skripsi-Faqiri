@extends('layouts.main')
@section('title','Items')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/daterangepicker.css') }}" />
@section('style')
<style>
    i.text-success, i.text-secondary{
        font-size: x-large;
    }
</style>
@section('main-content')
{{-- <h1 class="h3 mb-4 text-gray-800">Items Page</h1> --}}
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
            <div class="col col-sm-7">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Items</h6>
            </div>
            <div class="col col-sm-5 text-right">
                <form action="{{ url()->current() }}">
                    <div class="form-row">
                        <div class="col col-md-7 text-right">
                            <input class="form-control form-control-sm" id="daterange" type="text" name="daterange" value="{{ request('daterange') }}"/>
                        </div>
                        <div class="col col-md-5 text-right">
                            <button type="submit" class="btn btn-sm btn-info">urutkan</button>
                            <a href="{{ route('items.index') }}" class="btn btn-sm btn-primary">clear</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr class="text-dark">
                    <th class="align-middle" scope="col">#</th>
                    <th class="align-middle" scope="col">Nama</th>
                    <th class="align-middle" scope="col">Kode</th>
                    <th class="align-middle" scope="col">Stock</th>
                    <th class="align-middl" scope="col">Harga <small><strong>Rp.</strong></small></th>
                    <th class="align-middl" scope="col">jenis</th>
                    <th class="align-middle text-center" scop5e="col">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="align-middle" scope="col">#</th>
                    <th class="align-middle text-center" scope="col" colspan="5">Barang</th>
                    <th class="align-middle text-center" scope="col">Action</th>
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
                        <a href="{{ route('items.edit',$item->id) }}" class="btn btn-sm btn-primary">
                            Edit
                        </a>
                        <form action="{{ route('items.destroy',$item->id) }}" class="btn btn-sm btn-transparent p-0 m-0" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger">Delete</button>
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
        <div class="row mt-2">
            <div class="col align-middle">
                <button type="button" class="btn btn-sm btn-success btn-circle p-0" data-toggle="modal" data-target="#myModal">
                    <i style="font-size: 170%" class="fas fa-plus-circle"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@include('items.modal')
@endsection
@push('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $('#daterange').daterangepicker();
    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        let startDate = picker.startDate.format('YYYY-MM-DD');
        let endDate = picker.endDate.format('YYYY-MM-DD')
        console.log(startDate);
        console.log(endDate);
    });
</script>
<script>
    $('#myModal').modal('enable')
</script>
<script>
    let x = document.querySelectorAll("#money");
    for (let i = 0, len = x.length; i < len; i++) {
        let num = Number(x[i].innerHTML)
                  .toLocaleString('ID');
        x[i].innerHTML = num;
        x[i].classList.add("currSign");
    }
</script>
@endpush
