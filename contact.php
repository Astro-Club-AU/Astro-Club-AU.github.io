<?php
    require_once('db_connect.php');

    if(isset($_POST['end'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $sub = $_POST['subject'];
        $msg = $_POST['message'];
        $add = "";
        $sql = "INSERT INTO `contact`(`Name`, `Email`, `Subject`, `Message`) VALUES('$name','$email','$sub','$msg')";

        if (mysqli_query($con, $sql)) {
            //Do Nothing
            $add =" Thank You!";
        } else {
            $add = "Failed to Query";
        }
        echo "<script>alert('$add');document.location='contact.html';</script>";
    }
?>

