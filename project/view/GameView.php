<?php

include_once("viewmodel/GameViewModel.php");

class GameView {
    private $rows = array("ID", "Nama", "Genre", "Platform", "Thn Rilis");
    private $viewmodel;
    private $webpage = "";

    public function __construct() {
        $this->viewmodel = new GameViewModel();
        $this->webpage = file_get_contents("view/template/db_list.html");

        // Ubah nama dan destination
        $this->webpage = str_replace("PHP_PAGE_TITLE", "List Game", $this->webpage);
        $this->webpage = str_replace(
            "PHP_ADDBUTTON_NAME", "Tambah Game Baru...", $this->webpage);
        $this->webpage = str_replace("PHP_ADDBUTTON_LOCATION", "?page=games&action=add", $this->webpage);



    }
    public function render() {
        // Buat tabel terlebih dahulu
        $th_rows = "";
        $th_columns = "";
        foreach ($this->rows as $row) {
            $th_rows .= "<th>". $row ."</th>";
        }

        foreach ($this->viewmodel->getData() as $row) {
            $del_script = "if (confirm(\"Yakin ingin menghapus data?\")) { location.href = \"?page=games&action=delete&id=$row->getId()\" }";
            $th_columns .= "
            <tr>
                <th>$row->getId()</th>
                <td>$row->getName()</td>
                <td>$row->getGenreId()</td>
                <td>$row->getPlatform()</td>
                <td>$row->getTahunRilis()</td>
                <td>
                        <a class='btn btn-success' href='?page=games&action=edit&id=$row->getId()'>Edit</a>
                        <button class='btn btn-danger' type='button' onclick='$del_script'>Delete</button>
                        </td>
            </tr>
            ";
        }

        $this->webpage = str_replace("PHP_TH_ROWS", $th_rows, $this->webpage);
        $this->webpage = str_replace("PHP_TBODY", $th_columns, $this->webpage);


        // Lalu di render ke client
        return $this->webpage;
    }
};

?>