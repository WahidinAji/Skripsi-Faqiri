<html lang="en">

<head>
    <title>Pencarian Autocomplete di Laravel Menggunakan Ajax</title>
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .ui-autocomplete-loading {
            background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
        }

    </style>
</head>

<body>

    <select class="js-example-basic-single" name="state">
        <option value="AL">Alabama</option>
        ...
        <option value="WY">Wyoming</option>
    </select>

    <div class="container">
        <h2>Pencarian Autocomplete di Laravel Menggunakan Ajax</h2>
        <br />
        <select class="livesearch form-control" style="width:500px;" name="cari"></select>
    </div>
    <br>
    <br>
    <div id="project-label">Select a project (type &quot;j&quot; for a start):</div>
    <img id="project-icon" src="images/transparent_1x1.png" class="ui-state-default" alt>
    <input id="project">
    <input type="hidden" id="project-id">
    <p id="project-description"></p>
    <input type="email" id="email">
    <input type="text" id="date">

    <br>
    <br>
    <div class="ui-widget">
        <label for="birds">Birds: </label>
        <input id="birds">
    </div>

    <div class="ui-widget" style="margin-top:2em; font-family:Arial">
        Result:
        <div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
    </div>
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script>
        $(function () {
            // var projects = [{
            //         id: "jquery",
            //         name: "jQuery",
            //         created_at: "the write less, do more, JavaScript library",
            //         email: "jquery_32x32.png"
            //     },
            //     {
            //         id: "jquery-ui",
            //         name: "jQuery UI",
            //         created_at: "the official user interface library for jQuery",
            //         email: "jqueryui_32x32.png"
            //     },
            //     {
            //         id: "sizzlejs",
            //         name: "Sizzle JS",
            //         created_at: "a pure-JavaScript CSS selector engine",
            //         email: "sizzlejs_32x32.png"
            //     }
            // ];
            // var projects = $.getJSON('/auto',function(data){
            //     return data;
            // });
            var projects = "{{ route('items.search') }}";
            $("#project").autocomplete({
                    minLength: 0,
                    source: projects,
                    focus: function (event, ui) {
                        $("#project").val(ui.item.name);
                        return false;
                    },
                    select: function (event, ui) {
                        $("#project").val(ui.item.name);
                        $("#project-id").val(ui.item.id);
                        $("#email").val(ui.item.code);
                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function (ul, item) {
                    return $("<li>")
                        .append("<div>" + item.name + "<br>" + item.code + "<br>" + "</div>")
                        .appendTo(ul);
                };
        });

    </script>
    <script type="text/javascript">
        $('.livesearch').select2({
            placeholder: 'Select movie',
            ajax: {
                url: '/item-search',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

    </script>
</body>

</html>
