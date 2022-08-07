<?php
     $conn = new mysqli('localhost', 'root', '1981EetFuk');
    
     if(!$conn) {
         die('Failed connecting to the server!');
     }
 
       
     if($conn) {
        echo('Successfully connected to the server!\n');
    }

     if(!mysqli_select_db($conn, 'itehdomaci')) {
         echo 'Database does not exist!';
     }

     if(mysqli_select_db($conn, 'itehdomaci')) {
        echo 'Database found!';
    }
?>