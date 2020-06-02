<?php

    function OpenCon()
    {
        $dbhost = "sql12.freemysqlhosting.net";
        $dbuser = "sql12344952";
        $dbpass = "IUzQZgRIQP";
        $db = "sql12344952";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
            
        return $conn;
    }

    //$connection = new mysqli("localhost", "root", "", "midtrans_dummy");
    //phpinfo();

    // if ($connection -> connect_errno) {
    //     echo "Failed to connect to MySQL: " . $connection -> connect_error;
    //     exit();
    //   }

    function storeToDatabase($grossAmount){

        global $conn;

        //gross amount in string
        $ga = strval($grossAmount);
        echo $ga;
        mysqli_query($conn, "INSERT INTO transactions VALUES ('', $ga)");
        echo "jalanin fungsi insert";
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