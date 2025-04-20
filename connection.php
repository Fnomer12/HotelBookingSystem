<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "BASIN_USER_DATABASE";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if ($conn){
            echo"connected successfully";
        }
        else{
            echo "Failed";
        }
?>