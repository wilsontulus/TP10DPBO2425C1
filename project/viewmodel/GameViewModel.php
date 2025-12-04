<?php

include_once("model/Game.php");
include_once("model/TabelGame.php");

include_once("model/Genre.php");
include_once("model/TabelGenre.php");

class GameViewModel {
    private $list = [];
    private $listGenre = [];
    private $model;
    private $modelGenre;
    private $view;
    
    public function __construct() {
        $this->model = new TabelGame();
        $this->modelGenre = new TabelGenre();
        $this->syncList();
        $this->syncListGenre();
    }

    public function syncList() {
        $data = $this->model->getAllData();

        $this->list = [];
        foreach ($data as $item) {
            $newData = new Game(
                $item['id'],
                $item['nama'],
                $item['genre_id'],
                $item['platform'],
                $item['tahun_rilis']
            );
            $this->list[] = $newData;
        }
    }

    public function syncListGenre() {
        $data = $this->modelGenre->getAllData();

        $this->listGenre = [];
        foreach ($data as $item) {
            $newData = new Genre(
                $item['id'],
                $item['nama'],
                $item['rekomendasi_usia']
            );
            $this->listGenre[] = $newData;
        }
    }

    public function getAllData() {
        return $this->list;
    }

    public function getAllGenre() {
        return $this->listGenre;
    }

    public function getDataById($id) {
        foreach ($this->list as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
    }

    public function getGenreById($id) {
        foreach ($this->listGenre as $item) {
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