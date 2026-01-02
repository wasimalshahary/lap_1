<?php

$username = $_POST['name'];
$password = $_POST['password'];
if($username == 'admin' && $password == 1234 ){
    echo "hi Admin <br>";
    
}else{
    echo "بيانات غير صحيحه";
}

?>