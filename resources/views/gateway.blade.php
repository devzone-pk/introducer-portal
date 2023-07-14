{{--<html>--}}
{{--<head>--}}
{{--    <!– Load the Hosted Payment Page library –>--}}
{{--    <script src="https://gateway.swipen.co.uk/sdk/web/v1/js/hostedforms.min.js"></script>--}}
{{--</head>--}}
{{--<body>--}}

{{--<form name="payment-form" method="post" action="https://gateway.swipen.co.uk/hosted/" data-hostedforms-modal>--}}
{{--    @foreach($packet as $key => $p)--}}
{{--        <input type="hidden" name="{{$key}}" value="{{htmlentities($p)}}"/>--}}
{{--    @endforeach--}}


{{--    <input type="submit" value="Pay Now">--}}
{{--</form>--}}
{{--<script>--}}
{{--    // Create a new Hosted Form object which will cause the above <form> to load into a modal--}}
{{--    // overlay over this page.--}}
{{--    var form = new window.hostedForms.classes.Form(document.forms[0]);--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}


        <!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>


    <title>Tube Mastery and Monetization</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
    <style>
        body {
            padding-top: 50px;
        }

        .content {
            padding: 40px 15px;
            text-align: center;
            font-family: Arial;
        }
    </style>

    <script src="https://gateway.swipen.co.uk/sdk/web/v1/js/hostedforms.min.js"></script>

<body>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="content">

            <img src="https://gateway.swipen.co.uk/hosted/themes/1.2/swipen/img/logo.svg" alt="">


            <h1 class="mt-2">You are being directed to Payment Gateway.</h1>

            <h4>Thank you for choosing our service.</h4>


            <form name="payment-form" id="payment-form" method="post" action="https://gateway.swipen.co.uk/hosted/"
                  data-hostedforms-modal>
                @foreach($packet as $key => $p)
                    <input type="hidden" name="{{$key}}" value="{{htmlentities($p)}}"/>
                @endforeach


                <input type="submit" class="btn btn-success btn-lg" value="Redirecting.....">
            </form>

        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
<script>
    // Create a new Hosted Form object which will cause the above <form> to load into a modal
    // overlay over this page.
    var form = new window.hostedForms.classes.Form(document.forms[0]);

    window.addEventListener('load', function () {
       document.getElementById('payment-form').submit();
    });
</script>
</body>
</html>