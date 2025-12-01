<?php

class Pemain {

    private int $id;
    private string $nama;
    private string $asal_daerah;
    private int $genre_favorit;
    private int $game_favorit;
    private int $jumlah_menang;


    public function __construct($id, $nama, $asal_daerah, $genre_favorit, $game_favorit, $jumlah_menang){
        $this->id = $id;
        $this->nama = $nama;
        $this->asal_daerah = $asal_daerah;
        $this->genre_favorit = $genre_favorit;
        $this->game_favorit = $game_favorit;
        $this->jumlah_menang = $jumlah_menang;
    }

    public function getId(){
        return $this->id;
    }
    public function getNama(){
        return $this->nama;
    }
    public function getAsalDaerah(){
        return $this->asal_daerah;
    }
    public function getGenreFavorit(){
        return $this->genre_favorit;
    }
    public function getGameFavorit(){
        return $this->game_favorit;
    }
    public function getJumlahMenang(){
        return $this->jumlah_menang;
    }

    public function setNama($nama){
        $this->nama = $nama;
    }
    public function setAsalDaerah($asal_daerah){
        $this->asal_daerah = $asal_daerah;
    }
    public function setGenreFavorit($genre_favorit) {
        $this->genre_favorit = $genre_favorit;
    }
    public function setGameFavorit($game_favorit) {
        $this->game_favorit = $game_favorit;
    }
    public function setJumlahMenang($jumlah_menang) {
        $this->jumlah_menang = $jumlah_menang;
    }
}
?>