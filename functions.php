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


    function storeToDatabase($grossAmount){

        global $conn;

        //gross amount in string
        $ga = strval($grossAmount);
        mysqli_query($conn, "INSERT INTO transactions VALUES ('', $ga)");

        //klo affected rowsnya itu 1, return idnya, klo engga echo aja abis itu exit();
        //udah harusny itu aja.
        if(mysqli_affected_rows($conn) == 1){
            return mysqli_insert_id($conn);
        } else{ 
            echo "gaada id yg diinsert";
            exit();
        } 
    }
?>