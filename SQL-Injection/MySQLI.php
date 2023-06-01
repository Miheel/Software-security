<?php

class mysqliDBIO
{

    private ?mysqli $conn;
    private ?mysqli_stmt $stmt;

    public function __construct(string $host, string $dbname, ?string $username = null, ?string $password = null)
    {
        $this->conn = new mysqli($host, $username, $password, $dbname);
    }

    function __destruct()
    {
        //close database
        $this->conn->close();
        $this->stmt->close();
    }

    public function checkUserCredentials(string $user, string $pass)
    {
        // Create prepared SQL statement and bind valiables to placeholders
        $this->stmt = $this->conn->prepare("SELECT * FROM users WHERE Username = ? AND Password = ?");
        $this->stmt->bind_param("ss", $user, $pass);
        // Execute SQL statement
        $this->stmt->execute();

        // Get next row form resultset and return 
        return $this->stmt->fetch();
    }
}
