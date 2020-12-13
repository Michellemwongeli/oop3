<?php

session_start();
include_once 'class.php';

$user = new User();

if ($user->session()) {
    header("location:index.php");
}

$user = new User();
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $pass = md5($password);

    $login = $user->login($email, $pass);

    var_dump($email);
    var_dump($password);
    if ($login) {
        header("location:index.php");
    } else {
        echo "Login Failed!";
    }
}
?>
<html>

<head>
    <title>Log In</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="form">
        <h1>Log In</h1>
        <form action="" method="post">
            <input type="text" id="email" name="email" placeholder="Please Enter Email" required />
            <br />
            <input type="password" id="password" name="password" placeholder="Please Enter Password" required />
            <br />
            <input type="submit" name="submit" value="Login" />
        </form>
        <p>Not registered yet?<a href="register.php"> Register Here</a></p>
    </div>
</body>

</html>