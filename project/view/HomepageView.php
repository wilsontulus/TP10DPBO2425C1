<?php

class HomepageView {
    private $webpage = "";

    public function __construct() {
        $this->webpage = file_get_contents("view/template/homepage.html");
    }
    public function render() {
        return $this->webpage;
    }
};

?>