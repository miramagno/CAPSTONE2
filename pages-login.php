
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="assets/img/wm-logo.svg" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f1f2f8;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 40px;
            margin-top: 20px;
        }

        .logo-container img {
            max-width: 50px;
            margin-right: 10px;
            width: 150px;
        }

        .logo-container h4 {
            color: #015C92;
            margin: 0;
        }

        #form-register {
            background-color: #f6f5f5;
            color: white;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 15px rgba(0, 0, 0, 0.1);
        }

        #form-register h4,
        p {
            color: #015C92;
            text-align: center;
        }

        #form-register p {
            color: rgb(39, 32, 32);
            text-align: center;
        }

        #form-register label {
            color: rgb(39, 32, 32);
        }

        #form-register input {
            background-color: #ffffff;
            color: rgb(134, 134, 134);
            border: 1px solid #8e8e8f52;
            border-radius: 5px;
        }

        #form-register input::placeholder {
            color: #878787;
        }

        #form-register input:focus {
            border-color: #858585;
        }

        #form-register .btn-primary {
            background-color: #015C92;
            border: none;
        }

        #form-register .btn-primary:hover {
            background-color: #3e85ad;
        }

        #form-register .form-check-input {
            width: 20px;
            height: 20px;
            border: 2px solid #b0c4de;
            background-color: white;
            position: relative;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            cursor: pointer;
            border-radius: 4px;
        }

        #form-register .form-check-input:checked {
            background-color: #52A7DB;
            border-color: #53A7DB;
        }

        #form-register .form-check-label {
            color: rgb(43, 42, 42);
        }

        #forgot-password {
            text-decoration: underline;
            color: #1d1e20;
            cursor: pointer;
        }

        #forgot-password:hover {
            color: #53A7DB;
        }
    </style>
</head>

<body>
    <div id="form-register" class="d-flex flex-column justify-content-center align-items-center">
        <div class="logo-container">
            <img src="assets/img/wm-logo.svg" alt="Logo">
            <h4>Admin</h4>
        </div>
        <div>
            <h4 class="mb-3">Login to your Account</h4>
            <p>Enter your username & password to login</p>
        </div>
        <form class="row g-3 mt-2" method="POST" action="login.php">
            <div class="col-md-12">
                <label for="username" class="form-label">Username</label>
                <label class="visually-hidden" for="inlineFormInputGroupUsername"></label>
                <div class="input-group">
                    <div class="input-group-text">@</div>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
            </div>
            <div class="col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="col-12">
                <label id="forgot-password">Forgot Password?</label>
            </div>
            <div class="col-8">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </div>
        </form>
    </div>
</body>
<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault();  
        window.location.href = "index.php";  
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.12/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>
