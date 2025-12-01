<?php

require_once('Database.php');
require_once('TableDataModel.php');

class TabelPemain extends Database implements TableDataModel {
    // DDL method
    public function getAllData(): array {
        $query = "SELECT * from pemain";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getDataById($id): ?array {
        $query = "SELECT * from pemain WHERE id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
        return $this->getSingleResult();
    }

    // DML method
    public function addData($data = []): void{
        $query = "INSERT INTO pemain (nama, asal_daerah, genre_favorit, game_favorit, jumlah_menang) 
                  VALUES (:nama, :asal_daerah, :genre_favorit, :game_favorit, :jumlah_menang)";

        $params = [
                    'nama' => $data['nama'], 
                    'asal_daerah' => $data['asal_daerah'],
                    'genre_favorit' => $data['genre_favorit'],
                    'game_favorit' => $data['game_favorit'],
                    'jumlah_menang' => $data['jumlah_menang']
                  ];
        $this->executeQuery($query, $params);
    }

    public function updateData($id, $data = []): void {
        $query = "UPDATE pemain 
                  SET nama = :nama, asal_daerah = :asal_daerah, genre_favorit = :genre_favorit, game_favorit = :game_favorit, jumlah_menang = :jumlah_menang
                  WHERE ID = :id";
                  
        $params = [
                    'nama' => $data['nama'], 
                    'asal_daerah' => $data['asal_daerah'],
                    'genre_favorit' => $data['genre_favorit'],
                    'game_favorit' => $data['game_favorit'],
                    'jumlah_menang' => $data['jumlah_menang'],
                    'id' => $id    
                  ];
        $this->executeQuery($query, $params);
    }

    public function deleteData($id): void {
        $query = "DELETE FROM pemain WHERE id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
    }

}

?>