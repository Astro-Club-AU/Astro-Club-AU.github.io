<?php    
    require_once('db_connect.php');

    // Author ADD
    if(isset($_POST['auth_add'])){
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        if(empty($name) || empty($desc)) {
            echo "<script>alert('Error: Cant be empty');</script>";
            exit;
        }
        $sql = "INSERT INTO `blogsters`(`auth-name`, `Description`) VALUES ('$name','$desc')";
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('New record created successfully');document.location='dashboard.php';</SCRIPT>";
          } else {
            echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con)."');</script>";
          } 
    }
    // Author Update
    else if(isset($_POST['auth_update'])){
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $id = $_POST['auth_id'];
        $sql="";
        $fail = 0;
        if(empty($name) && empty($desc)){
            $fail = 1;
        } 
        else if(empty($name) && !empty($desc)){
            $sql = "UPDATE `blogsters` SET `Description`= '$desc' WHERE `id`= $id";
        }

        else if(empty($desc) && !empty($name)){
            $sql = "UPDATE `blogsters` SET `auth-name`= '$name' WHERE `id`= $id";   
        }
        else{
            $sql = "UPDATE `blogsters` SET `auth-name`= '$name',`Description`= '$desc' WHERE `id`= $id";
        }
        
        if($fail == 0){
            if (mysqli_query($con, $sql)) {
                echo "<script>alert('Record Updated successfully');document.location='dashboard.php';</SCRIPT>";
            } else {
                echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con)."');</script>";
            }
        }
        else{
            echo "<script>alert('Both Can't be Empty');document.location='dashboard.php';</SCRIPT>";
        }
    }
    //Author Delete
    else if(isset($_POST['auth_delete'])){
        $id = $_POST['auth_id'];
        if(empty($id)){
            echo "<script>alert('Cannot be empty');document.location='dashboard.php';</SCRIPT>";
            exit();
        }

        $sql = "DELETE FROM `blogsters` WHERE id=$id";
        if(mysqli_query($con, $sql)) {
            echo "<script>alert('Record Updated successfully');document.location='dashboard.php';</SCRIPT>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con)."');</script>";
        }
    }
                                                //Upcoming Events
    // ------------------------------------------------------------------------------------------------------------------//

    //Upcoming Events ADD
    else if(isset($_POST['uevent_add'])){

        $name = $_POST['uevent_name'];
        $desc = $_POST['uevent_desc'];
        $filename = $_FILES["uevent_file"]["name"];
        $tempname = $_FILES["uevent_file"]["tmp_name"];    
        $folder = "assets/img/upcoming_events/".$filename;
        $msg = "";
        $add = "";
        
        $check = getimagesize($_FILES["uevent_file"]["tmp_name"]);

        //If file is an image check!
        if($check !== false) {

            //If already exsists check
            if (file_exists($folder)) {
                echo "<script>alert('Sorry, file already exists.');document.location='dashboard.php';</SCRIPT>";
            }

            else{
                $sql = "INSERT INTO `upcoming_events`(`Name`, `Description`, `Image_name`) VALUES ('$name','$desc','$filename')";
                if (mysqli_query($con, $sql)) {
                    $add = "Record added successfully";
                } else {
                    $add = "Failed to Query";
                }

                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }

                echo "<script>alert('$msg.$add');document.location='dashboard.php';</SCRIPT>";
            }
        }
        else {
            echo "<script>alert('File is not an image.');document.location='dashboard.php';</SCRIPT>";
        }
    }

    //Upcoming event Update
    else if(isset($_POST['uevent_update'])){
        $id = $_POST['up_id'];
        $name = $_POST['uevent_name'];
        $desc = $_POST['uevent_desc'];
        $filename = $_FILES["uevent_file"]["name"];
        $tempname = $_FILES["uevent_file"]["tmp_name"];    
        $folder = "assets/img/upcoming_events/".$filename;
        $msg = "";
        $add = "";
        
        if(!empty($name)){
            $sql = "UPDATE `upcoming_events` SET `Name`= '$name' WHERE `id`= $id";
            if(!mysqli_query($con, $sql)) $add= "Error on Updation: Name";
            else $add = "";
        }
        if(!empty($desc)){
            $sql = "UPDATE `upcoming_events` SET `Description`= '$desc' WHERE `id`= $id";
            if(!mysqli_query($con, $sql)) $add = "Error on Updation: Description";
            else $add = "";
        }
        if(!empty($filename)){
            $check = getimagesize($_FILES["uevent_file"]["tmp_name"]);
            // Check if Image
            if($check !== false) {
                $sql = "UPDATE `upcoming_events` SET `Image_name`= '$filename' WHERE `id`= $id";
                if(!mysqli_query($con, $sql)) $add = "Error on Updation: Image";
                else $add = "";

                //Check if Exsists already if so delete
                if (file_exists($folder)) {
                    unlink($folder);
                }

                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }
                echo "<script>alert('$msg.$add');document.location='dashboard.php';</SCRIPT>";
            }
            else{
                echo "<script>alert('File is not an image.');document.location='dashboard.php';</SCRIPT>";
            }
        }
        echo "<script>alert('Update Successful');document.location='dashboard.php';</SCRIPT>";
    }
        
    //Upcoming Events Delete
    else if(isset($_POST['uevent_delete'])){
        $id = $_POST['up_id'];
        if(empty($id)){
            echo "<script>alert('Cannot be empty');document.location='dashboard.php';</SCRIPT>";
            exit();
        }

        $sql = "DELETE FROM `upcoming_events` WHERE id=$id";
        if(mysqli_query($con, $sql)) {
            echo "<script>alert('Record Updated successfully');document.location='dashboard.php';</SCRIPT>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con)."');</script>";
        }
    }
                                                //Completed Events
