<head>
    <title>QR TBSL</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
</head>

<div class="col py-3">
    @error('error')

    <div
        class="popup-message"
        style="
            position: fixed;
            left: 50%;
            transform: translate(-50%, 0);
            z-index: 10;
            border-radius: 5px;
            width: 50%;
            margin-top: 2%;
            font-size: 30px;
            font-weight: bolder;
            text-align: center;
            padding: 5px;
            color: #842029;
            background-color: #f8d7da;
            border-color: #f5c2c7;
        "
    >
        {{ $message }}
    </div>
    @enderror @if(session()->has('message'))
    <div
        class="popup-message"
        style="
            position: fixed;
            left: 50%;
            transform: translate(-50%, 0);
            z-index: 10;
            border-radius: 5px;
            width: 50%;
            margin-top: 2%;
            font-size: 30px;
            font-weight: bolder;
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
            text-align: center;
            padding: 5px;
        "
    >
        {{ session()->get('message') }}
    </div>
    @endif
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/dist/frontend/js/custom.js"></script>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            if ($(".popup-message").length > 0) {
                $(".popup-message").remove();
            }
        }, 3000);
    });
</script>
<div style="height: 65px"></div>

<div class="body">
    <form action="/login" method="POST" style="display: none" id="myForm">
        @csrf
        <h1 class="heading">Hey, Welcome Back!</h1>
        <div class="row">
            <input
                type="number"
                name="phone"
                id="phone"
                autocomplete="off"
                placeholder="Enter your phone no."
                pattern="[0-9]{10}"
                onKeyPress="if(this.value.length == 10) return false;"
                required
            />
        </div>
        <div class="row">
            <input
                type="password"
                name="password"
                id="password"
                placeholder="Enter your password"
                required
            />
            <i class="bi bi-eye-fill" id="togglePassword"></i>
        </div>
        <div class="bottom_part">
            <div class="rememberMe">
                <input
                    type="checkbox"
                    name="remember_me"
                    value="remember_me"
                    id="rememberMe"
                />
                <label for="rememberMe">Remember Me</label>
            </div>

            <div class="data">
                <div class="model">
                    <strong style="color: white"
                        >Contact the Admin to change your
                        password.</strong
                    >
                    <div class="btn">
                        <p class="wrap">Ok!</p>
                    </div>
                </div>
            </div>

            <p class="wrap" id="forget_Pass">Forget Password?</p>
        </div>
        <button type="submit" id="submit">Login</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="/dist/frontend/js/jquery_local.js"></script>
<script src="/dist/frontend/js/jquery_form_local.js"></script>
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    $("body").append(
        '<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>'
    );
    $(window).on("load", function () {
        setTimeout(removeLoader, 0);
    });

    function removeLoader() {
        $("#loadingDiv").fadeOut(1000, function () {
            $("#loadingDiv").remove();
        });
    }
</script>

<script>
    setTimeout(function () {
        document.getElementById("myForm").style.display = "block";
    }, 350);
</script>

<script>
    $(".data").hide();
    jQuery(".wrap").on("click", function () {
        jQuery(".data").toggle();
    });
</script>

<style>
    .data {
        display: block;
        background: rgba(0, 0, 0, 0.6);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 10;
    }

    .model {
        background: #000103;
        border: #333333 solid 1px;
        border-radius: 5px;
        margin-left: -200px;
        position: fixed;
        left: 50%;
        z-index: 11;
        width: 360px;
        top: 35%;
        padding: 20px;
    }

    .btn {
        margin-top: 20px;
        border-top: #f7941d solid 1px;
        text-align: right;
    }

    .wrap {
        color: white;
        margin-top: 0px;
    }

    .wrap:hover {
        color: #f7941d;
    }
</style>

<script>
    $(document).on("input", function () {
        var check = $("#phone").val();
        if (check.toString().length === 10) {
            $("button").removeAttr("disabled");
        } else {
            $("button").attr("disabled", "disabled");
        }
    });
</script>

<script>
    $("#togglePassword").click(function () {
        $(this).toggleClass("bi bi-eye-slash-fill");
    });

    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");
    togglePassword.addEventListener("click", () => {
        const type =
            password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
    });
</script>

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    #togglePassword {
        margin: -33px 333px;
    }
</style>

