@extends('layouts.main')
@section('title','Item edit')
@section('main-content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $item->name }}</h6>
    </div>
    <div class="card-body">
        <form enctype="multipart/form-data" method="POST" action="{{ route('items.update',$item->id) }}">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label for="code" class="col-sm-2 col-form-label">Kode Barang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" id="code" value="{{ old('code') ? old('code') : $item->code }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name Barang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') ? old('name') : $item->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Harga Barang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price') ? old('price') : $item->price }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="stock" class="col-sm-2 col-form-label">Stock Barang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" value="{{ old('stock') ? old('stock') : $item->stock }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('category') is-invalid @enderror" name="category" id="category" value="{{ old('price') ? old('category') : $item->category }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputType" class="col-sm-2 col-form-label @error('type') is-invalid @enderror">Tipe Barang</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="exampleRadios1" value="box" {{ $item->type == 'unit' ? 'box' : 'checked' }}>
                        <label class="form-check-label" for="exampleRadios1">
                          Box
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="exampleRadios2" value="unit" {{ $item->type == 'box' ? 'unit' : 'checked' }}>
                        <label class="form-check-label" for="exampleRadios2">
                          Satuan
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">
                    <a href="{{ route('items.index') }}" class="btn btn-outline-primary">Cancel</a>
                </div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-outline-success">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if($errors->any())
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
@endif

@endsection
@push('script')
<script>
    $(document).ready(function(){
        $("#myModal").modal('show');
    });
</script>
@endpush

