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
            http_response_code(500);
            exit;
        }    
    }

    public function HandleRequest() {
        header("Content-Type: application/json; charset=UTF-8");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'GET') {
            $this->Read();
        }

        else if ($method === 'POST') {
           $this->Create();
        }

        else {
            http_response_code(405);
            exit;
        }
    }

    public function Create() {
        $oid = $_POST['oid'];
        $name = $_POST['name'] ?? null;
        $comment = $_POST['comment'];

        if (empty($oid) || strlen($oid) > 32 || !ctype_alnum($oid)) { {
            http_response_code(400);
            exit;
        }

        if (!empty($name) && $name->strlen() > 64) {
            http_response_code(400);
            exit;
        }
        
        if (empty($comment)) {
            http_response_code(400);
            exit;
        }

        $sql = "INSERT INTO tComments (objectId, name, comment) VALUES ('$oid', '$name', '$comment')";
        http_response_code(201);
        exit;
    }    

    public function Read() {

    }
    }

