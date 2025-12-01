<?php

class Game {

    private int $id;
    private string $nama;
    private int $genre_id;
    private string $platform;
    private int $tahun_rilis;


    public function __construct($id, $nama, $genre_id, $platform, $tahun_rilis){
        $this->id = $id;
        $this->nama = $nama;
        $this->genre_id = $genre_id;
        $this->platform = $platform;
        $this->tahun_rilis = $tahun_rilis;
    }

    public function getId(){
        return $this->id;
    }
    public function getNama(){
        return $this->nama;
    }
    public function getGenreId(){
        return $this->genre_id;
    }
    public function getPlatform(){
        return $this->platform;
    }
    public function getTahunRilis(){
        return $this->tahun_rilis;
    }

    public function setNama($nama){
        $this->nama = $nama;
    }
    public function setGenreId($genre_id) {
        $this->genre_id = $genre_id;
    }
    public function setPlatform($platform) {
        $this->platform = $platform;
    }
    public function setTahunRilis($tahun_rilis) {
        $this->tahun_rilis = $tahun_rilis;
    }
}
?>