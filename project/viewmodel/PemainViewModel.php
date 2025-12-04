<?php

include_once("model/Pemain.php");
include_once("model/TabelPemain.php");

class PemainViewModel {
    private $list = [];
    private $model;
    private $view;
    
    public function __construct() {
        $this->model = new TabelPemain();
        $this->syncList();
    }

    public function syncList() {
        $data = $this->model->getAllData();

        $this->list = [];
        foreach ($data as $item) {
            $newData = new Pemain(
                $item['id'],
                $item['nama'],
                $item['asal_daerah'],
                $item['genre_favorit'],
                $item['game_favorit'],
                $item['jumlah_menang']
            );
            $this->list[] = $newData;
        }
    }

    public function getAllData() {
        return $this->list;
    }

    public function getDataById($id) {
        foreach ($this->list as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
    }

    // Metode DML simpel saja

    public function addData($data = []) {
        return $this->model->addData($data);
    }

    public function updateData($id, $data = []) {
        return $this->model->updateData($id, $data);
    }

    public function deleteData($id) {
        return $this->model->deleteData($id);
    }
}

?>