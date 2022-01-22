<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if(isset($_POST['submit'])){
    require_once('db_connect.php');
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $filename = $_FILES["b_header"]["name"];
    $tempname = $_FILES["b_header"]["tmp_name"];    
    $folder = "assets/img/blog-headers/".$filename;
    $content = mysqli_real_escape_string($con,$_POST['editor']);
    $aid = $_POST['a_id'];
    $cat = test_input($_POST["category"]);
    $msg = "";
    $add = "";

    $check = getimagesize($_FILES["b_header"]["tmp_name"]);
    if($check != false) {

        //If already exsists check
        if (file_exists($folder)) {
            echo "<script>alert('Sorry, file already exists.');document.location='dashboard.php';</SCRIPT>";
        }
        
        $sql = "INSERT INTO `blog`(`title`, `content`, `auth-id`, `cat-id`,`Image_name`) values('$title','$content',$aid,$cat,'$filename');";
        $execute = mysqli_query($con,$sql);
        if(!$execute){
            $add = "Failed to Query";
        }
        else{
            $add = "Success in Query.";
        }
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }

        echo "<script>alert('$msg.$add');document.location='dashboard.php';</SCRIPT>";
    }
    // $myfile = fopen("testfile.html", "w");
    // fwrite($myfile,$content);

}
?>