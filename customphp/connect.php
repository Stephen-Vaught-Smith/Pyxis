<?php
$connection = mysqli_connect('oniddb.cws.oregonstate.edu', 'leinings-db', 'Q0u6N9bFIA8s672N');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'leinings-db');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
