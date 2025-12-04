<?php

include_once("viewmodel/GameViewModel.php");
include_once("view/template/FormSection.php");

class GameView {
    private $rows = array("ID", "Nama", "Genre", "Platform", "Thn Rilis");
    private $viewmodel;
    private $webpage = "";

    public function __construct() {
        $this->viewmodel = new GameViewModel();
    }

    private function getListPage() {
        $newWebPage = file_get_contents("view/template/db_list.html");

        // Ubah nama dan destination
        $newWebPage = str_replace("PHP_PAGE_TITLE", "List Game", $newWebPage);
        $newWebPage = str_replace(
            "PHP_ADDBUTTON_NAME", "Tambah Game Baru...", $newWebPage);
        $newWebPage = str_replace("PHP_ADDBUTTON_LOCATION", "?page=games&action=add", $newWebPage);

        // Buat tabel terlebih dahulu
        $th_rows = "";
        $th_columns = "";
        foreach ($this->rows as $row) {
            $th_rows .= "<th>". $row ."</th>";
        }

        foreach ($this->viewmodel->getAllData() as $row) {
            $genre = $this->viewmodel->getGenreById($row->getGenreId());
            $genreName = "?";
            if (isset($genre) && $genre) {
                $genreName = $genre->getNama();
            }
            $del_script = "if (confirm(\"Yakin ingin menghapus data?\")) { location.href = \"?page=games&action=delete&id=" . htmlspecialchars($row->getId()) . "\" }";
            $th_columns .= "
            <tr>
                <th>" . htmlspecialchars($row->getId()) . "</th>
                <td>" . htmlspecialchars($row->getNama()) . "</td>
                <td>" . htmlspecialchars($genreName) . "</td>
                <td>" . htmlspecialchars($row->getPlatform()) . "</td>
                <td>" . htmlspecialchars($row->getTahunRilis()) . "</td>
                <td>
                        <a class='btn btn-success' href='?page=games&action=edit&id=" . htmlspecialchars($row->getId()) . "'>Edit</a>
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

        // Ubah nama dan destination
        $newWebPage = str_replace("PHP_FORM_ACTION_LOCATION", "?page=games", $newWebPage);
        $newWebPage = str_replace("PHP_CANCEL_BUTTON_LOCATION", "?page=games", $newWebPage);

        // Spesifik dengan action yang diberikan
        if ($action == "add") {
            $newWebPage = str_replace("PHP_PAGE_TITLE", "Game Baru", $newWebPage);
            $newWebPage = str_replace("PHP_FORM_POST_NAME", "add_game", $newWebPage);
            $newWebPage = str_replace("PHP_SUBMIT_BUTTON_NAME", "Submit Game", $newWebPage);
            
            $newFormSection = $formSection->getInputSection("Nama", "text", "game_name", "", true);

            $newFormSection .= $formSection->getSelectSection("Genre", "game_genre", $genreList, null, true);
            $newFormSection .= $formSection->getInputSection("Platform", "text", "game_platform", "", true);
            $newFormSection .= $formSection->getInputSection("Tahun Rilis", "number", "game_release_year", "", true, false, 1950, date("Y"));

            $newWebPage = str_replace("PHP_FORMS_COLLECTION", $newFormSection, $newWebPage);
        } elseif ($action == "edit") {
            $data = $this->viewmodel->getDataById($dataId);
            if (isset($dataId) && isset($data) && $data) {
                $newWebPage = str_replace("PHP_PAGE_TITLE", "Ubah Data Game", $newWebPage);
                $newWebPage = str_replace("PHP_FORM_POST_NAME", "edit_game", $newWebPage);
            $newWebPage = str_replace("PHP_SUBMIT_BUTTON_NAME", "Update Game", $newWebPage);

                $newFormSection = $formSection->getInputSection("ID", "text", "game_id", $data->getId(), true, true);
                $newFormSection .= $formSection->getInputSection("Nama", "text", "game_name", $data->getNama(), true);
                $newFormSection .= $formSection->getSelectSection("Genre", "game_genre", $genreList, $data->getGenreId(), true);
                $newFormSection .= $formSection->getInputSection("Platform", "text", "game_platform", $data->getPlatform(), true);
                $newFormSection .= $formSection->getInputSection("Tahun Rilis", "number", "game_release_year", $data->getTahunRilis(), true, false, 1950, date("Y"));

                $newWebPage = str_replace("PHP_FORMS_COLLECTION", $newFormSection, $newWebPage);
            } else {
                $newWebPage = file_get_contents("view/template/db_form_notfound.html");
                $newWebPage = str_replace("PHP_CANCEL_BUTTON_LOCATION", "?page=games", $newWebPage);
            }
            

        }

        return $newWebPage;
    }

    public function postActions($post_data=[]) {
        if (isset($post_data["add_game"])) {
            $this->viewmodel->addData([
                "nama" => $post_data["game_name"],
                "genre_id" => $post_data["game_genre"],
                "platform" => $post_data["game_platform"],
                "tahun_rilis" => $post_data["game_release_year"]
            ]);
        } elseif (isset($post_data["edit_game"])) {
            $this->viewmodel->updateData($post_data["game_id"], [
                "nama" => $post_data["game_name"],
                "genre_id" => $post_data["game_genre"],
                "platform" => $post_data["game_platform"],
                "tahun_rilis" => $post_data["game_release_year"]
            ]);
        } elseif (isset($post_data["delete_game"])) {
            $this->viewmodel->deleteData($post_data["game_id"]);
        }
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