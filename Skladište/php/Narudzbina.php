<?php
include_once __DIR__ . '/CRUDInterface.php';

class Narudzbina implements CRUDInterface {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($data) {
        $proizvod_id = (int)$data['proizvod_id'];
        $datum = $this->conn->real_escape_string($data['datum']);
        $kolicina = (int)$data['kolicina'];

        $sql = "INSERT INTO narudzbina (proizvod_id, datum, kolicina) 
                VALUES ($proizvod_id, '$datum', $kolicina)";
        return $this->conn->query($sql);
    }

    public function read() {
        return $this->conn->query("
            SELECT n.*, p.naziv 
            FROM narudzbina n 
            JOIN proizvod p ON n.proizvod_id = p.proizvod_id
        ");
    }

    public function readOne($id) {
        $id = (int)$id;
        $result = $this->conn->query("
            SELECT n.*, p.naziv 
            FROM narudzbina n 
            JOIN proizvod p ON n.proizvod_id = p.proizvod_id
            WHERE n.narudzbina_id = $id
        ");
        return $result->fetch_assoc();
    }

    public function update($id, $data) {
        $id = (int)$id;
        $datum = $this->conn->real_escape_string($data['datum']);
        $kolicina = (int)$data['kolicina'];

        return $this->conn->query("
            UPDATE narudzbina 
            SET datum='$datum', kolicina=$kolicina 
            WHERE narudzbina_id=$id
        ");
    }

    public function delete($id) {
    $stmt = $this->conn->prepare("DELETE FROM narudzbina WHERE narudzbina_id = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        echo "Greška: " . $stmt->error;
        return false;
    }
    return true;
}

}
?>
