<?php 

class API {
    private $servername = "brighton";
    private $username = "jmb181_commentuser";
    private $password = "str0ngpassw0rd";
    private $db = "jmb181_VAMuseumComments";
    public $conn = null;

    public function __construct() {
        try {
            $this->conn = new mysqli(
                $this->servername,
                $this->username,
                $this->password,
                $this->db
            );
        } catch (mysqli_sql_exception $e) {
            http_response_code(500);
            exit;
    }
}

    public function HandleRequest() {
        header("Content-Type: application/json; charset=UTF-8");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'GET') {
            $this->read();
        }

        else if ($method === 'POST') {
           $this->create();
        }

        else {
            http_response_code(405);
            exit;
        }
    }

    public function create() {

        $this->responseCode = 201; 

        if (isset($_POST['oid']) && isset($_POST['comment']) && isset($_POST['name'])) {
            $oid = trim($_POST['oid']);
            $comment = trim($_POST['comment']);
            $name = trim($_POST['name']);
        }
        else {
            $this->responseCode = 400;
        }

        if (strlen($oid) > 32 || !ctype_alnum($oid)) { 
            $this->responseCode = 400;
        }

        if (!empty($name) && (strlen($name) < 1 || strlen($name) > 64)) {
            http_response_code(400);
            exit;
        }
        
        if (empty($comment)) {
            http_response_code(400);
            exit;
        }

            $stmt = $this->conn->prepare("INSERT INTO tComments (oid, name, comment) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $oid, $name, $comment);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                header("Content-Type: application/json; charset=UTF-8");
                echo json_encode($oid);
            } else {
                $this->responseCode = 500;
            }

        };
    }
      

    public function read() {

        private $responseCode = 200;

        if (isset($_POST['oid'])) {
            $oid = trim($_POST['oid']);
        }

        else {
            $responseCode = 400;
        }

        if (strlen($oid) > 32 || !ctype_alnum($oid)) { 
            $responseCode = 400;
        }
        if ($responseCode == 200) {
            $stmt = $this->conn->prepare("SELECT * FROM tComments WHERE oid = ?");
            $stmt->bind_param("s", $oid);
            $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            http_response_code(200);
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $row['cDate'] = date('d F Y', strtotime($row['cDate']));
                $rows[] = $row;
            }
            echo json_encode($rows);
        } else {
            http_response_code(204);
        }
        exit;
}
}

$api = new API();
$api->HandleRequest();
