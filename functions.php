<?php
    $connection = mysqli_connect("localhost", "root", "", "midtrans_dummy");

    function storeToDatabase($grossAmount){

        global $connection;
        
        mysqli_query($connection, "INSERT INTO transactions VALUES ('',$grossAmount)");
        echo mysqli_affected_rows($connection);
        return mysqli_affected_rows($connection);
    }

?>