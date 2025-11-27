<?php

interface TableDataModel
{
    // DDL method
    public function getAllData(): array;
    public function getDataById($id): ?array;

    // DML method
    public function addData($data = []): void;
    public function updateData($id, $data = []): void;
    public function deleteData($id): void;

}

?>
