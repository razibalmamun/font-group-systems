<?php
class FontController
{
    private $font;
    public function __construct() {
        $this->font = new FontModel(new JsonPrint());
    }

    public function index(){
        echo $this->font->getFonts();
    }  
    
    public function doUpload() {
        echo $this->font->insert([]);
    }

    public function delete($id) {
        echo $this->font->delete($id);
    }
}
