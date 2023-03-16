<?php
    // print_r($_POST);
    if(isset($_POST['username'], $_POST['password'])){
        $users = json_decode(file_get_contents(filename: '../data/users.json'), associative: true);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash = md5( string: microtime().print_r($_SERVER, return: true).rand());
        if(!isset($users[$username])){
            $users[$username] = array(
                'username' => $username,
                'realname' => '',
                'password' => $password,
                'cookie' => $hash
            );
            $users = json_encode($users);
            $file = '../data/users.json';
            file_put_contents( $file, $users);
            setcookie('token', $hash, time()+3600, '/');
            header(header: "Location: profile.php");
            exit();
        }else{
            die("User exists");
        }
        // print_r($users);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        
    </style>
    <h1>Register here</h1>
</head>
<body>
    <div class="register">
        <form action="" method="post">
            <div><input type="text" name="username" ></div>
            <div><input type="password" name="password"></div>
            <div><input type="submit" name="submit" value="register"></div>
        </form>
    </div>
</body>
</html>