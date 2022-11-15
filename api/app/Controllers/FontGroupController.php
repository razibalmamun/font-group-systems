<?php
class FontGroupController extends Controller
{
    private $fontGroup;
    public function __construct() {
        $this->fontGroup = new FontGroupModel();
    }

    public function index(){
        echo $this->response($this->fontGroup->getAll());
    }  
    
    public function save() {
        echo $this->response($this->fontGroup->insert());
    }

    public function edit($id) {
        echo $this->response($this->fontGroup->findById($id));
    }

    public function update($id) {
        echo $this->response($this->fontGroup->update($id));
    }

    public function delete($id) {
        echo $this->response($this->fontGroup->delete($id));
    }
}
