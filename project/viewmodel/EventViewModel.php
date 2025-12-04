<?php

include_once("model/Event.php");
include_once("model/TabelEvent.php");

include_once("model/Pemain.php");
include_once("model/TabelPemain.php");

include_once("model/Game.php");
include_once("model/TabelGame.php");

class EventViewModel {
    private $list = [], $listPemain = [], $listGame = [];
    private $model, $modelPemain, $modelGame;
    private $view;
    
    public function __construct() {
        $this->model = new TabelEvent();
        $this->modelPemain = new TabelPemain();
        $this->modelGame = new TabelGame();
        $this->syncList();
        $this->syncForeignList();
    }

    public function syncList() {
        $data = $this->model->getAllData();

        $this->list = [];
        foreach ($data as $item) {
            $newData = new Event(
                $item['id'],
                $item['nama'],
                $item['id_pemimpin'],
                $item['id_game'],
                $item['waktu_event']
            );
            $this->list[] = $newData;
        }
    }

    public function syncForeignList() {
        // Players
        $data = $this->modelPemain->getAllData();

        $this->listPemain = [];
        foreach ($data as $item) {
            $newData = new Pemain(
                $item['id'],
                $item['nama'],
                $item['asal_daerah'],
                $item['genre_favorit'],
                $item['game_favorit'],
                $item['jumlah_menang']
            );
            $this->listPemain[] = $newData;
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

    public function getAllPemain() {
        return $this->listPemain;
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

    public function getPemainById($id) {
        foreach ($this->listPemain as $item) {
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