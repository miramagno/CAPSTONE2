<?php
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "foreproduce";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);  
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (empty($first_name) || empty($last_name) || empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $plain_password = $password; 

        $stmt = $conn->prepare("INSERT INTO register (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $username, $plain_password); 

        if ($stmt->execute()) {
            $success = "Registration successful!";
            header("Location: pages-login.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Register</title>
    <link href="assets/img/wm-logo.svg" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-color: #f1f2f8;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .logo-container { display: flex; justify-content: center; align-items: center; margin-bottom: 40px; margin-top: 20px; }
        .logo-container img { max-width: 50px; height: auto; margin-right: 10px; width: 150px; }
        .logo-container h1 { font-size: 1.5rem; color: #015C92; margin: 0; font-size: 3rem; }
        #form-register { background-color: #f6f5f5; color: white; padding: 30px; border-radius: 10px; width: 100%; max-width: 500px; box-shadow: 0 15px 15px rgba(0, 0, 0, 0.1); }
        #form-register h4, p { color: #015C92; text-align: center; }
        #form-register p { color: rgb(39, 32, 32); text-align: center; }
        #form-register label { color: rgb(39, 32, 32); }
        #form-register input { background-color: #ffffff; color: rgb(134, 134, 134); border: 1px solid #8e8e8f52; border-radius: 5px; }
        #form-register input::placeholder { color: #878787; }
        #form-register input:focus { border-color: #858585; }
        #form-register .btn-primary { background-color: #015C92; border: none; }
        #form-register .btn-primary:hover { background-color: #3e85ad; }
        #form-register .form-group { margin-bottom: 15px; }
        #form-register .form-check-input { width: 20px; height: 20px; border: 2px solid #b0c4de; background-color: white; position: relative; -webkit-appearance: none; -moz-appearance: none; appearance: none; cursor: pointer; border-radius: 4px; }
        #form-register .form-check-input:checked { background-color: #52A7DB; border-color: #53A7DB; }
        #form-register .form-check-label { color: rgb(43, 42, 42); }
        #forgot-password { text-decoration: underline; color: #1d1e20; cursor: pointer; }
        #forgot-password:hover { color: #53A7DB; }
    </style>
</head>
<body>
    <div id="form-register" class="d-flex flex-column justify-content-center align-items-center">
        <div class="logo-container">
            <img src="assets/img/wm-logo.svg" alt="Logo">
            <h4>Admin</h4>
        </div>
        <div>
            <h4 class="mb-3">Create an Account</h4>
            <p>Enter your personal details to access our dashboard</p>
        </div>
        <form class="row g-3 mt-2" method="POST" action="">
            <div class="col-12">
                <label for="formGroupExampleInput" class="form-label">Fullname</label>
                <div class="row g-1">
                    <div class="col">
                        <input type="text" class="form-control" name="first_name" placeholder="First name" aria-label="First name" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="last_name" placeholder="Last name" aria-label="Last name" required>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
            </div>

            <div class="col-md-6">
                <label for="inputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter your username" required>
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Create a password" required>
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Re-enter password" required>
            </div>

            <div class="col-12">
                <label id="forgot-password">Don't have an account?</label>
            </div>


            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" required>
                    <label class="form-check-label" for="gridCheck">
                        I agree and accept the terms and conditions
                    </label>
                </div>
            </div>


            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Create Account</button>
            </div>
        </form>
        <?php if (isset($error)) { echo "<div class='alert alert-danger mt-3'>" . $error . "</div>"; } ?>
        <?php if (isset($success)) { echo "<div class='alert alert-success mt-3'>" . $success . "</div>"; } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

