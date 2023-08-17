<head>
    <title>QR TBSL</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
</head>

<div class="col py-3">
    @error('error')
    <div
        class="alert alert-danger mb-1 d-flex justify-content-center popup-message"
        style="
            position: absolute;
            z-index: 1000;
            width: 80%;
            margin-top: -15px;
            margin-left: 10%;
            font-weight: bolder;
        "
    >
        {{ $message }}
    </div>
    @enderror @if(session()->has('message'))
    <div
        class="alert alert-success mb-1 d-flex justify-content-center popup-message"
        style="
            position: absolute;
            z-index: 1000;
            width: 80%;
            margin-top: -15px;
            margin-left: 10%;
            font-weight: bolder;
        "
    >
        {{ session()->get('message') }}
    </div>
    @endif
</div>
<div class="main">
    <p class="greetings">
        Hey,👋 <br />
        Welcome <br />
        Back!
    </p>
    <div>
        <a href="/login">
            <button type="submit" class="button">Log-in</button>
        </a>
    </div>
</div>

<style>
    body {
        margin: 0;
        height: 100%;
        background: url(./dist/assets/image.png) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .main {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .greetings {
        color: #0d1b2a;
        /* color: white; */
        transform: translateX(-30px) translateY(-50px);
        font-weight: bold;
        font-size: 7vw;
        margin-top: 2vh;
        transition: all 100ms ease-in-out;
    }

    button {
        display: flex;
        position: absolute;
        top: 70%;
        right: 18%;
        background-color: #0d1b2a;
        width: 80%;
        width: 250px;
        height: 60px;
        max-height: 60px;
        border-radius: 30px;
        color: #f7941d;
        font-size: 30px;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }

    @media screen and (max-width: 600px) {
        .greetings {
            font-size: 10vw;
            margin-top: -4vh;
        }

        .button {
            font-size: 4vw;
            margin-top: -4vh;
        }
    }

    @media screen and (max-width: 600px) {
        .greetings {
            font-size: 15vw;
            margin-top: -4vh;
            transform: translateX(-30px) translateY(-50px);
        }

        .button {
            font-size: 6vw;
            margin-top: -4vh;
            transform: translateX(0) translateY(10vw);
        }
    }

    @media screen and (max-width: 600px) {
        .greetings {
            font-size: 20vw;
            margin-top: 10vh;
            transform: translateX(-30px) translateY(-80px);
        }

        .button {
            font-size: 8vw;
            margin-top: 2vh;
            transform: translateX(0) translateY(20vw);
        }
    }
</style>
