<?php
    include('connection.php');

    if (isset($_POST['key'])){
    
        if($_POST['key'] == 'log'){
            $username = $_POST['username'];
            $pass = $_POST['pass'];

            $query = mysqli_query($conn,"SELECT * FROM `user` WHERE username = '$username' AND password = '$pass' ");
            
            if(mysqli_num_rows($query) == 0) {
                echo "ERROR";
            } else {
                echo "OK";
            }
        }

        if($_POST['key'] == 'reg'){
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = mysqli_query($conn,"SELECT * FROM `user` WHERE username = '$username' AND password = '$password'");
            
            if(mysqli_num_rows($query) == 0) {
                $sql="INSERT INTO `user` (`fullname`, `username`, `password`) VALUES ('$name', '$username', '$password')";
		
                if ($conn->query($sql) === TRUE) {
                    echo 'OK';
                } else {
                    echo "Error while saving user information";
                }
            } else {
                echo 'User already exists.';
            }
        }

        mysqli_close($conn);
    }
?>