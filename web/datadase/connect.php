<?php

$con = mysqli_connect("localhost", "root", "", "test");
if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL:" . mysql_connect_error();

}
?>