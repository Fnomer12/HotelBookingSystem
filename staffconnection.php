<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "STAFF_TRACK";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if ($conn){
            echo"connected successfully";
        }
        else{
            echo "Failed";
        }
?>