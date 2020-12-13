<?php

class User
{
    public $con;

    function __construct()
    {
        include_once dirname(__FILE__) . '/dbConnect.php';

        $db = new DbConnect();

        $this->con = $db->connect();
    }

    function register($trn_date, $name, $username, $email, $pass)
    {
        $pass = md5($pass);
        $checkuser = $this->con->prepare("Select id from users where email='$email'");

        $result =  $checkuser->num_rows();

        if ($result == 0) {
            $register = $this->con->prepare("Insert into users (trn_date, name, username, email, password) values ('$trn_date','$name','$username','$email','$pass')") or die(mysql_error());
            return $register;
        } else {
            return false;
        }
    }

    public function login($email, $pass)
    {
        $pass = md5($pass);
        $check = $this->con->prepare("Select * from users where email='$email' and password='$pass'");
        $data = $check->fetch();//mysqli_fetch_array($check);
        $result = $check->num_rows();//mysqli_num_rows($check);
        if ($result == 1) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $data['id'];
            return true;
        } else {
            return false;
        }
    }

    public function fullname($id)
    {
        $result = $this->con->prepare("Select * from users where id='$id'");
        $row = mysqli_fetch_array($result);
        echo $row['name'];
    }

    public function session()
    {
        if (isset($_SESSION['login'])) {
            return $_SESSION['login'];
        }
    }

    public function logout()
    {
        $_SESSION['login'] = false;
        session_destroy();
    }
}