// ------------------------------------------------------------------------------------------------------------------//
    //Completed Events ADD
    else if(isset($_POST['cevent_add'])){

        $name = $_POST['cevent_name'];
        $desc = $_POST['cevent_desc'];
        $filename = $_FILES["cevent_file"]["name"];
        $tempname = $_FILES["cevent_file"]["tmp_name"];    
        $folder = "assets/img/completed_events/".$filename;
        $msg = "";
        $add = "";
        
        $check = getimagesize($_FILES["cevent_file"]["tmp_name"]);

        //If file is an image check!
        if($check != false) {

            //If already exsists check
            if (file_exists($folder)) {
                echo "<script>alert('Sorry, file already exists.');document.location='dashboard.php';</SCRIPT>";
            }

            else{
                $sql = "INSERT INTO `completed_events`(`Name`, `Description`, `Image_name`) VALUES ('$name','$desc','$filename')";
                if (mysqli_query($con, $sql)) {
                    $add = "Record added successfully";
                } else {
                    $add = "Failed to Query";
                }

                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }

                echo "<script>alert('$msg.$add');document.location='dashboard.php';</SCRIPT>";
            }
        }
        else {
            echo "<script>alert('File is not an image.');document.location='dashboard.php';</SCRIPT>";
        }
    }

    //Completed event Update
    else if(isset($_POST['cevent_update'])){
        $id = $_POST['com_id'];
        $name = $_POST['cevent_name'];
        $desc = $_POST['cevent_desc'];
        $filename = $_FILES["cevent_file"]["name"];
        $tempname = $_FILES["cevent_file"]["tmp_name"];    
        $folder = "assets/img/completed_events/".$filename;
        $msg = "";
        $add = "";
        
        if(!empty($name)){
            $sql = "UPDATE `completed_events` SET `Name`= '$name' WHERE `id`= $id";
            if(!mysqli_query($con, $sql)) $add= "Error on Updation: Name";
            else $add = "";
        }
        if(!empty($desc)){
            $sql = "UPDATE `completed_events` SET `Description`= '$desc' WHERE `id`= $id";
            if(!mysqli_query($con, $sql)) $add = "Error on Updation: Description";
            else $add = "";
        }
        if(!empty($filename)){
            $check = getimagesize($_FILES["cevent_file"]["tmp_name"]);
            // Check if Image
            if($check !== false) {
                $sql = "UPDATE `completed_events` SET `Image_name`= '$filename' WHERE `id`= $id";
                if(!mysqli_query($con, $sql)) $add = "Error on Updation: Image";
                else $add = "";

                //Check if Exsists already if so delete
                if (file_exists($folder)) {
                    unlink($folder);
                }

                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }
                echo "<script>alert('$msg.$add');document.location='dashboard.php';</SCRIPT>";
            }
            else{
                echo "<script>alert('File is not an image.');document.location='dashboard.php';</SCRIPT>";
            }
        }
        echo "<script>alert('Update Successful');document.location='dashboard.php';</SCRIPT>";
    }
        
    //Upcoming Events Delete
    else if(isset($_POST['cevent_delete'])){
        $id = $_POST['com_id'];
        if(empty($id)){
            echo "<script>alert('Cannot be empty');document.location='dashboard.php';</SCRIPT>";
            exit();
        }

        $sql = "DELETE FROM `completed_events` WHERE id=$id";
        if(mysqli_query($con, $sql)) {
            echo "<script>alert('Record Updated successfully');document.location='dashboard.php';</SCRIPT>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con)."');</script>";
        }
    }


                                                //Team Members
