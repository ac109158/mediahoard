<html>
<head>
    <title>UPloading example</title>
</head>
<body> 
        <?php
        if (isset( $_FILES['file']) )  
        {
            echo "Upload: " . $_FILES["file"]["name"] . "<br>";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br/>";

            $allowed =  array('gif','png' ,'jpg');
            $filename = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            echo $ext = pathinfo($name, PATHINFO_EXTENSION);
            if( !in_array($ext,$allowed) ) 
            {
                echo 'error<br>';
            }
 
            //copy file to better location other than temp
            echo $name = preg_replace("/[^A-Z0-9._-]/i", "_", $name);
            echo "<br />";
            echo $destination = "upload/" . $name;
            echo "<br />";
 
 
            //may want to see if it already exists before we overwrite though
 
            if (file_exists($destination)) 
            {
                echo "File already exists <br/>";
                exit;
            } 
            echo '>>>' . $response = move_uploaded_file($filename, $destination);
            if ($response) 
            {
                //change permissions
                chmod($destination, 0644);
                //echo "Chmodded $destination to 0644";
                //connect to database and store the path in there
                echo $conn = mysqli_connect('mysql.cs.dixie.edu', 'acook', 'acook', 'Victory83');
                echo  $query = "INSERT INTO files (file_path, name) VALUES ('$destination', '$name')";
                $results = mysqli_query($conn, $query);
                if (mysqli_connect_errno() ) 
                { 
                  echo ('Connect failed: '. mysqli_connect_error());
                }
                if (mysqli_affected_rows($conn) > 0) 
                {
                    echo "File saved successfully<br/>";
                }
                else 
                {
                echo "Could not copy<br/>";
                }
            }
        }
        ?>
 
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="file">Filename:</label>
            <input type="file" name="file" id="file"><br>
            <input type="submit" name="submit" value="Submit">
        </form>
 
        <?php
        //always display a list of files
        /*         * ****************************************
         * *************************************** */
        $conn = mysqli_connect('mysql.cs.dixie.edu', 'acook', 'acook', 'Victory83');
        $query = "SELECT * FROM files";
        $results = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($results)) 
        {
            echo "<p>File:<a href=./" . $row['path'] . ">" . $row['name'] . "</a></p>";
        }
        ?>
 
 
    </body>
</html>