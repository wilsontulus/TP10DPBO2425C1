<?php

include_once("model/Pemain.php");
include_once("model/TabelPemain.php");

include_once("model/Genre.php");
include_once("model/TabelGenre.php");

include_once("model/Game.php");
include_once("model/TabelGame.php");

class PemainViewModel {
    private $list = [], $listGenre = [], $listGame = [];
    private $model, $modelGenre, $modelGame;
    private $view;
    
    public function __construct() {
        $this->model = new TabelPemain();
        $this->modelGenre = new TabelGenre();
        $this->modelGame = new TabelGame();
        $this->syncList();
        $this->syncForeignList();
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

    public function syncForeignList() {
        // Genres
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

        // Games
        $data = $this->modelGame->getAllData();

        $this->listGame = [];
        foreach ($data as $item) {
            $newData = new Game(
                $item['id'],
                $item['nama'],
                $item['genre_id'],
                $item['platform'],
                $item['tahun_rilis']
            );
            $this->listGame[] = $newData;
        }
    }

    public function getAllData() {
        return $this->list;
    }

    public function getAllGenre() {
        return $this->listGenre;
    }

    public function getAllGame() {
        return $this->listGame;
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

    public function getGameById($id) {
        foreach ($this->listGame as $item) {
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