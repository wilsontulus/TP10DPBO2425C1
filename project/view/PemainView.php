<?php

include_once("viewmodel/PemainViewModel.php");
include_once("view/template/FormSection.php");

class PemainView {
    private $rows = array("ID", "Nama", "Asal Daerah", "Genre Fav.", "Game Fav.", "Jml Menang");
    private $viewmodel;
    private $webpage = "";

    public function __construct() {
        $this->viewmodel = new PemainViewModel();
    }

    private function getListPage() {
        $newWebPage = file_get_contents("view/template/db_list.html");

        // Ubah nama dan destination
        $newWebPage = str_replace("PHP_PAGE_TITLE", "List Pemain", $newWebPage);
        $newWebPage = str_replace(
            "PHP_ADDBUTTON_NAME", "Tambah Pemain Baru...", $newWebPage);
        $newWebPage = str_replace("PHP_ADDBUTTON_LOCATION", "?page=players&action=add", $newWebPage);

        // Buat tabel terlebih dahulu
        $th_rows = "";
        $th_columns = "";
        foreach ($this->rows as $row) {
            $th_rows .= "<th>". $row ."</th>";
        }

        foreach ($this->viewmodel->getAllData() as $row) {
            $genre = $this->viewmodel->getGenreById($row->getGenreFavorit());
            $genreName = "?";
            if (isset($genre) && $genre) {
                $genreName = $genre->getNama();
            }

            $game = $this->viewmodel->getGameById($row->getGameFavorit());
            $gameName = "?";
            if (isset($game) && $game) {
                $gameName = $game->getNama();
            }
            $del_script = "if (confirm(\"Yakin ingin menghapus data?\")) { location.href = \"?page=players&action=delete&id=" . htmlspecialchars($row->getId()) . "\" }";
            $th_columns .= "
            <tr>
                <th>" . htmlspecialchars($row->getId()) . "</th>
                <td>" . htmlspecialchars($row->getNama()) . "</td>
                <td>" . htmlspecialchars($row->getAsalDaerah()) . "</td>
                <td>" . htmlspecialchars($genreName) . "</td>
                <td>" . htmlspecialchars($gameName) . "</td>
                <td>" . htmlspecialchars($row->getJumlahMenang()) . "</td>
                <td>
                        <a class='btn btn-success' href='?page=players&action=edit&id=" . htmlspecialchars($row->getId()) . "'>Edit</a>
                        <button class='btn btn-danger' type='button' onclick='$del_script'>Delete</button>
                        </td>
            </tr>
            ";
        }

        $newWebPage = str_replace("PHP_TH_ROWS", $th_rows, $newWebPage);
        $newWebPage = str_replace("PHP_TBODY", $th_columns, $newWebPage);

        return $newWebPage;
    }

    private function getFormPage($action, $dataId=null) {
        $newWebPage = file_get_contents("view/template/db_form.html");
        $formPage = "";
        $formSection = new FormSection();

        $genreList = [];
        foreach ($this->viewmodel->getAllGenre() as $genre) {
            $genreList[$genre->getId()] = $genre->getNama();
        }

        $gameList = [];
        foreach ($this->viewmodel->getAllGame() as $game) {
            $gameList[$game->getId()] = $game->getNama();
        }

        // Ubah nama dan destination
        $newWebPage = str_replace("PHP_FORM_ACTION_LOCATION", "?page=players", $newWebPage);
        $newWebPage = str_replace("PHP_CANCEL_BUTTON_LOCATION", "?page=players", $newWebPage);

        // Spesifik dengan action yang diberikan
        if ($action == "add") {
            $newWebPage = str_replace("PHP_PAGE_TITLE", "Pemain Baru", $newWebPage);
            $newWebPage = str_replace("PHP_FORM_POST_NAME", "add_player", $newWebPage);
            $newWebPage = str_replace("PHP_SUBMIT_BUTTON_NAME", "Submit Pemain", $newWebPage);
            
            $newFormSection = $formSection->getInputSection("Nama", "text", "player_name", "", true);
            $newFormSection = $formSection->getInputSection("Asal Daerah", "text", "player_asal_daerah", "", true);

            $newFormSection .= $formSection->getSelectSection("Genre Favorit", "player_genre", $genreList, null, true);
            $newFormSection .= $formSection->getSelectSection("Game Favorit", "player_game", $gameList, null, true);
            $newFormSection .= $formSection->getInputSection("Jumlah Menang", "number", "player_jumlah_menang", "", true, false, 0, 2147483647);

            $newWebPage = str_replace("PHP_FORMS_COLLECTION", $newFormSection, $newWebPage);
        } elseif ($action == "edit") {
            $data = $this->viewmodel->getDataById($dataId);
            if (isset($dataId) && isset($data) && $data) {
                $newWebPage = str_replace("PHP_PAGE_TITLE", "Ubah Data Pemain", $newWebPage);
                $newWebPage = str_replace("PHP_FORM_POST_NAME", "edit_player", $newWebPage);
                $newWebPage = str_replace("PHP_SUBMIT_BUTTON_NAME", "Update Pemain", $newWebPage);

                $newFormSection = $formSection->getInputSection("ID", "text", "player_id", $data->getId(), true, true);
                $newFormSection .= $formSection->getInputSection("Nama", "text", "player_name", $data->getNama(), true);
                $newFormSection .= $formSection->getInputSection("Asal Daerah", "text", "player_asal_daerah", $data->getAsalDaerah(), true);

                $newFormSection .= $formSection->getSelectSection("Genre Favorit", "player_genre", $genreList, $data->getGenreFavorit(), true);
                $newFormSection .= $formSection->getSelectSection("Game Favorit", "player_game", $gameList, $data->getGameFavorit(), true);
                $newFormSection .= $formSection->getInputSection("Jumlah Menang", "number", "player_jumlah_menang", $data->getJumlahMenang(), true, false, 0, 2147483647);

                $newWebPage = str_replace("PHP_FORMS_COLLECTION", $newFormSection, $newWebPage);
            } else {
                $newWebPage = file_get_contents("view/template/db_form_notfound.html");
                $newWebPage = str_replace("PHP_CANCEL_BUTTON_LOCATION", "?page=players", $newWebPage);
            }
            

        }

        return $newWebPage;
    }

    public function postActions($post_data=[]) {
        // TODO: CUD functions
    }
    
    public function render($action, $dataId=null) {
        switch ($action) {
            case "add":
            case "edit":
                $this->webpage = $this->getFormPage($action, $dataId);
                break;
            case "list":
            case "delete":
            case "":
            default:
                $this->webpage = $this->getListPage();
        }

        // Lalu di render ke client
        return $this->webpage;
    }
};

?>