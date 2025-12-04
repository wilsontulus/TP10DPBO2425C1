<?php

include_once("model/Genre.php");
include_once("model/TabelGenre.php");

class GenreViewModel {
    private $list = [];
    private $model;
    private $view;
    
    public function __construct() {
        $this->model = new TabelGenre();
        $this->syncList();
    }

    public function syncList() {
        $data = $this->model->getAllData();

        $this->list = [];
        foreach ($data as $item) {
            $newData = new Genre(
                $item['id'],
                $item['nama'],
                $item['rekomendasi_usia']
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
};

?>