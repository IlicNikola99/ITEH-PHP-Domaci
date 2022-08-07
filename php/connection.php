<?php
     $conn = new mysqli('localhost', 'root', '');
    
     if(!$conn) {
         die('Failed connecting to the server!');
     }
 
     if(!mysqli_select_db($conn, 'itehdomaci')) {
         echo 'Database does not exist!';
     }
?>