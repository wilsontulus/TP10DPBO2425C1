<?php

require_once('Database.php');
require_once('TableDataModel.php');

class TabelEvent extends Database implements TableDataModel {
    // DDL method
    public function getAllData(): array {
        $query = "SELECT * from event";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getDataById($id): ?array {
        $query = "SELECT * from event WHERE id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
        return $this->getSingleResult();
    }

    // DML method
    public function addData($data = []): void{
        $query = "INSERT INTO event (nama, id_pemimpin, id_game, waktu_event) 
                  VALUES (:nama, :id_pemimpin, :id_game, :waktu_event)";

        $params = [
                    'nama' => $data['nama'], 
                    'id_pemimpin' => $data['id_pemimpin'],
                    'id_game' => $data['id_game'],
                    'waktu_event' => $data['waktu_event']
                  ];
        $this->executeQuery($query, $params);
    }

    public function updateData($id, $data = []): void {
        $query = "UPDATE event 
                  SET nama = :nama, id_pemimpin = :id_pemimpin, id_game = :id_game, waktu_event = :waktu_event
                  WHERE ID = :id";
                  
        $params = [
                    'nama' => $data['nama'], 
                    'id_pemimpin' => $data['id_pemimpin'],
                    'id_game' => $data['id_game'],
                    'waktu_event' => $data['waktu_event'],
                    'id' => $id    
                  ];
        $this->executeQuery($query, $params);
    }

    public function deleteData($id): void {
        $query = "DELETE FROM event WHERE id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
    }

}

?>