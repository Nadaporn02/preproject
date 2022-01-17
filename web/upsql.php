<?php
    include("functions.php");
    $query ="UPDATE `error` SET `status` = 'read'";
    performQuery($query);
?>