// ------------------------------------------------------------------------------------------------------------------//
    //Team Members ADD
    else if(isset($_POST['t_add'])){

        $name = $_POST['team_name'];
        $desc = $_POST['team_desc'];
        $desg = $_POST['team_desg'];
        $filename = $_FILES["team_file"]["name"];
        $tempname = $_FILES["team_file"]["tmp_name"];    
        $folder = "assets/img/team/".$filename;
        $msg = "";
        $add = "";
        
        $check = getimagesize($_FILES["team_file"]["tmp_name"]);

        //If file is an image check!
        if($check != false) {

            //If already exsists check
            if (file_exists($folder)) {
                echo "<script>alert('Sorry, file already exists.');document.location='dashboard.php';</SCRIPT>";
            }

            else{
                $sql = "INSERT INTO `team`(`Name`, `Description`, `Image_name`,`Designation`) VALUES ('$name','$desc','$filename','$desg')";
                if (mysqli_query($con, $sql)) {
                    $add = "Record added successfully";
                } else {
                    $add = "Failed to Query";
                }

                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }

                echo "<script>alert('$msg.$add');document.location='dashboard.php';</SCRIPT>";
            }
        }
        else {
            echo "<script>alert('File is not an image.');document.location='dashboard.php';</SCRIPT>";
        }
    }

    //Team Members Update
    else if(isset($_POST['t_update'])){
        $id = $_POST['mem_id'];
        $name = $_POST['team_name'];
        $desc = $_POST['team_desc'];
        $filename = $_FILES["team_file"]["name"];
        $tempname = $_FILES["team_file"]["tmp_name"];    
        $folder = "assets/img/team/".$filename;
        $msg = "";
        $add = "";
        
        if(!empty($name)){
            $sql = "UPDATE `team` SET `Name`= '$name' WHERE `id`= $id";
            if(!mysqli_query($con, $sql)) $add= "Error on Updation: Name";
            else $add = "";
        }
        if(!empty($desc)){
            $sql = "UPDATE `team` SET `Description`= '$desc' WHERE `id`= $id";
            if(!mysqli_query($con, $sql)) $add = "Error on Updation: Description";
            else $add = "";
        }
        if(!empty($filename)){
            $check = getimagesize($_FILES["team_file"]["tmp_name"]);
            // Check if Image
            if($check !== false) {
                $sql = "UPDATE `team` SET `Image_name`= '$filename' WHERE `id`= $id";
                if(!mysqli_query($con, $sql)) $add = "Error on Updation: Image";
                else $add = "";

                //Check if Exsists already if so delete
                if (file_exists($folder)) {
                    unlink($folder);
                }

                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }
                echo "<script>alert('$msg.$add');document.location='dashboard.php';</SCRIPT>";
            }
            else{
                echo "<script>alert('File is not an image.');document.location='dashboard.php';</SCRIPT>";
            }
        }
        echo "<script>alert('Update Successful');document.location='dashboard.php';</SCRIPT>";
    }
        
    //Team Members Delete
    else if(isset($_POST['t_delete'])){
        $id = $_POST['mem_id'];
        if(empty($id)){
            echo "<script>alert('Cannot be empty');document.location='dashboard.php';</SCRIPT>";
            exit();
        }

        $sql = "DELETE FROM `team` WHERE id=$id";
        if(mysqli_query($con, $sql)) {
            echo "<script>alert('Record Updated successfully');document.location='dashboard.php';</SCRIPT>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con)."');</script>";
        }
    }


                                                    //Alumni
