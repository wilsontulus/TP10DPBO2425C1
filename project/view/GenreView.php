<?php

include_once("viewmodel/GenreViewModel.php");
include_once("view/template/FormSection.php");

class GenreView {
    private $rows = array("ID", "Nama", "Rekomendasi Usia");
    private $viewmodel;
    private $webpage = "";

    public function __construct() {
        $this->viewmodel = new GenreViewModel();
    }

    private function getListPage() {
        $newWebPage = file_get_contents("view/template/db_list.html");

        // Ubah nama dan destination
        $newWebPage = str_replace("PHP_TABLE_NAME", "genre", $newWebPage);
        $newWebPage = str_replace("PHP_PAGE_TITLE", "List Genre", $newWebPage);
        $newWebPage = str_replace(
            "PHP_ADDBUTTON_NAME", "Tambah Genre Baru...", $newWebPage);
        $newWebPage = str_replace("PHP_ADDBUTTON_LOCATION", "?page=genres&action=add", $newWebPage);

        // Buat tabel terlebih dahulu
        $th_rows = "";
        $th_columns = "";
        foreach ($this->rows as $row) {
            $th_rows .= "<th>". $row ."</th>";
        }

        foreach ($this->viewmodel->getAllData() as $row) {
            $del_script = "if (confirm(\"Yakin ingin menghapus data?\")) { location.href = \"?page=genres&action=delete&id=" . htmlspecialchars($row->getId()) . "\" }";
            $th_columns .= "
            <tr>
                <th>" . htmlspecialchars($row->getId()) . "</th>
                <td>" . htmlspecialchars($row->getNama()) . "</td>
                <td>" . htmlspecialchars($row->getRekomendasiUsia()) . "</td>
                <td>
                        <a class='btn btn-success' href='?page=genres&action=edit&id=" . htmlspecialchars($row->getId()) . "'>Edit</a>
                        <button class='btn btn-danger' type='button' onclick='$del_script'>Delete</button>
                        </td>
            </tr>
            ";
        }

        $newWebPage = str_replace("PHP_TH_ROWS", $th_rows, $newWebPage);
        $newWebPage = str_replace("PHP_TBODY", $th_columns, $newWebPage);

        return $newWebPage;
    }

    private function getFormPage($action, $dataId) {
        $newWebPage = file_get_contents("view/template/db_form.html");
        $formPage = "";
        $formSection = new FormSection();

        // Ubah nama dan destination
        $newWebPage = str_replace(
            "PHP_SUBMIT_BUTTON_NAME", "Submit Genre", $newWebPage);
        $newWebPage = str_replace("PHP_FORM_ACTION_LOCATION", "?page=genres", $newWebPage);
        $newWebPage = str_replace("PHP_CANCEL_BUTTON_LOCATION", "?page=genres", $newWebPage);

        // Spesifik dengan action yang diberikan
        if ($action == "add") {
            $newWebPage = str_replace("PHP_PAGE_TITLE", "Genre Baru", $newWebPage);
            $newWebPage = str_replace("PHP_FORM_POST_NAME", "add_genre", $newWebPage);
            
            $newFormSection = $formSection->getInputSection("Nama", "text", "genre_name", "", true);
            $newFormSection .= $formSection->getInputSection("Rekomendasi Usia", "text", "genre_rekomendasi_usia", "", true);

            $newWebPage = str_replace("PHP_FORMS_COLLECTION", $newFormSection, $newWebPage);
        } elseif ($action == "edit") {
            $data = $this->viewmodel->getDataById($dataId);
            if (isset($dataId) && isset($data) && $data) {
                $newWebPage = str_replace("PHP_PAGE_TITLE", "Ubah Data Genre", $newWebPage);
                $newWebPage = str_replace("PHP_FORM_POST_NAME", "edit_genre", $newWebPage);
                $newWebPage = str_replace("PHP_SUBMIT_BUTTON_NAME", "Update Genre", $newWebPage);

                $newFormSection = $formSection->getInputSection("ID", "text", "genre_id", $data->getId(), true, true);
                $newFormSection .= $formSection->getInputSection("Nama", "text", "genre_name", $data->getNama(), true);
                $newFormSection .= $formSection->getInputSection("Rekomendasi Usia", "text", "genre_rekomendasi_usia", $data->getRekomendasiUsia(), true);

                $newWebPage = str_replace("PHP_FORMS_COLLECTION", $newFormSection, $newWebPage);
            } else {
                $newWebPage = file_get_contents("view/template/db_form_notfound.html");
                $newWebPage = str_replace("PHP_CANCEL_BUTTON_LOCATION", "?page=genres", $newWebPage);
            }
        }

        return $newWebPage;
    }

    public function postActions($post_data=[]) {
        if (isset($post_data["add_genre"])) {
            $this->viewmodel->addData([
                "nama" => $post_data["genre_name"],
                "rekomendasi_usia" => $post_data["genre_rekomendasi_usia"]
            ]);
        } elseif (isset($post_data["edit_genre"])) {
            $this->viewmodel->updateData($post_data["genre_id"], [
                "nama" => $post_data["genre_name"],
                "rekomendasi_usia" => $post_data["genre_rekomendasi_usia"]
            ]);
        } elseif (isset($post_data["delete_genre"])) {
            $this->viewmodel->deleteData($post_data["genre_id"]);
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