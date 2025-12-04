<?php

include_once("model/Genre.php");
include_once("model/TabelGenre.php");

if (session_status() == PHP_SESSION_NONE) { 
    session_start([
        'cookie_lifetime' => 86400
    ]); 
} 

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

        // Update last time untuk ajax ke status.php
        $_SESSION["genre_lastUpdated"] = time();
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
        $this->model->addData($data);
        $this->syncList();
    }

    public function updateData($id, $data = []) {
        $this->model->updateData($id, $data);
        $this->syncList();
    }

    public function deleteData($id) {
        $this->model->deleteData($id);
        $this->syncList();
    }
};

?>