// ------------------------------------------------------------------------------------------------------------------//
    //Alumni ADD
    else if(isset($_POST['a_add'])){

        $name = $_POST['alumni_name'];
        $desc = $_POST['alumni_desc'];
        $desg = $_POST['alumni_desg'];
        $filename = $_FILES["alumni_file"]["name"];
        $tempname = $_FILES["alumni_file"]["tmp_name"];   
        $folder = "assets/img/Alumni/".$filename;
        $msg = "";
        $add = "";
        
        $check = getimagesize($_FILES["alumni_file"]["tmp_name"]);

        //If file is an image check!
        if($check != false) {

            //If already exsists check
            if (file_exists($folder)) {
                echo "<script>alert('Sorry, file already exists.');document.location='dashboard.php';</SCRIPT>";
            }

            else{
                $sql = "INSERT INTO `alumni`(`Name`, `Description`, `Image_name`,`Designation`) VALUES ('$name','$desc','$filename','$desg')";
                if (mysqli_query($con, $sql)) {
                    $add = "Record added successfully";
                } else {
                    $add = "Failed to Query";
                }

                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }

                echo "<script>alert('$msg.$add');document.location='dashboard.php';</SCRIPT>";
            }
        }
        else {
            echo "<script>alert('File is not an image.');document.location='dashboard.php';</SCRIPT>";
        }
    }

    //Alumni Update
    else if(isset($_POST['a_update'])){
        $id = $_POST['alumni_id'];
        $name = $_POST['alumni_name'];
        $desc = $_POST['alumni_desc'];
        $desg = $_POST['alumni_desg'];
        $filename = $_FILES["alumni_file"]["name"];
        $tempname = $_FILES["alumni_file"]["tmp_name"];    
        $folder = "assets/img/alumni/".$filename;
        $msg = "";
        $add = "";
        
        if(!empty($name)){
            $sql = "UPDATE `alumni` SET `Name`= '$name' WHERE `id`= $id";
            if(!mysqli_query($con, $sql)) $add= "Error on Updation: Name";
            else $add = "";
        }
        if(!empty($desg)){
            $sql = "UPDATE `alumni` SET `Designation`= '$desg' WHERE `id`= $id";
            if(!mysqli_query($con, $sql)) $add= "Error on Updation: Designation";
            else $add = "";
        }
        if(!empty($desc)){
            $sql = "UPDATE `alumni` SET `Description`= '$desc' WHERE `id`= $id";
            if(!mysqli_query($con, $sql)) $add = "Error on Updation: Description";
            else $add = "";
        }
        if(!empty($filename)){
            $check = getimagesize($_FILES["alumni_file"]["tmp_name"]);
            // Check if Image
            if($check !== false) {
                $sql = "UPDATE `alumni` SET `Image_name`= '$filename' WHERE `id`= $id";
                if(!mysqli_query($con, $sql)) $add = "Error on Updation: Image";
                else $add = "";

                //Check if Exsists already if so delete
                if (file_exists($folder)) {
                    unlink($folder);
                }

                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }
                echo "<script>alert('$msg.$add');document.location='dashboard.php';</SCRIPT>";
            }
            else{
                echo "<script>alert('File is not an image.');document.location='dashboard.php';</SCRIPT>";
            }
        }
        echo "<script>alert('Update Successful');document.location='dashboard.php';</SCRIPT>";
    }
        
    //Alumni Delete
    else if(isset($_POST['a_delete'])){
        $id = $_POST['alumni_id'];
        if(empty($id)){
            echo "<script>alert('Cannot be empty');document.location='dashboard.php';</SCRIPT>";
            exit();
        }

        $sql = "DELETE FROM `alumni` WHERE id=$id";
        if(mysqli_query($con, $sql)) {
            echo "<script>alert('Record Updated successfully');document.location='dashboard.php';</SCRIPT>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con)."');</script>";
        }
    }


                                                       //Login
