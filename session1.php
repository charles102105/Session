<?php
session_start();
$_SESSION['username']="Charles";
$_SESSION['password']=1950;
print "Hello " . $_SESSION['username'];
?>
<p><a href=session2.php>Login</a>