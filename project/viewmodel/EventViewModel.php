<?php

include_once("model/Event.php");
include_once("model/TabelEvent.php");

class EventViewModel {
    private $model;
    
    public function __construct() {
        $this->model = new TabelEvent();
    }

    public function getData() {
        return $this->model->getAllData();
    }
};

?>