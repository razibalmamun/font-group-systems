<?php
class FontGroupController
{
    private $fontGroup;
    public function __construct() {
        $this->fontGroup = new FontGroupModel(new JsonPrint());
    }

    public function index(){
        echo $this->fontGroup->getFontGroups();
    }  
    
    public function save() {
        echo $this->fontGroup->insert();
    }

    public function edit($id) {
        echo $this->fontGroup->findById($id);
    }

    public function update($id) {
        echo $this->fontGroup->update($id);
    }

    public function delete($id) {
        echo $this->fontGroup->delete($id);
    }
}
