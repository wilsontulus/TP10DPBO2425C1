<?php

require_once('Database.php');
require_once('TableDataModel.php');

class TabelGenre extends Database implements TableDataModel {
    // DDL method
    public function getAllData(): array {
        $query = "SELECT * from genre";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getDataById($id): ?array {
        $query = "SELECT * from genre WHERE id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
        return $this->getSingleResult();
    }

    // DML method
    public function addData($data = []): void{
        $query = "INSERT INTO genre (nama, rekomendasi_usia) VALUES (:nama, :rekomendasi_usia)";
        $params = ['nama' => $data['nama'], 'rekomendasi_usia' => $data['rekomendasi_usia']];
        $this->executeQuery($query, $params);
    }

    public function updateData($id, $data = []): void {
        $query = "UPDATE genre  SET nama = :nama, rekomendasi_usia = :rekomendasi_usia WHERE ID = :id";
        $params = ['nama' => $data['nama'], 'rekomendasi_usia' => $data['rekomendasi_usia'], 'id' => $id];
        $this->executeQuery($query, $params);
    }

    public function deleteData($id): void {
        $query = "DELETE FROM genre WHERE id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
    }

}

?>