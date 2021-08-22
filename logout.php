
<?php 

session_start(); 

// session silme işlemi
session_destroy();
header("Location:login.php?durum=exit");


 ?>