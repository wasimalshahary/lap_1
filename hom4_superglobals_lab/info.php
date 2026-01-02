<?php

echo "<pre>";
print_r($_SERVER);
echo "</pre>";

echo "نوع الطلب: " . $_SERVER['REQUEST_METHOD'] . "<br>";
echo "remote_address: ". $_SERVER['REMOTE_ADDR'] . "<br>";
echo " http_user_agent: " . $_SERVER['HTTP_USER_AGENT'] . "<br>";

?>