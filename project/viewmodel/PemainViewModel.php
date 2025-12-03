<?php

include_once("model/Pemain.php");
include_once("model/TabelPemain.php");

class PemainViewModel {
    private $model;
    
    public function __construct() {
        $this->model = new TabelPemain();
    }

    public function getData() {
        return $this->model->getAllData();
    }
};

?>