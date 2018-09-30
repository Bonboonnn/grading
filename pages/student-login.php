<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-grading</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: whitesmoke;
    }

    * {
        font-family: century gothic;
    }

    #login {
        width: 280px;
        height: 380px;
        padding: 10px;
        position: absolute;
        top: calc(50% - 200px);
        left: calc(50% - 150px);
        border-radius: 5px;
        background-color: white;
    }

    h3,
    #login {

        box-shadow: -1px 2px 4px gray;
    }

    .log-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: auto;
        display: block;
        margin-top: 20px;
    }

    .inputs {
        width: 100%;
        border-style: none;
        border-bottom-style: solid;
        border-bottom-width: 2px;
        font-size: 1.04em;
        height: 35px;
        text-indent: 10px;
        margin-bottom: 10px;
        border-bottom-color: transparent;
        background-color: whitesmoke;
        border-radius: 25px;
    }

    .inputs:focus,
    .login-btn:focus {
        outline-style: none;
        transition:1s;
        background-color:white;
        box-shadow:-2px 2px 4px 0 gray;
    }

    h3 {
        margin-bottom: 5px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        padding-left: 10px;
        padding-right: 10px;
        display: inline-flex;
        border-radius: 25px;
        background-color: deepskyblue;
        margin-bottom: 10px;
        color: #fff;
    }

    h2 {
        margin: 0;
        background-color: whitesmoke;
        text-align: center;
        padding: 5px;
        color: gray;
    }

    .login-btn {
        width: 100%;
        font-size: 1.04em;
        height: 40px;
        border-radius: 25px;
        background-color: transparent;
        cursor: pointer;
        border-style: solid;
        border-color: deepskyblue;
    }

    .login-btn:hover {
        background-color: deepskyblue;
        color: white;
    }

    .snack-bar {
        height: 50px;
        max-width: 100%;
        background-color: #222;
        position: fixed;
        top: 20px;
        right: 20px;
        border-radius: 5px;
        transform: translateY(-100px);
        transition: 0.6s;
        will-change: transform;
    }

    .snack-bar.show {
        transform: translateY(0);
    }

    .snack-bar-message {
        padding-left: 20px;
        padding-right: 20px;
        height: 50px;
        line-height: 50px;
        color: #fff;
    }

    .snack-bar-message.success {
        color: lime;
    }

    .snack-bar-message.failed {
        color: crimson;
    }




    .spinner::before {
        content: '';
        box-sizing: border-box;
        position: fixed;
        top: calc(50% - 25px);
        left: calc(50% - 25px);
        width: 50px;
        height: 50px;
        z-index: 999;
        background-color: white;
        border-radius: 100%;
        box-shadow: -2px 2px 4px 0 gray;
    }

    .spinner::after {
        content: '';
        box-sizing: border-box;
        position: fixed;
        top: calc(50% - 20px);
        left: calc(50% - 20px);
        width: 40px;
        height: 40px;
        z-index: 999;
        border-radius: 100%;
        border-style: solid;
        border-width: 4px;
        border-color: deepskyblue;
        border-right-color: #ccc;
        border-bottom-color: #ccc;
        animation-name: rotate;
        animation-duration: 1s;
        animation-iteration-count: infinite;
        animation-delay: 0;
        animation-direction: normal;
        animation-fill-mode: forwards;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }
        50% {
            transform: rotate(180deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    @media screen and (max-width: 360px) {
        #login {
            width: calc(100%);
            left: 0px;
            top: 0px;
            height: calc(100vh);
            padding: 0px;
        }

        .inputs,
        .login-btn {
            width: 94%;
            margin-left: 3%;
        }
        h3 {
            margin-left: 3%;
        }
        .snack-bar {
            top: auto;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            transform: translateY(100px);
        }
        .snack-bar-message {
            font-weight: normal;
        }
    }
</style>

<body>
    <div id="login">
        <h2>E-Grading</h2>
        <img src="profile.jpg" class="log-img">
        <h3>Login</h3>
        <input type="text" class="inputs" placeholder="Username...">
        <input type="password" class="inputs" placeholder="Password...">
        <button class='login-btn' onclick="login()">Login</button>
    </div>

    <div class="snack-bar" id="snackBar">
        <div class="snack-bar-message"></div>
    </div>
</body>
<script>

    function login() {
        const data = {
            response: 'success', //success => lime color, failed => crimson color
            message: 'Successfully login!',
            duration: 2000, // millisecond
        }
        openSnackBar.open(data);
    }

    //
    const spinner = {
        open: () => {
            document.querySelector('body').classList.add('spinner')
        },
        hide: () => {
            window.setTimeout(e => {
                document.querySelector('body').classList.remove('spinner')
            }, 500);
        }
    }

    //
    const openSnackBar = {
        open: (data) => {
            const req = data.response;
            const mes = data.message;
            snackBar.getElementsByClassName('snack-bar-message').item(0).classList.add(data.response);
            snackBar.getElementsByClassName('snack-bar-message').item(0).innerHTML = data.message;
            snackBar.classList.add('show');
            window.setTimeout(e => {
                snackBar.classList.remove('show');
            }, data.duration);
        }
    }
</script>

</html>