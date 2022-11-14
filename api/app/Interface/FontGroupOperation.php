<?php
interface FontGroupOperation {
    public function insert();
    public function getFontGroups();
    public function findById($id);
    public function update($id);
    public function delete($id);
}