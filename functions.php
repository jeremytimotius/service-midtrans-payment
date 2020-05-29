<?php
    $connection = mysqli_connect("localhost", "root", "", "midtrans_dummy");

    function storeToDatabase($grossAmount){

        global $connection;

        $ga = strval($grossAmount);

        mysqli_query($connection, "INSERT INTO transactions VALUES ('', $ga)");
        echo mysqli_affected_rows($connection);
        return mysqli_affected_rows($connection);
    }

?>