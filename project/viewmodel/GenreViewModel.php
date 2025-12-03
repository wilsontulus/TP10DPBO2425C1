<?php

include_once("model/Genre.php");
include_once("model/TabelGenre.php");

class GenreViewModel {
    private $model;
    
    public function __construct() {
        $this->model = new TabelGenre();
    }

    public function getData() {
        return $this->model->getAllData();
    }
};

?>