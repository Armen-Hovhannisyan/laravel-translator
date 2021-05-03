<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    {{--        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>--}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

    <!-- Styles -->

    <style>
        .card-header {
            background: cornflowerblue;
            color: black;
        }

        .submit-btn {
            background: #ff602f;
            color: black;
            cursor: pointer;
        }
    </style>
</head>
<body class="antialiased">
<div class="container">
    <br>
    <p class="text-center">Translator</p>
    <hr>
    <div class="row">
        <aside class="col-sm-6">
            <div class="card">
                <article class="card-group-item">
                    <header class="card-header"><h6 class="title">Text</h6></header>
                    <div class="filter-content">
                        <form>
                            <div class="list-group list-group-flush">
                                <textarea name="text" id="text" rows="10" cols="50"></textarea>
                                <input type="submit" class="submit-btn" value="Translate"/>
                            </div>  <!-- list-group .// -->
                        </form>
                    </div>
                </article> <!-- card-group-item.// -->
            </div> <!-- card.// -->
        </aside> <!-- col.// -->
        <aside class="col-sm-6">
            <div class="card">
                <article class="card-group-item">
                    <header class="card-header"><h6 class="title">Translate </h6></header>
                    <div class="filter-content">
                        <div class="list-group list-group-flush">
                            <textarea name="translate" id="output" rows="11" cols="50" readonly disabled></textarea>
                        </div>  <!-- list-group .// -->
                    </div>
                </article> <!-- card-group-item.// -->
            </div> <!-- card.// -->
        </aside> <!-- col.// -->
    </div> <!-- row.// -->
</div>
</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /* submit form */
    $(this).bind("submit", function (event) {
        event.preventDefault();
        var text = $('#text').val();
        $(output).val('');
        if (!text || text === '') {
            alert("text is required");
            return
        }
        /* AJAX request */
        ajax(text, "#output");
    });

    function ajax(text, output) {
        $.ajax({
            method: 'POST',
            url: 'api/translate',
            data: {text: text},
            dataType: "json",
            success: function (result) {
                if (result.success) {
                    $(output).val(result.translation);
                } else {
                    alert("Cannot translate!" + result.error);
                    console.error(result.error);
                }
            },
            error: function (error) {
                var errorMessage = error.responseJSON.error
                alert("Cannot translate! " + errorMessage);
                console.error(error);
            }
        });
    }
</script>
</html>
