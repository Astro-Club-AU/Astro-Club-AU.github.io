<?php
    require('db_connect.php');

    //Register the number in DB
    if(isset($_POST['subs'])){
        $num = $_POST['number'];
        $sql = "INSERT INTO `register`(`Date`, `Number`) VALUES (curdate(),9884400048)";

        if (mysqli_query($con, $sql)) {
            $add = "Record added successfully";
        } else {
            $add = "Failed to Add in DB. Please wait or mail your number to the.cosmos.1729@gmail.com";
        }
        echo "<script>alert('$add');document.location='index.php';</SCRIPT>";
    }
?>