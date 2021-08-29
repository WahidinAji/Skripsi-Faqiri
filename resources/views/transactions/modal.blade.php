<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                        <label for="code" class="col-sm-2 col-form-label pr-0">Kode Transaksi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" value="{{ old('code') }}" name="code">
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
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
                    </fieldset>
                </div>
                <div class="modal-footer pb-0">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>
    let i =1;
    function create(){
        var item_id = document.getElementById("item_id");
        item_id.setAttribute("name", "item_id[]");
        var y = document.createElement("div");
        y.setAttribute("class","form-group");
        y.innerHTML =
        `
        <input type="text" class="form-control @error('item_id') is-invalid @enderror" id="item_id" value="{{ old('item_id') }}" name="item_id">
        `;
    }
</script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
<script>
    // var req = new XMLHttpRequest();
    // req.open('GET','/transactions',true);
    // req.onload = function(){
    //     if (this.status >= 200 && this.status < 400) {
    //         // Success!
    //         var resp = this.response;
    //     } else {
    //         // We reached our target server, but it returned an error
    //     }
    // }
    //     req.onerror = function() {
    // // There was a connection error of some sort
    // };

    // req.send();
    // function isi_otomatis() {
    //     var code = $("#code").val();
    //     $.ajax({
    //         url: {!! route('transactions.index') !!},
    //         data:"code="+code ,
    //     }).success(function (data) {
    //         var json = data,
    //         obj = JSON.parse(json);
    //         $('#name').val(obj.name);
    //     });
    // }
</script>
@endpush
