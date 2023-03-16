<?php
session_start();
function updateUser($username,$newPassword){
    $users = json_decode(file_get_contents(filename: '../data/users.json'), associative: true);
    $file = '../data/users.json';
    if(isset($users[$username])){
        $users[$username]['password'] = $newPassword;
        // $users[$username]['username'] = $username;
        file_put_contents($file, json_encode($users));
    }
}

$u = false;
if(isset($_COOKIE['token'])){
    $token = $_COOKIE['token'];
    $users = json_decode(file_get_contents(filename: '../data/users.json'), associative: true);
    foreach($users as $user){
        
        // print_r( $user['username']);
        // print_r( $user['cookie']);
        // echo "<br>";
        // print_r($user);

        if($user['cookie'] === $token){
            $u = $user;
            
            
            if(isset($_POST['username'], $_POST['newPassword'])){
                updateUser($_POST['username'], $_POST['newPassword']);
                header(header: 'Location: profile.php');
                exit();
            }
        }
    }
}
$_SESSION['user'] = $u;
// print_r($_SESSION);
if($u){ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        
    </style>
    <h1>Profile</h1>
    <?php
        if($u['username'] === 'admin'){ 
            ?>
            <h1>FLAG{OO_BETE_MOZ_KARDI}</h1>
    <?php   } ?>
    <h2>Welcome <?php echo $u['username']; ?></h2>
</head>
<body>
    <div class="login">
        <form action="" method="post">
            <input type="hidden" name="username" value="<?php echo $u['username']; ?>">
            
            <div><input type="text" name="newPassword" value="<?php echo $u['password'];?>"></div>
            <div><input type="submit" name="submit" value="Update Password"></div>
        </form>
    </div>
    <div><a href="logout.php"> <input type="button" name="submit" value="logout"></a></div>
    
</body>
</html>
<?php
}
else{
    header(header: "Location: login.php");
    exit();
}
?>