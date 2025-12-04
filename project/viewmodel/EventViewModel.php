<?php

include_once("model/Event.php");
include_once("model/TabelEvent.php");

class EventViewModel {
    private $list = [];
    private $model;
    private $view;
    
    public function __construct() {
        $this->model = new TabelEvent();
        $this->syncList();
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