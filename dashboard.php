<?php
  session_start();
  if(!(isset($_SESSION['user']) && isset($_SESSION['password']))){
    header("location:login.php?msg=failed");
  }
  $user = $_SESSION['user']; 
  require_once('db_connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="-1" />
  
  <title>Blog</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
    <link href="assets/img/astro1.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container">

      <div class="logo float-left">
        <h1 class="text-light"><a href="index1.php"><span>Astro Club</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu float-right d-none d-lg-block">
        <ul>
          <li><a href="#Author">Author</a></li>
          <li><a href="#Upcoming_Events">Upcoming Events</a></li>
          <li><a href="#Completed_Events">Completed Events</a></li>
          <li><a href="#Login">Login</a></li>
          <li><a href="#Team_Members">Team</a></li>
          <li><a href="#Alumni">Alumni</a></li>
          <li><a href="#Category">Category</a></li>
          <li><a href="publish1.php">Proxima Posts</a></li>
          <!-- <li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Drop Down 2</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
              <li><a href="#">Drop Down 5</a></li>
            </ul>
          </li> -->
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- Author Section -->
    <section id="Author">
      
      <div class="mx-auto details" >
      <h2 style="text-align: center;">Author Details</h2>
        <form method="POST" action="updatedb.php">
        <div class="form-group">
            <label for="name">Author ID</label>
            <input type="text" name="auth_id" class="form-control" id="exampleFormControlInput1" placeholder="Use only when updating and Deleting">
          </div>

          <div class="form-group">
            <label for="name">Author Name</label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Name">
          </div>
          
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Author Description</label>
            <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
          </div>
          <button class="btn btn-success" type="submit" name="auth_add">Add</button>
          <button  class="btn btn-dark" type="submit" name="auth_update">Update</button>
          <button  class="btn btn-danger" type="submit" name="auth_delete">Delete</button>
          <button type="button"  class="btn btn-primary" name="auth_display" data-toggle="modal" data-target="#myModal">Display</button>
        </form>

        <!-- Author Modal -->
        <div class="modal" id="myModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Modal Heading</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if($result = mysqli_query($con,"SELECT * FROM blogsters")){

                  while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>". $row['id']. "</td>";
                    echo "<td>". $row['auth-name']. "</td>";
                    echo "<td>". $row['Description']. "</td>";
                    echo "</tr>";
                  }
                }
            
                ?>
              
              </tbody>
            </table>
            </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
          </div>

      </div>

    </section><!-- End author section -->

    <!-- Upcoming Events -->
    <section id="Upcoming_Events">
      
      <div class="mx-auto details" >
      <h2 style="text-align: center;">Upcoming Events</h2>
        <form method="POST" action="updatedb.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Event ID</label>
            <input type="text" name="up_id" class="form-control" id="exampleFormControlInput1" placeholder="Use only when updating and Deleting">
          </div>
          <div class="form-group">
            <label for="name">Event Name</label>
            <input type="text" name="uevent_name" class="form-control" id="exampleFormControlInput1" placeholder="Name">
          </div>
          
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Event Description</label>
            <textarea name="uevent_desc" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Event Image</label>
            <input type="file" class="form-control" name="uevent_file" id="fileToUpload" value=""/>
          </div>
          <button class="btn btn-success" type="submit" name="uevent_add">Add</button>
          <button  class="btn btn-dark" type="submit" name="uevent_update">Update</button>
          <button  class="btn btn-danger" type="submit" name="uevent_delete">Delete</button>
          <button  type="button"  class="btn btn-primary" name="uevent_display" data-toggle="modal" data-target="#upModal">Display</button>
        </form>

        <!-- Upcoming Events Modal -->
      <div class="modal" id="upModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                  <table class="table">
            <thead>
              <tr class="utable">
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image Name</th>
              </tr>
            </thead>
            <tbody style="overflow:hidden">
              <?php
              if($result = mysqli_query($con,"SELECT * FROM upcoming_events")){

                while($row = mysqli_fetch_array($result)){
                  echo "<tr class='utable'>";
                  echo "<td>". $row['id']. "</td>";
                  echo "<td>". $row['Name']. "</td>";
                  echo "<td>". $row['Description']. "</td>";
                  echo "<td>". $row['Image_name']. "</td>";
                  echo "</tr>";
                }
              }
          
              ?>
            
            </tbody>
          </table>
          </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
        </div>

    </div>
      </div>
    </section><!-- End Upcoming Events section -->

    <!-- Completed Events -->
    <section id="Completed_Events">
      
      <div class="mx-auto details" >
      <h2 style="text-align: center;">Completed Events</h2>
        <form method="POST" action="updatedb.php"  enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Event ID</label>
            <input type="text" name="com_id" class="form-control" id="exampleFormControlInput1" placeholder="Use only when updating and Deleting">
          </div>
          <div class="form-group">
            <label for="name">Event Name</label>
            <input type="text" name="cevent_name" class="form-control" id="exampleFormControlInput1" placeholder="Name">
          </div>
          
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Event Description</label>
            <textarea name="cevent_desc" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Event Image</label>
            <input type="file" class="form-control" name="cevent_file" id="fileToUpload">
          </div>
          <button class="btn btn-success" type="submit" name="cevent_add">Add</button>
          <button  class="btn btn-dark" type="submit" name="cevent_update">Update</button>
          <button  class="btn btn-danger" type="submit" name="cevent_delete">Delete</button>
          <button  type="button"  class="btn btn-primary" name="cevent_display" data-toggle="modal" data-target="#comModal">Display</button>
        </form>

      <!-- Completed Events Modal -->
      <div class="modal" id="comModal">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                  <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image Name</th>
              </tr>
            </thead>
            <tbody style="overflow:hidden">
              <?php
              if($result = mysqli_query($con,"SELECT * FROM completed_events")){

                while($row = mysqli_fetch_array($result)){
                  echo "<tr>";
                  echo "<td>". $row['id']. "</td>";
                  echo "<td>". $row['Name']. "</td>";
                  echo "<td>". $row['Description']. "</td>";
                  echo "<td>". $row['Image_name']. "</td>";
                  echo "</tr>";
                }
              }
          
              ?>
            
            </tbody>
          </table>
          </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
        </div>

    </div>
      
      </div>
    </section><!-- End Completed Events section -->
    
    <section id="Login">
      
      <div class="mx-auto details" >
      <h2 style="text-align: center;">Login</h2>
        <form method="POST" action="updatedb.php">
        <div class="form-group">
            <label for="name">Email</label>
            <input type="text" name="lemail" class="form-control" id="exampleFormControlInput1" placeholder="Use this to update and delete">
          </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="lname" class="form-control" id="exampleFormControlInput1" placeholder="Name">
          </div>
          

          <div class="form-group">
            <label for="name">Password</label>
            <input type="password" name="lpassword" class="form-control" id="exampleFormControlInput1" placeholder="Password">
          </div>
          
          
          <button class="btn btn-success" type="submit" name="ladd">Add</button>
          <button  class="btn btn-dark" type="submit" name="lupdate">Update</button>
          <button  class="btn btn-danger" type="submit" name="ldelete">Delete</button>
          <button  type="button" data-toggle="modal" data-target="#lModal"  class="btn btn-primary" name="ldisplay">Display</button>
        </form>
        <!-- Login Modal -->
      <div class="modal" id="lModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                  <table class="table">
            <thead>
              <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Passowrd</th>
              </tr>
            </thead>
            <tbody style="overflow:hidden">
              <?php
              if($result = mysqli_query($con,"SELECT * FROM login")){

                while($row = mysqli_fetch_array($result)){
                  echo "<tr>";
                  echo "<td>". $row['Email']. "</td>";
                  echo "<td>". $row['Name']. "</td>";
                  echo "<td>". $row['Password']. "</td>";
                  echo "</tr>";
                }
              }
          
              ?>
            
            </tbody>
          </table>
          </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
        </div>

    </div>
      </div>
    </section><!-- End New Login section -->


    <section id="Team_Members">
      
      <div class="mx-auto details" >
      <h2 style="text-align: center;">Team Members</h2>
        <form method="POST" action="updatedb.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Member ID</label>
            <input type="text" name="mem_id" class="form-control" id="exampleFormControlInput1" placeholder="Use only when updating and Deleting">
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="team_name" class="form-control" id="exampleFormControlInput1" placeholder="Name">
          </div>
          <div class="form-group">
            <label for="name">Designation</label>
            <input type="text" name="team_desg" class="form-control" id="exampleFormControlInput1" placeholder="Designation">
          </div>
          
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Member Description</label>
            <textarea name="team_desc" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Member Image</label>
            <input type="file" class="form-control" name="team_file" id="fileToUpload">
          </div>
          <button class="btn btn-success" type="submit" name="t_add">Add</button>
          <button  class="btn btn-dark" type="submit" name="t_update">Update</button>
          <button  class="btn btn-danger" type="submit" name="t_delete">Delete</button>
          <button  type="button" data-toggle="modal" data-target="#memModal" class="btn btn-primary" name="t_display">Display</button>
        </form>
      </div>

        <!-- Team members Modal -->
        <div class="modal" id="memModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                  <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image Name</th>
                <th>Designation</th>
              </tr>
            </thead>
            <tbody style="overflow:hidden">
              <?php
              if($result = mysqli_query($con,"SELECT * FROM team")){

                while($row = mysqli_fetch_array($result)){
                  echo "<tr>";
                  echo "<td>". $row['id']. "</td>";
                  echo "<td>". $row['Name']. "</td>";
                  echo "<td>". $row['Description']. "</td>";
                  echo "<td>". $row['Image_name']. "</td>";
                  echo "<td>". $row['Designation']. "</td>";
                  echo "</tr>";
                }
              }
          
              ?>
            
            </tbody>
          </table>
          </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
        </div>

    </div>
    </section>

    <section id="Alumni">
      
      <div class="mx-auto details" >
      <h2 style="text-align: center;">Alumni</h2>
        <form method="POST" action="updatedb.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Alumni ID</label>
            <input type="text" name="alumni_id" class="form-control" id="exampleFormControlInput1" placeholder="Use only when updating and Deleting">
          </div>
          <div class="form-group">
            <label for="a_name">Name</label>
            <input type="text" name="alumni_name" class="form-control" id="exampleFormControlInput1" placeholder="Name">
          </div>
          <div class="form-group">
            <label for="a_name">Designation</label>
            <input type="text" name="alumni_desg" class="form-control" id="exampleFormControlInput1" placeholder="Designation">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Alumni Description</label>
            <textarea name="alumni_desc" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
          </div>

         

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Alumni Image</label>
            <input type="file" class="form-control" name="alumni_file" id="fileToUpload">
          </div>
          <button class="btn btn-success" type="submit" name="a_add">Add</button>
          <button  class="btn btn-dark" type="submit" name="a_update">Update</button>
          <button  class="btn btn-danger" type="submit" name="a_delete">Delete</button>
          <button  type="button" data-toggle="modal" data-target="#alModal" class="btn btn-primary" name="a_display">Display</button>
        </form>

         <!-- Alumni Modal -->
         <div class="modal" id="alModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                  <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image Name</th>
                <th>Designation</th>
              </tr>
            </thead>
            <tbody style="overflow:hidden">
              <?php
              if($result = mysqli_query($con,"SELECT * FROM alumni")){

                while($row = mysqli_fetch_array($result)){
                  echo "<tr>";
                  echo "<td>". $row['id']. "</td>";
                  echo "<td>". $row['Name']. "</td>";
                  echo "<td>". $row['description']. "</td>";
                  echo "<td>". $row['Image_name']. "</td>";
                  echo "<td>". $row['Designation']. "</td>";
                  echo "</tr>";
                }
              }
          
              ?>
            
            </tbody>
          </table>
          </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
        </div>
      </div>
    </section>


    <section id="Category">
      
      <div class="mx-auto details" >
      <h2 style="text-align: center;">Category</h2>
        <form method="POST" action="updatedb.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Category ID</label>
            <input type="text" name="cat_id" class="form-control" id="exampleFormControlInput1" placeholder="Use only when updating and Deleting">
          </div>
          <div class="form-group">
            <label for="a_name">Catgeory Name</label>
            <input type="text" name="cat_name" class="form-control" id="exampleFormControlInput1" placeholder="Name">
          </div>
          
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Category Image</label>
            <input type="file" class="form-control" name="cat_file" id="fileToUpload">
          </div>
          <button class="btn btn-success" type="submit" name="c_add">Add</button>
          <button  class="btn btn-dark" type="submit" name="c_update">Update</button>
          <button  class="btn btn-danger" type="submit" name="c_delete">Delete</button>
          <button  type="button" data-toggle="modal" data-target="#clModal" class="btn btn-primary" name="c_display">Display</button>
        </form>

         <!-- Category Modal -->
         <div class="modal" id="clModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                  <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image Name</th>
              </tr>
            </thead>
            <tbody style="overflow:hidden">
              <?php
              if($result = mysqli_query($con,"SELECT * FROM category")){

                while($row = mysqli_fetch_array($result)){
                  echo "<tr>";
                  echo "<td>". $row['cat-id']. "</td>";
                  echo "<td>". $row['cat-name']. "</td>";
                  echo "<td>". $row['cat-image']. "</td>";
                  echo "</tr>";
                }
              }
          
              ?>
            
            </tbody>
          </table>
          </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
        </div>
      </div>
    </section>
  </main>


  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>