<?php

include_once("viewmodel/EventViewModel.php");
include_once("view/template/FormSection.php");

class EventView {
    private $rows = array("ID", "Nama", "Pemimpin", "Game", "Waktu Acara");
    private $viewmodel;
    private $webpage = "";

    public function __construct() {
        $this->viewmodel = new EventViewModel();
    }

    private function getListPage() {
        $newWebPage = file_get_contents("view/template/db_list.html");

        // Ubah nama dan destination
        $newWebPage = str_replace("PHP_PAGE_TITLE", "List Event", $newWebPage);
        $newWebPage = str_replace(
            "PHP_ADDBUTTON_NAME", "Tambah Event Baru...", $newWebPage);
        $newWebPage = str_replace("PHP_ADDBUTTON_LOCATION", "?page=events&action=add", $newWebPage);

        // Buat tabel terlebih dahulu
        $th_rows = "";
        $th_columns = "";
        foreach ($this->rows as $row) {
            $th_rows .= "<th>". $row ."</th>";
        }

        foreach ($this->viewmodel->getAllData() as $row) {
            $leader = $this->viewmodel->getPemainById($row->getIdPemimpin());
            $leaderName = "?";
            if (isset($leader) && $leader) {
                $leaderName = $leader->getNama();
            }

            $game = $this->viewmodel->getGameById($row->getIdGame());
            $gameName = "?";
            if (isset($game) && $game) {
                $gameName = $game->getNama();
            }

            $del_script = "if (confirm(\"Yakin ingin menghapus data?\")) { location.href = \"?page=events&action=delete&id=" . htmlspecialchars($row->getId()) . "\" }";
            $th_columns .= "
            <tr>
                <th>" . htmlspecialchars($row->getId()) . "</th>
                <td>" . htmlspecialchars($row->getNama()) . "</td>
                <td>" . htmlspecialchars($leaderName) . "</td>
                <td>" . htmlspecialchars($gameName) . "</td>
                <td>" . htmlspecialchars($row->getWaktuEvent()) . "</td>
                <td>
                        <a class='btn btn-success' href='?page=events&action=edit&id=" . htmlspecialchars($row->getId()) . "'>Edit</a>
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

        $pemainList = [];
        foreach ($this->viewmodel->getAllPemain() as $pemain) {
            $pemainList[$pemain->getId()] = $pemain->getNama();
        }

        $gameList = [];
        foreach ($this->viewmodel->getAllGame() as $game) {
            $gameList[$game->getId()] = $game->getNama();
        }

        // Ubah nama dan destination
        $newWebPage = str_replace("PHP_FORM_ACTION_LOCATION", "?page=events", $newWebPage);
        $newWebPage = str_replace("PHP_CANCEL_BUTTON_LOCATION", "?page=events", $newWebPage);

        // Spesifik dengan action yang diberikan
        if ($action == "add") {
            $newWebPage = str_replace("PHP_PAGE_TITLE", "Event Baru", $newWebPage);
            $newWebPage = str_replace("PHP_FORM_POST_NAME", "add_event", $newWebPage);
            $newWebPage = str_replace("PHP_SUBMIT_BUTTON_NAME", "Submit Event", $newWebPage);
            
            $newFormSection = $formSection->getInputSection("Nama", "text", "event_name", "", true);
            $newFormSection .= $formSection->getSelectSection("Pemimpin", "event_leader", $pemainList, null, true);
            $newFormSection .= $formSection->getSelectSection("Game", "event_game", $gameList, null, true);
            $newFormSection .= $formSection->getInputSection("Waktu Acara", "date", "event_waktu_acara", "", true, false);

            $newWebPage = str_replace("PHP_FORMS_COLLECTION", $newFormSection, $newWebPage);
        } elseif ($action == "edit") {
            $data = $this->viewmodel->getDataById($dataId);
            if (isset($dataId) && isset($data) && $data) {
                $newWebPage = str_replace("PHP_PAGE_TITLE", "Ubah Data Event", $newWebPage);
                $newWebPage = str_replace("PHP_FORM_POST_NAME", "edit_player", $newWebPage);
                $newWebPage = str_replace("PHP_SUBMIT_BUTTON_NAME", "Update Event", $newWebPage);

                $newFormSection = $formSection->getInputSection("ID", "text", "event_id", $data->getId(), true, true);
                $newFormSection .= $formSection->getInputSection("Nama", "text", "event_name", $data->getNama(), true);
                $newFormSection .= $formSection->getSelectSection("Pemimpin", "event_leader", $pemainList, $data->getIdPemimpin(), true);
                $newFormSection .= $formSection->getSelectSection("Game", "event_game", $gameList, $data->getIdGame(), true);
                $newFormSection .= $formSection->getInputSection("Waktu Acara", "date", "event_waktu_acara", $data->getWaktuEvent(), true, false);

                $newWebPage = str_replace("PHP_FORMS_COLLECTION", $newFormSection, $newWebPage);
            } else {
                $newWebPage = file_get_contents("view/template/db_form_notfound.html");
                $newWebPage = str_replace("PHP_CANCEL_BUTTON_LOCATION", "?page=events", $newWebPage);
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