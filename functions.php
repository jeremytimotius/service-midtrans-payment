<?php
    $connection = new mysqli("127.0.0.1 ", "root", "", "midtrans_dummy") or die('faileld: ' . $connection->error);

    function storeToDatabase($grossAmount){

        global $connection;

        $ga = strval($grossAmount);

        mysqli_query($connection, "INSERT INTO transactions VALUES ('', $ga)");
        echo "asd";

        return mysqli_affected_rows($connection);
    }

    function getData(){
        global $connection;

        $query = "SELECT * FROM transactions";
    
        $result = mysqli_query($connection, $query);
        $fetched = mysqli_fetch_assoc($result);
        
        var_dump($fetched);

        return $fetched;
    }

?>