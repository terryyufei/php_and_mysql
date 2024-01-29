<?php
    // connect to db
    $conn = mysqli_connect("localhost","terry","test1234","baobei_pizza");

    // check the connection
    if (!$conn){
        echo"connection error: " . mysqli_connect_errno();
    }

?>
