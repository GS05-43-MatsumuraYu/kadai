<?php
session_start();
$br = "<br>";
echo $_SESSION["name"].$br;
echo $_SESSION["num"].$br;
echo $_SESSION["value"].$br;

?>