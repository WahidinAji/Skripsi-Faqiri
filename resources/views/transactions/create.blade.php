@extends('layouts.main')
@section('title','Transactions')
@section('main-content')
<form method="POST" action="{{ route('transactions.store') }}" id="form">
    @csrf
</form>
<div class="modal-content">
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new Transaction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="tambah">
            <div class="form-group row">
                <label for="item_id" class="col-sm-2 col-form-label pr-0">Nama Barang </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('item') is-invalid @enderror" id="item"  name="item_id" value="{{ old('item_id') }}" placeholder="{{ old('name') }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="code" class="col-sm-2 col-form-label pr-0">Kode Transaksi</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" value="{{ old('code') }}" name="code">
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label pr-0">Harga Barang</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price') }}" name="price">
                </div>
            </div>
            {{-- <fieldset class="scheduler-border">
                <legend class="w-auto">Detail transaksi</legend>
                <div class="form-group row">
                    <label for="item_id" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('item_id') is-invalid @enderror" id="item_id" value="{{ old('item_id') }}" name="item_id">
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-sm btn-success btn-circle p-0">
                            <i style="font-size: 170%" class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                </div>
            </fieldset> --}}

        </div>
        <div class="modal-footer pb-0">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>
</div>
@endsection
@push('script')
<script>
    $( function() {
        var projects = "{{ route('items.search') }}";

      $( "#item" ).autocomplete({
        minLength: 0,
        source: projects,
        focus: function( event, ui ) {
          $( "#item" ).val( ui.item.name );
          return false;
        },
        select: function( event, ui ) {
          $( "#item" ).attr('placeholder', ui.item.name );
          $( "#item" ).attr('value', ui.item.id );
          $( "#item_id" ).val( ui.item.id );
          $( "#price" ).val( ui.item.price );
          $( "#code" ).val( ui.item.code );

          return false;
        }
      })
      .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
          .append( "<div>" + item.name + "<br>" + item.code + "<br>" + item.price + "</div>" )
          .appendTo( ul );
      };
    } );
</script>
<script>
    $(document).ready(function(){
        var count = 1;
        dynamic_field(count);
        function dynamic_field(number){
            html = '<div class="form-group row" id="row">';
            html += `<label for="staticEmail" class="col-sm-2 col-form-label">Email</label>`;
            html += `
            <div class="col-sm-9">
                <input type="text" class="form-control" id="staticEmail" value="email@example.com">
            </div>`;
            if (number > 1) {
                html += `
                <div class="col-sm-1" id="btn2">
                    <button type="button" name="remove" id="" class="btn btn-danger removing">Remove</button>
                </div>
                `;
                $('#form').append(html);
            }
            else{
                html +=`
                <div class="col-sm-1">
                    <button type="button" name="adding" id="adding" class="btn btn-success">Add</button></td>
                </div>
                `;
                $('#form').html(html);
            }
        }
        $(document).on('click','#adding', function(){
            count++;
            dynamic_field(count);
        });
        $(document).on('click', '.removing', function () {
            count--;
            $(this).closest("#row").remove();
        });
    });

</script>
@endpush
