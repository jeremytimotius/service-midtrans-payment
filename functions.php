<?php
    $connection = mysqli_connect("localhost", "root", "", "midtrans_dummy");

    function storeToDatabase($grossAmount){
        
        global $connection;
        mysqli_query($connection, "INSERT INTO transaction VALUES('', $grossAmount)");
        return mysqli_affected_rows($connection);
    }

?>