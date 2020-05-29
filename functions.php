<?php
    $connection = new mysqli("localhost", "root", "", "midtrans_dummy");
    //phpinfo();

    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $connection -> connect_error;
        exit();
      }

    function storeToDatabase($grossAmount){

        global $connection;

        //gross amount in string
        $ga = strval($grossAmount);
        echo $ga;
        mysqli_query($connection, "INSERT INTO transactions VALUES ('', $ga)");

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