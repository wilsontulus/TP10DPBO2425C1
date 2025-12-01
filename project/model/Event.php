<?php

class Event {

    private int $id;
    private string $nama;
    private int $id_pemimpin;
    private int $id_game;
    private string $waktu_event;


    public function __construct($id, $nama, $id_pemimpin, $id_game, $waktu_event){
        $this->id = $id;
        $this->nama = $nama;
        $this->id_pemimpin = $id_pemimpin;
        $this->id_game = $id_game;
        $this->waktu_event = $waktu_event;
    }

    public function getId(){
        return $this->id;
    }
    public function getNama(){
        return $this->nama;
    }
    public function getIdPemimpin(){
        return $this->id_pemimpin;
    }
    public function getIdGame(){
        return $this->id_game;
    }
    public function getWaktuEvent(){
        return $this->waktu_event;
    }

    public function setNama($nama){
        $this->nama = $nama;
    }
    public function setIdPemimpin($id_pemimpin) {
        $this->id_pemimpin = $id_pemimpin;
    }
    public function setIdGame($id_game) {
        $this->id_game = $id_game;
    }
    public function setWaktuEvent($waktu_event) {
        $this->waktu_event = $waktu_event;
    }
}
?>