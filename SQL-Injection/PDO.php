<?php

class PDODBIO
{

    private ?PDO $conn;
    private ?PDOStatement $sql;

    public function __construct(string $driver, string $host, string $dbname, ?string $username = null, ?string $password = null)
    {
        //try {
            //mysql:host=localhost;dbname=test', "test", "frest"
            //connect to the databse and set attributes to use prepared statements
            $dns = $driver . ':host=' . $host . ';dbname=' . $dbname;
            $this->conn = new PDO($dns, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //to set errmode_exeption is usefull in debugging to catch exeption ina try catch block
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //} catch (PDOException $e) {
            //print "Error failed to connect: " . $e->getMessage() . "</br>";
        //}
    }

    function __destruct()
    {
        //close database
        $this->sql = null;
        $this->conn = null;
    }

    public function checkUserCredentials(string $user, string $pass)
    {
        // Create prepared SQL statement and bind valiables to placeholders
        $this->sql = $this->conn->prepare("SELECT * FROM users WHERE Username = :user AND Password = :pass");
        $this->sql->bindParam(':user', $user);
        $this->sql->bindParam(':pass', $pass);
        // Execute SQL statement
        $this->sql->execute();

        // Get next row form resultset and return 
        return $this->sql->fetch();
    }

    public function callinfo(string $timeStamp, string $ip, string $callURL)
    {
        $this->sql = $this->conn->prepare("INSERT INTO `calls`(`Timestamp`, `Ip`, `CallURL`) VALUES (:timeStampp, :Ip, :callURL)");
        $this->sql->bindParam(':timeStampp', $timeStamp);
        $this->sql->bindParam(':Ip', $ip);
        $this->sql->bindParam(':callURL', $callURL);
        $this->sql->execute();
    }
}
