<?php    
    require_once('db_connect.php');
    session_start();
    if(isset($_POST['login'])){
       
        $email = $_POST['email'];
        $pass = md5($_POST['pass']);

        if($result = mysqli_query($con,"SELECT * FROM login")){
            $rowcount=mysqli_num_rows($result);
        }
        while($row = mysqli_fetch_array($result)){
            if($email == $row['Email'] && $pass == md5($row['Password'])){
                $_SESSION['user'] = $email;
                $_SESSION['password'] = $pass;
                header("Location: dashboard.php");
                exit;
            }
        }
        header("location:login.php?msg=failed");
    }
    else{
        header("location:login.php?msg=failed");
    }

    ?>