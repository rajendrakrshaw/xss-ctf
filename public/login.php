<?php
    // print_r($_POST);
    if(isset($_POST['username'], $_POST['password'])){
        $users = json_decode(file_get_contents(filename: '../data/users.json'), associative: true);
        if(isset($users[$_POST['username']])){
            if($users[$_POST['username']]['password'] === $_POST['password']){
                setcookie('token', $users[$_POST['username']]['cookie'], time()+3600, '/');
                header(header: "Location: profile.php");
                exit();
            }
        }
        die("Invalid login");
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
    <h1>Login here</h1>
</head>
<body>
    <div class="login">
        <form action="" method="post">
            <div><input type="text" name="username"></div>
            <div><input type="text" name="password"></div>
            <div><input type="submit" name="submit" value="login"></div>
        </form>
    </div>
    <a href="index.php">Home</a>
</body>
</html>