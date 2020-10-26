<!DOCTYPE html>
<html lang="en">

<head>
    <!--- Basic Page Needs  -->
    <meta charset="utf-8">
    <title>Pharmacy Online</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Meta  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/wel/homestyle.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/wel/responsive.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hover-min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">

</head>

<body>

    <!-- prealoader area start -->
    <div id="preloader">
        <div class="spiner"></div>
    </div>
    <!-- prealoader area end -->
    <!-- Crumbs area start -->
    <div class="crumbs-area">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
                    <div class="crumbs-header">
                        <h2 class="cd-headline letters rotate-3">
                        <a href="{{ route('welcome') }}"><span class="cd-words-wrapper">
                                <b class="is-visible">Pharmacy</b>
                                <b>Welcome </b>
                            </span></a>
                        </h2>
                        <p>This Project Created By: NOR.ABD.ZEY.ALA </p>
                        <div class="btn-area h2">
                          <a class="h2" href="{{ route('login') }}" style="width:120px;   font-size: large;
"><b>Login</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <footer>
        <div class="footer-area">
            <div class="container">
                <div class="footer-content text-center text-white bg-dark">
                    <h2>Helping you any time !</h2>

                    <p class="copy-right text-white"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->

    <!-- Scripts -->
    <script src="{{ asset('js/wel/jquery-3.2.0.min.js') }}"></script>
    <script src="{{ asset('js/wel/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/wel/animatedheadline.js') }}"></script>
    <script src="{{ asset('js/wel/counterup.js') }}"></script>
    <script src="{{ asset('js/wel/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/wel/theme.js') }}"></script>
</body>

</html>
