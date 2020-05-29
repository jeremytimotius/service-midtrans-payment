<?php
    $connection = new mysqli("", "", "", "midtrans_dummy") or die('faileld: ' . $connection->error);

    //phpinfo();

    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $connection -> connect_error;
        exit();
      }

    function storeToDatabase($grossAmount){

        global $connection;

        $ga = strval($grossAmount);
        echo $ga;
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