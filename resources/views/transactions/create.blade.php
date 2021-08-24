@extends('layouts.main')
@section('title','Transactions')
@section('style')
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@section('main-content')
<div class="container">
    <form action="{{ route('transactions.store') }}" id="form2">
        @csrf
    </form>
</div>

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
                    <input type="text" class="form-control @error('item') is-invalid @enderror" id="item" name="item_id"
                        value="{{ old('item_id') }}" placeholder="{{ old('name') }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="code" class="col-sm-2 col-form-label pr-0">Kode Transaksi</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                        value="{{ old('code') }}" name="code">
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label pr-0">Harga Barang</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                        value="{{ old('price') }}" name="price">
                </div>
            </div>
            {{-- <fieldset class="scheduler-border">
                <legend class="w-auto">Detail transaksi</legend>
                <div class="form-group row">
                    <label for="item_id" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('item_id') is-invalid @enderror" id="item_id" value="{{ old('item_id') }}"
            name="item_id">
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
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
@push('script')
<script>
    $(document).ready(function () {
        var count = 1;
        dynamic_field(count);
        function dynamic_field(number) {
            html = '<div class="form-group row" id="row_form">';
            html += `<label for="item_id" class="col-sm-2 col-form-label pr-0">Nama Barang </label>`;
            html += `
            <div class="col-sm-4">
                <select class="js-example-data-ajax form-control" id="name" name="name[]">
                </select>
            </div>
            <div class="col-sm">
                <input type="text" id="desc" class="form-control form-control-sm" name="desc[]">
            </div>
            <div class="col-sm">
                <input type="text" id="link" class="form-control form-control-sm" name="link[]">
            </div>`;
            if (number > 1) {
                html += `
                <div class="col-sm">
                    <button type="button" name="remove" id="remove" class="btn btn-danger">Remove</button>
                </div>
                `;
                $('#form2').append(html);
            } else {
                html += `
                <div class="col-sm">
                    <button type="button" name="adding" id="add" class="btn btn-success">Add</button></td>
                </div>
                `;
                $('#form2').html(html);
            }
        }
        $(document).on('click', '#add', function () {
            count++;
            dynamic_field(count);
        });
        $(document).on('click', '#remove', function () {
            count--;
            $(this).closest("#row_form").remove();
        });
        $(".js-example-data-ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Search for a repository',
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });

        function formatRepo(repo) {
            if (repo.loading) {
                return repo.text;
            }
            var $container = $(
                '<p>'+repo.full_name+'</p>'
            );
            return $container;
        }

        function formatRepoSelection(repo) {
            $(`#name`).val(repo.full_name);
            $(`#desc`).val(repo.description);
            $(`#link`).val(repo.id);
            return repo.full_name || repo.text;
        }
    });
</script>
<script>
    function formatState (state) {
    if (!state.id) {
        return state.text;
    }
    var baseUrl = "/user/pages/images/flags";
    var $state = $(
        '<span><img class="img-flag" /> <span></span></span>'
    );

    // Use .text() instead of HTML string concatenation to avoid script injection issues
    $state.find("span").text(state.text);
    $state.find("img").attr("src", baseUrl + "/" + state.element.value.toLowerCase() + ".png");

    return $state;
    };
    $(".js-example-data-ajax2").select2({
        templateSelection: formatState
    });
</script>
{{-- <script>
    $(".js-example-data-ajax").select2({
        ajax: {
            url: "https://api.github.com/search/repositories",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        placeholder: 'Search for a repository',
        minimumInputLength: 1,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    function formatRepo(repo) {
        if (repo.loading) {
            return repo.text;
        }

        // var $container = $(
        //     "<div class='select2-result-repository clearfix'>" +
        //     "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
        //     "<div class='select2-result-repository__meta'>" +
        //     "<div class='select2-result-repository__title'></div>" +
        //     "<div class='select2-result-repository__description'></div>" +
        //     "<div class='select2-result-repository__statistics'>" +
        //     "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> </div>" +
        //     "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> </div>" +
        //     "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> </div>" +
        //     "</div>" +
        //     "</div>" +
        //     "</div>"
        // );

        // $container.find(".select2-result-repository__title").text(repo.full_name);
        // $container.find(".select2-result-repository__description").text(repo.description);
        // $container.find(".select2-result-repository__forks").append(repo.forks_count + " Forks");
        // $container.find(".select2-result-repository__stargazers").append(repo.stargazers_count + " Stars");
        // $container.find(".select2-result-repository__watchers").append(repo.watchers_count + " Watchers");

        var $container = $(
            '<p>'+repo.full_name+'</p>'
        );

        return $container;
    }

    function formatRepoSelection(repo) {
        $( ".test" ).val(repo.full_name);
        $( ".test2" ).val(repo.description);
        $( ".test3" ).val(repo.id);
        return repo.full_name || repo.text;
    }

</script> --}}
<script>
    $(function () {
        var projects = "{{ route('items.search') }}";

        $("#item").autocomplete({
                minLength: 0,
                source: projects,
                focus: function (event, ui) {
                    $("#item").val(ui.item.name);
                    return false;
                },
                select: function (event, ui) {
                    $("#item").attr('placeholder', ui.item.name);
                    $("#item").attr('value', ui.item.id);
                    $("#item_id").val(ui.item.id);
                    $("#price").val(ui.item.price);
                    $("#code").val(ui.item.code);

                    return false;
                }
            })
            .autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                    .append("<div>" + item.name + "<br>" + item.code + "<br>" + item.price + "</div>")
                    .appendTo(ul);
            };
    });

</script>
<script>
    $(document).ready(function () {
        var count = 1;
        dynamic_field(count);

        function dynamic_field(number) {
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
            } else {
                html += `
                <div class="col-sm-1">
                    <button type="button" name="adding" id="adding" class="btn btn-success">Add</button></td>
                </div>
                `;
                $('#form').html(html);
            }
        }
        $(document).on('click', '#adding', function () {
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
