<?php

class Genre {

    private $id;
    private $nama;
    private $rekomendasi_usia;


    public function __construct($id, $nama, $rekomendasi_usia){
        $this->id = $id;
        $this->nama = $nama;
        $this->rekomendasi_usia = $rekomendasi_usia;
    }

    public function getId(){
        return $this->id;
    }
    public function getNama(){
        return $this->nama;
    }
    public function getRekomendasiUsia(){
        return $this->rekomendasi_usia;
    }

    public function setNama($nama){
        $this->nama = $nama;
    }
    public function setRekomendasiUsia($rekomendasi_usia) {
        $this->rekomendasi_usia = $rekomendasi_usia;
    }
}
?>