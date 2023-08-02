<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>QR TBSL</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Urbanist" rel="stylesheet" />
    <!-- <link href='https://fonts.googleapis.com/css?family=Dancing Script' rel='stylesheet'> -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" /> -->
    <link href="/dist/frontend/css/custom.css" rel="stylesheet" />
    <link href="/dist/frontend/css/bootstrap_min.css" rel="stylesheet" />
    <link href="/dist/frontend/css/bootstrap_icons.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
</head>

<body>
    <div id="app">
        @include('layout.header')

        <div style="height:65px"></div>


        <div class="col py-3">
            @error('error')
            <div class="alert alert-danger mb-1 d-flex justify-content-center popup-message"
                style="position: fixed; top: 0; z-index:20; width: 80%; margin-top: 2%; font-weight: bolder; left: 50%; transform: translate(-50%, 0)">
                {{ $message }}
            </div>
            @enderror 
            @if(session()->has('message'))
            <div class="alert alert-success mb-1 d-flex justify-content-center popup-message"
                style="position: fixed; top: 0; z-index:20; width: 80%; margin-top: 2%; font-weight: bolder; left: 50%; transform: translate(-50%, 0)">
                {{ session()->get('message') }}
            </div>
            @endif
            <!-- id="content" style="display:none;" -->
            <main class="py-0" id="content" style="visibility: hidden;">@yield('content')</main>

            <!-- <div style="height:100px"></div> -->

            <!-- @include('layout.footer') -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="/dist/frontend/js/custom.js"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

    <script>
    $(document).ready(function() {
        setTimeout(function() {
            if ($('.popup-message').length > 0) {
                $('.popup-message').remove();
            }
        }, 2000);
    });
    </script>
</body>

</html>

<script>
setTimeout(function() {
    document.getElementById('content').style.visibility = 'visible';
}, 350);
</script>

<!-- <style>
body {
    background: url("/dist/assets/background-image.png") no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    transition: all 500ms ease-in-out;
}
</style> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

<script>
$('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
$(window).on('load', function() {
    setTimeout(removeLoader, 0);
});

function removeLoader() {
    $("#loadingDiv").fadeOut(1000, function() {
        $("#loadingDiv").remove();
    });
}
</script>


<script>
$('form').submit(function() {
    // console.log('submit')
    $(this).find("button[type='submit']").prop('disabled', true);
    // setTimeout(() => {
    //     $(this).find("button[type='submit']").prop('disabled', false);
    // }, 2000);
});
</script>


<style>
.loader {
    color: #F7941D;
    font-size: 90px;
    text-indent: -9999em;
    overflow: hidden;
    width: 1em;
    height: 1em;
    border-radius: 50%;
    margin: 47vh auto;
    position: relative;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-animation: load6 1s infinite ease, round 1s infinite ease;
    animation: load6 1s infinite ease, round 1s infinite ease;
}

@-webkit-keyframes load6 {
    0% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }

    5%,
    95% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }

    10%,
    59% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
    }

    20% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
    }

    38% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
    }

    100% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }
}

@keyframes load6 {
    0% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }

    5%,
    95% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }

    10%,
    59% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
    }

    20% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
    }

    38% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
    }

    100% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }
}

@-webkit-keyframes round {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@keyframes round {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

/* D:\RASONIX\mytyles-DMS-web-app\public\assets\Loading.png */
/* Loading_mobile.png */
#loadingDiv {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: url("/dist/logo_only.png") no-repeat center center;
    logo_only.png -webkit-background-size: cover;
    -moz-background-size: 7vh;
    -o-background-size: 7vh;
    background-size: 7vh;
}

/* 
@media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
    #loadingDiv {
        position: absolute;
        top: 0;
        left: 0;
        width: 50%;
        height: 50%;
        background: url("/dist/assets/Loading_mobile.png") no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

    } 
} */
</style>