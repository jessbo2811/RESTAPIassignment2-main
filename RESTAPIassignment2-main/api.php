<?php 

class Database {
    private $servername = "brighton";
    private $username = "jmb181_commentuser";
    private $password = "str0ngpassw0rd";
    private $db = "jmb181_VAMuseumComments";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->db
        );

    if ($this->conn->connect_errno) {
        die("Connection failed: " . $this->conn->connect_error);
    }    
    }
}

class Create {
    private $oid = readline('Object ID: ');
    private $name = readline('Name: ');
    private $comment = readLine('Comment: ');

    setcookie($name, $comment);
}