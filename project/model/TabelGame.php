<?php

require_once('Database.php');
require_once('TableDataModel.php');

class TabelGame extends Database implements TableDataModel {
    // DDL method
    public function getAllData(): array {
        $query = "SELECT * from game";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getDataById($id): ?array {
        $query = "SELECT * from game WHERE id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
        return $this->getSingleResult();
    }

    // DML method
    public function addData($data = []): void{
        $query = "INSERT INTO game (nama, genre_id, platform, tahun_rilis) 
                  VALUES (:nama, :genre_id, :platform, :tahun_rilis)";

        $params = [
                    'nama' => $data['nama'], 
                    'genre_id' => $data['genre_id'],
                    'platform' => $data['platform'],
                    'tahun_rilis' => $data['tahun_rilis']    
                  ];
        $this->executeQuery($query, $params);
    }

    public function updateData($id, $data = []): void {
        $query = "UPDATE game 
                  SET nama = :nama, genre_id = :genre_id, platform = :platform, tahun_rilis = :tahun_rilis
                  WHERE ID = :id";
                  
        $params = [
                    'nama' => $data['nama'], 
                    'genre_id' => $data['genre_id'],
                    'platform' => $data['platform'],
                    'tahun_rilis' => $data['tahun_rilis'],
                    'id' => $id    
                  ];
        $this->executeQuery($query, $params);
    }

    public function deleteData($id): void {
        $query = "DELETE FROM game WHERE id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
    }

}

?>