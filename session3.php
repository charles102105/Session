<?php
session_start();
if (!empty($_SESSION['username']))
{
print "Thank you choosing this page " . $_SESSION['username'];
session_destroy();
}
else 
    exit("Terminated <a href=session1.php>Login First </a>");
?>
<p><a href=session3.php>Login</a>
    hello world