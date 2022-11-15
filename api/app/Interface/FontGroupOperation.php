<?php
interface FontGroupOperation {
    public function insert();
    public function getAll();
    public function findById($id);
    public function update($id);
    public function delete($id);
}