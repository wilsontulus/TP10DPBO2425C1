<?php

class NotfoundView {
    private $webpage = "";

    public function __construct() {
        $this->webpage = file_get_contents("view/template/notfound.html");
    }
    public function render() {
        return $this->webpage;
    }
};

?>