<style>
    body {
        font-family: "Open Sans", sans-serif;
        color: #3a3c47;
        line-height: 1.6;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0;
        padding: 0;
        background: url(./dist/assets/Group_43.png) no-repeat center center
            fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        transition: all 500ms ease-in-out;
    }

    h1 {
        margin-top: 48px;
        font-size: 40px;
        font-weight: bolder;
        text-align: left;
        color: #0d1b2a;
    }

    form {
        margin-top: 20vh;
        margin-left: 70vh;
        background: transparent;
        width: 360px;
    }

    .row {
        display: flex;
        flex-direction: column;
        margin-bottom: 40px;
    }

    .row input {
        background-color: transparent;
        flex: 1;
        padding: 13px;
        border: 2px solid black;
        border-radius: 11px;
        font-size: 16px;
        transition: all 0.2s ease-out;
    }

    .row input:focus {
        box-shadow: inset 2px 2px 5px 0 rgba(42, 45, 48, 0.12);
    }

    .row input::placeholder {
        color: rgba(0, 0, 0, 0.782);
    }

    button {
        width: 100%;
        padding: 12px;
        font-size: 25px;
        background: linear-gradient(
            90deg,
            #01eafe 0%,
            #1f7fd9 100%,
            rgba(0, 0, 0, 1) 100%
        );
        font-style: normal;
        font-weight: bold;
        border: none;
        color: white;
        border-radius: 15px;
        cursor: pointer;
        font-family: "Open Sans", sans-serif;
        margin-top: 15px;
    }

    .bottom_part {
        display: flex;
        justify-content: space-between;
        padding-left: 8px;
        padding-right: 8px;
        margin-top: 60px;
        margin-bottom: 30px;
    }

    .bottom_part a {
        text-decoration: none;
    }

    #forget_Pass {
        color: rgb(101, 99, 97);
        font-weight: bold;
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        h1 {
            font-size: 35px;
        }

        form {
            margin-top: 0em;
            width: 30vw;
        }

        #togglePassword {
            margin: -33px 280px;
        }

        button {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 5vh auto;
            padding: 10px;
            width: 100%;
            transform: translateX(0px) translateY(15%);
        }
    }

    @media screen and (max-device-width: 640px) {
        h1 {
            visibility: hidden;
        }

        h1:after {
            content: "Login to your Account!";
            clear: right;
            display: block;
            visibility: visible;
            line-height: 50px;
            /* margin-top: 250px; */
        }

        body {
            display: block;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            background: url(./dist/assets/Group_431.png) no-repeat center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            transition: all 500ms ease-in-out;
        }

        form {
            transform: scale(2.2);
            margin: 50% auto;
        }

        button {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2vh auto;
            padding: 10px;
            width: 90%;
        }
    }

    @media screen and (max-device-width: 667px) and (orientation: landscape) {
        form {
            transform: scale(0.8);
            margin-top: -5vh;
        }

        #togglePassword {
            margin: -33px 330px;
        }
    }

    @media screen and (min-device-width: 670px) and (max-device-width: 740px) and (orientation: landscape) {
        form {
            transform: scale(0.8);
            margin-top: -5vh;
        }

        #togglePassword {
            margin: -33px 330px;
        }
    }

    @media screen and (min-device-width: 750px) and (max-device-width: 950px) and (orientation: landscape) {
        form {
            transform: scale(0.8);
            margin-top: -5vh;
        }

        #togglePassword {
            margin: -33px 265px;
        }
    }

    @media screen and (min-device-width: 500px) and (max-device-width: 1100px) and (orientation: portrait) {
        body {
            display: block;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            /* z-index: 0; */
            background: url(./dist/assests/Group_43.png) no-repeat center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            transition: all 500ms ease-in-out;
        }

        form {
            transform: scale(1.5);
            margin: 25vh auto;
        }

        #togglePassword {
            margin: -33px 265px;
        }
    }
</style>

<style>
    .loader {
        color: #01c5f6;
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
            box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em,
                0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
        }

        5%,
        95% {
            box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em,
                0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
        }

        10%,
        59% {
            box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em,
                -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em,
                -0.297em -0.775em 0 -0.477em;
        }

        20% {
            box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em,
                -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em,
                -0.749em -0.34em 0 -0.477em;
        }

        38% {
            box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em,
                -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em,
                -0.82em -0.09em 0 -0.477em;
        }

        100% {
            box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em,
                0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
        }
    }

    @keyframes load6 {
        0% {
            box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em,
                0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
        }

        5%,
        95% {
            box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em,
                0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
        }

        10%,
        59% {
            box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em,
                -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em,
                -0.297em -0.775em 0 -0.477em;
        }

        20% {
            box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em,
                -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em,
                -0.749em -0.34em 0 -0.477em;
        }

        38% {
            box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em,
                -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em,
                -0.82em -0.09em 0 -0.477em;
        }

        100% {
            box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em,
                0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
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
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* background-color: black; */
        /* background: url("/dist/assets/Loading.png") no-repeat center center; */
        background: url("/dist/logo_only.png") no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: 7vh;
        -o-background-size: 7vh;
        background-size: 7vh;
    }

    @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
        /* #loadingDiv {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url("/dist/assets/Loading_mobile.png") no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

    } */

        .loader {
            font-size: 160px;
        }
    }
</style>
