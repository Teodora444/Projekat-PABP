<?php
include_once __DIR__ . '/CRUDInterface.php';

class Dobavljac implements CRUDInterface {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($data) {
        $naziv = $this->conn->real_escape_string($data['naziv']);
        $kontakt = $this->conn->real_escape_string($data['kontakt']);

        $sql = "INSERT INTO dobavljac (naziv, kontakt) 
                VALUES ('$naziv', '$kontakt')";
        return $this->conn->query($sql);
    }

    public function read() {
        return $this->conn->query("SELECT * FROM dobavljac");
    }
    public function readOne($id) {
        $id = (int)$id;
        $result = $this->conn->query("SELECT * FROM dobavljac WHERE dobavljac_id=$id");
        return $result->fetch_assoc();
    }

    public function update($id, $data) {
        $naziv = $this->conn->real_escape_string($data['naziv']);
        $kontakt = $this->conn->real_escape_string($data['kontakt']);
        $id = (int)$id;

        return $this->conn->query("UPDATE dobavljac SET naziv='$naziv', kontakt='$kontakt' WHERE dobavljac_id=$id");
    }

public function delete($id) {
    $stmt = $this->conn->prepare("DELETE FROM dobavljac WHERE dobavljac_id = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        echo "Greška: " . $stmt->error;
        return false;
    }
    return true;
}
}
?>

