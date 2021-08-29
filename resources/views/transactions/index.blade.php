@extends('layouts.main')
@section('title','Transactions')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/daterangepicker.css') }}" />
<style>
    i.text-success, i.text-secondary{
        font-size: x-large;
    }
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
                box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
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
                <h6 class="m-0 font-weight-bold text-primary">DataTables Transactions</h6>
            </div>
            <div class="col col-sm-5 text-right">
                <form action="{{ url()->current() }}">
                    <div class="form-row">
                        <div class="col col-md-7 text-right">
                            <input class="form-control form-control-sm" id="daterange" type="text" name="daterange" value="{{ request('daterange') }}"/>
                        </div>
                        <div class="col col-md-5 text-right">
                            <button type="submit" class="btn btn-sm btn-info">urutkan</button>
                            <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-primary">clear</a>
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
                    <th class="align-middle" scope="col">Kode</th>
                    <th class="align-middle" scope="col">Kode</th>
                    <th class="align-middle" scope="col">Tanggal</th>
                    <th class="align-middl" scope="col">Harga <small>(Rp.)</small></th>
                    <th class="align-middl" scope="col">Jumlah</th>
                    <th class="align-middle text-center" scop5e="col">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="align-middle" scope="col">#</th>
                    <th class="align-middle" scope="col">Barang</th>
                    <th class="align-middle" scope="col" colspan="2">Transaksi</th>
                    <th class="align-middle" scope="col" colspan="2">Total</th>
                    <th class="align-middle text-center" scope="col">Action</th>
                </tr>
            </tfoot>
            <tbody>
                @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->items->code }}</td>
                    <td>{{ $transaction->code }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td id="money">{{ $transaction->price_total }}</td>
                    <td>{{ $transaction->items_total }}</td>
                    <td class="text-center">
                        {{-- <a href="{{ route('items.edit',$transaction->id) }}" class="btn btn-sm btn-primary">
                            Edit
                        </a>
                        <form action="{{ route('items.destroy',$transaction->id) }}" class="btn btn-sm btn-transparent p-0 m-0" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form> --}}
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Toggle</label>
                        </div>
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
                <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-danger btn-circle p-0">
                    <i style="font-size: 170%" class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>

        <div id="project-label">Select a project (type &quot;j&quot; for a start):</div>
<img id="project-icon" src="images/transparent_1x1.png" class="ui-state-default" alt>
<input id="project">
<input type="hidden" id="project-id">
<p id="project-description"></p>

    </div>
</div>
@include('transactions.modal')
@endsection
@push('script')
<script>
    $( function() {
      var projects = [
        {
          value: "jquery",
          label: "jQuery",
          desc: "the write less, do more, JavaScript library",
          icon: "jquery_32x32.png"
        },
        {
          value: "jquery-ui",
          label: "jQuery UI",
          desc: "the official user interface library for jQuery",
          icon: "jqueryui_32x32.png"
        },
        {
          value: "sizzlejs",
          label: "Sizzle JS",
          desc: "a pure-JavaScript CSS selector engine",
          icon: "sizzlejs_32x32.png"
        }
      ];

      $( "#project" ).autocomplete({
        minLength: 0,
        source: projects,
        focus: function( event, ui ) {
          $( "#project" ).val( ui.item.label );
          return false;
        },
        select: function( event, ui ) {
          $( "#project" ).val( ui.item.label );
          $( "#project-id" ).val( ui.item.value );
          $( "#project-description" ).html( ui.item.desc );
          $( "#project-icon" ).attr( "src", "images/" + ui.item.icon );

          return false;
        }
      })
      .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
          .append( "<div>" + item.label + "<br>" + item.desc + "</div>" )
          .appendTo( ul );
      };
    } );
</script>
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
<script>
//     var baseElement = document.querySelector("p");
// document.getElementById("output").innerHTML =
//   (baseElement.querySelector("div span").innerHTML);
</script>
@endpush
