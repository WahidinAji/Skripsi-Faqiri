@extends('layouts.main')
@section('title','Transactions')
@section('main-content')
<form method="POST" action="{{ route('transactions.store') }}" id="form">
    @csrf
</form>
{{-- <div class="container">
    <br />
    <h3 align="center">Dynamically Add / Remove input fields in Laravel 5.8 using Ajax jQuery</h3>
    <br />
    <div class="table-responsive">
        <form method="post" id="dynamic_form" action="{{ route('transactions.store') }}">
            <span id="result"></span>
            <table class="table table-bordered table-striped" id="user_table">
                <thead>
                    <tr>
                        <th width="35%">First Name</th>
                        <th width="35%">Last Name</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" align="right">&nbsp;</td>
                        <td>
                            @csrf
                            <button type="submit">submit</button>
                            <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div> --}}
@endsection
@push('script')
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
                    <button onclick="create()" type="button" name="adding" id="adding" class="btn btn-success">Add</button></td>
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
{{-- <script>
    $(document).ready(function () {
        var count = 1;
        dynamic_field(count);
        function dynamic_field(number) {
            html = '<tr>';
            html += '<td><input type="text" name="first_name[]" class="form-control" /></td>';
            html += '<td><input type="text" name="last_name[]" class="form-control" /></td>';
            if (number > 1) {
                html +=
                    '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                $('tbody').append(html);
            } else {
                html +=
                    '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
                $('tbody').html(html);
            }
        }
        $(document).on('click', '#add', function () {
            count++;
            dynamic_field(count);
        });
        $(document).on('click', '.remove', function () {
            count--;
            $(this).closest("tr").remove();
        });

        // $('#dynamic_form').on('submit', function (event) {
        //     event.preventDefault();
        //     $.ajax({
        //         url: '{{ route("transactions.store") }}',
        //         method: 'post',
        //         data: $(this).serialize(),
        //         dataType: 'json',
        //         beforeSend: function () {
        //             $('#save').attr('disabled', 'disabled');
        //         },
        //         success: function (data) {
        //             if (data.error) {
        //                 var error_html = '';
        //                 for (var count = 0; count < data.error.length; count++) {
        //                     error_html += '<p>' + data.error[count] + '</p>';
        //                 }
        //                 $('#result').html('<div class="alert alert-danger">' + error_html +
        //                     '</div>');
        //             } else {
        //                 dynamic_field(1);
        //                 $('#result').html('<div class="alert alert-success">' + data
        //                     .success + '</div>');
        //             }
        //             $('#save').attr('disabled', false);
        //         }
        //     })
        // });

    });

</script> --}}
@endpush
