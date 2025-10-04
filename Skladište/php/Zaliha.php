<?php
include_once __DIR__ . '/CRUDInterface.php';

class Zaliha implements CRUDInterface {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

   public function create($data) {
    $stmt = $this->conn->prepare("INSERT INTO zaliha (proizvod_id, kolicina, lokacija, datum_azuriranja) VALUES (?, ?, ?, ?)");
    if(!$stmt) {
        die("Greška u pripremi upita: " . $this->conn->error);
    }
    $stmt->bind_param("iiss", $data['proizvod_id'], $data['kolicina'], $data['lokacija'], $data['datum_azuriranja']);
    return $stmt->execute();
}

public function read() {
    $sql = "SELECT z.zaliha_id, z.proizvod_id, p.naziv AS proizvod, 
                   z.kolicina, z.lokacija, z.datum_azuriranja
            FROM zaliha z
            JOIN proizvod p ON z.proizvod_id = p.proizvod_id";
    return $this->conn->query($sql);
}
    public function readOne($id) {
        $id = (int)$id;
        $result = $this->conn->query("SELECT * FROM zaliha WHERE zaliha_id=$id");
        return $result->fetch_assoc();
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE zaliha SET kolicina=?, lokacija=?, datum_azuriranja=? WHERE zaliha_id=?");
        $stmt->bind_param("issi", $data['kolicina'], $data['lokacija'], $data['datum_azuriranja'], $id);
        $stmt->execute();
    }
 public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM zaliha WHERE zaliha_id = ?");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            echo "Greška: " . $stmt->error;
            return false;
        }
        return true;
    }
}
?>
