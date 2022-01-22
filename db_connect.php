<?php
    $server_name = 'localhost';
    $server_user = 'root';
    $server_pass = '';
    $db_name = 'ckeditor';

    $con = mysqli_connect($server_name,$server_user,$server_pass,$db_name);

    if(!$con){
        
        header("Location:maintanence/index.html");
        //echo "Failed" ;
        exit(); 
    }
    ?>