// ------------------------------------------------------------------------------------------------------------------//
    //Alumni ADD
    else if(isset($_POST['ladd'])){
        $name = $_POST['lname'];
        $email = $_POST['lemail'];
        $pass = $_POST['lpassword'];
        $fail = 0;

        if($result = mysqli_query($con,"SELECT * FROM team"))
            while($row = mysqli_fetch_array($result))
                if($email == $row['Email']) $fail = 1;

        if($fail == 1){
            echo "<script>alert('Email ID exsists');document.location='dashboard.php';</SCRIPT>";
        }
        else{
            $sql = "INSERT INTO `login`(`Name`, `Email`, `Password`) VALUES('$name','$email','$pass')";
            if (mysqli_query($con, $sql)) {
                $add = "Record added successfully";
            } else {
                $add = "Failed to Query";
            }
            echo "<script>alert('$add');document.location='dashboard.php';</SCRIPT>";
        }
    }

    else if(isset($_POST['lupdate'])){
        $name = $_POST['lname'];
        $email = $_POST['lemail'];
        $pass = $_POST['lpassword'];
        $fail = 0;

        if(!empty($name)){
            $sql = "UPDATE `login` SET `Name`= '$name' WHERE `Email`= '$email'";
            if(!mysqli_query($con, $sql)) $add= "Error on Updation: Name";
            else $add = "Name Done.";
        }
        if(!empty($pass)){
            $sql = "UPDATE `login` SET `Password`= '$pass' WHERE `Email`= '$email'";
            if(!mysqli_query($con, $sql)) $add = "Error on Updation: Password";
            else $add =$add."Pass Done.";
        }
        echo "<script>alert('$add');document.location='dashboard.php';</SCRIPT>";

    }
    else if(isset($_POST['ldelete'])){
        $email = $_POST['lemail'];
        if(empty($email)){
            echo "<script>alert('Cannot be empty');document.location='dashboard.php';</SCRIPT>";
            exit();
        }

        $sql = "DELETE FROM `login` WHERE `Email`='$email' ";
        if(mysqli_query($con, $sql)) {
            echo "<script>alert('Record Updated successfully');document.location='dashboard.php';</SCRIPT>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con)."');</script>";
        }

    }




                                                       //Category
// ------------------------------------------------------------------------------------------------------------------//
    else if(isset($_POST['c_add'])){

        $name = $_POST['cat_name'];
        $filename = $_FILES["cat_file"]["name"];
        $tempname = $_FILES["cat_file"]["tmp_name"];    
        $folder = "assets/img/category/".$filename;
        $msg = "";
        $add = "";
        
        $check = getimagesize($_FILES["cat_file"]["tmp_name"]);

        //If file is an image check!
        if($check !== false) {

            //If already exsists check
            if (file_exists($folder)) {
                echo "<script>alert('Sorry, file already exists.');document.location='dashboard.php';</SCRIPT>";
            }

            else{
                $sql = "INSERT INTO `category`(`cat-name`, `cat-image`) VALUES ('$name','$filename')";
                if (mysqli_query($con, $sql)) {
                    $add = "Record added successfully";
                } else {
                    $add = "Failed to Query";
                }

                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }

                echo "<script>alert('$msg.$add');document.location='dashboard.php';</SCRIPT>";
            }
        }
        else {
            echo "<script>alert('File is not an image.');document.location='dashboard.php';</SCRIPT>";
        }
}
// Catgeory Update
else if(isset($_POST['c_update'])){
    $id = $_POST['cat_id'];
    $name = $_POST['cat_name'];
    $filename = $_FILES["cat_file"]["name"];
    $tempname = $_FILES["cat_file"]["tmp_name"];    
    $folder = "assets/img/category/".$filename;
    $msg = "";
    $add = "";
    
    if(!empty($name)){
        $sql = "UPDATE `category` SET `cat-name`= '$name' WHERE `cat-id`= $id";
        if(!mysqli_query($con, $sql)) $add= "Error on Updation: Name";
        else $add = "";
    }
 
    if(!empty($filename)){
        $check = getimagesize($_FILES["c_file"]["tmp_name"]);
        // Check if Image
        if($check !== false) {
            $sql = "UPDATE `category` SET `cat-image`= '$filename' WHERE `cat-id`= $id";
            if(!mysqli_query($con, $sql)) $add = "Error on Updation: Image";
            else $add = "";

            //Check if Exsists already if so delete
            if (file_exists($folder)) {
                unlink($folder);
            }

            if (move_uploaded_file($tempname, $folder))  {
                $msg = "Image uploaded successfully";
            }else{
                $msg = "Failed to upload image";
            }
            echo "<script>alert('$msg.$add');document.location='dashboard.php';</SCRIPT>";
        }
        else{
            echo "<script>alert('File is not an image.');document.location='dashboard.php';</SCRIPT>";
        }
    }
    echo "<script>alert('Update Successful');document.location='dashboard.php';</SCRIPT>";
}
    
//Category Delete
else if(isset($_POST['c_delete'])){
    $id = $_POST['cat_id'];
    if(empty($id)){
        echo "<script>alert('Cannot be empty');document.location='dashboard.php';</SCRIPT>";
        exit();
    }

    $sql = "DELETE FROM `category` WHERE `cat-id`=$id";
    if(mysqli_query($con, $sql)) {
        echo "<script>alert('Record Updated successfully');document.location='dashboard.php';</SCRIPT>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con)."');</script>";
    }
}



else{
    echo "<script>alert('Illegal Entry');</script>";
}









    ?>