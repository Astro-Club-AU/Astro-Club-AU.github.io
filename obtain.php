<?php
    require_once('db_connect.php');
    $result = mysqli_query($con,"SELECT * FROM blog");
?>



<html>
    <head>
        <title>Blog</title>
    </head>
    <body>
        <?php
            while($row = mysqli_fetch_array($result)){
                echo "<h1>". $row['title'] . "</h1>";
                echo $row['content'];
            }
        ?>
    </body>
</html>