<?php

include_once("model/Game.php");
include_once("model/TabelGame.php");

class GameViewModel {
    private $list = [];
    private $model;
    private $view;
    
    public function __construct() {
        $this->model = new TabelGame();
        $this->syncList();
    }

    public function syncList() {
        $data = $this->model->getAllData();

        $this->list = [];
        foreach ($data as $item) {
            $game = new Game(
                $item['id'],
                $item['nama'],
                $item['genre_id'],
                $item['platform'],
                $item['tahun_rilis']
            );
            $this->list[] = $game;
        }
    }

    public function getData() {
        return $this->list;
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