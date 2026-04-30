<?php 

class API {
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

    public function HandleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'GET') {

        }

        else if ($method === 'POST') {

        }

        else {

        }
    }
}
