<?php
include_once __DIR__ . '/CRUDInterface.php';

class Proizvod implements CRUDInterface {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($data) {
        $naziv = $this->conn->real_escape_string($data['naziv']);
        $opis = $this->conn->real_escape_string($data['opis']);
        $cena = (float)$data['cena'];
        $dobavljac_id = (int)$data['dobavljac_id'];

        $sql = "INSERT INTO proizvod (naziv, opis, cena, dobavljac_id) 
                VALUES ('$naziv', '$opis', $cena, $dobavljac_id)";
        return $this->conn->query($sql);
    }

    public function read() {
        return $this->conn->query("
            SELECT p.*, d.naziv AS dobavljac_naziv 
            FROM proizvod p
            LEFT JOIN dobavljac d ON p.dobavljac_id = d.dobavljac_id
        ");
    }

    public function readOne($id) {
        $id = (int)$id;
        $result = $this->conn->query("SELECT * FROM proizvod WHERE proizvod_id=$id");
        return $result->fetch_assoc();
    }

    public function update($id, $data) {
        $id = (int)$id;
        $naziv = $this->conn->real_escape_string($data['naziv']);
        $opis = $this->conn->real_escape_string($data['opis']);
        $cena = (float)$data['cena'];
        $dobavljac_id = (int)$data['dobavljac_id'];

        return $this->conn->query("UPDATE proizvod 
            SET naziv='$naziv', opis='$opis', cena=$cena, dobavljac_id=$dobavljac_id 
            WHERE proizvod_id=$id");
    }

   public function delete($id) {
    $stmt = $this->conn->prepare("DELETE FROM proizvod WHERE proizvod_id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

}
