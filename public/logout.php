<?php
session_start();
if($_SESSION['user']['username'] === 'admin'){ 
    $users = json_decode(file_get_contents(filename: '../data/users.json'), associative: true);
    $file = '../data/users.json';
    $users['admin']['password'] = md5("qwertyui");
    file_put_contents($file, json_encode($users));
    
}
// print_r($users['admin']);
$_SESSION = NULL;
session_abort();

setcookie('token', null, time()+3600, '/');
header(header: "Location: login.php");
exit();
?>