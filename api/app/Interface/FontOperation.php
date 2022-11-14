<?php
interface FontOperation {
    public function insert($data);
    public function getFonts();
    public function delete($id);
}