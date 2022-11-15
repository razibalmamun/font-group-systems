<?php
class FontController extends Controller
{
    private $font;
    public function __construct() {
        $this->font = new FontModel();
    }

    public function index(){
        echo $this->response($this->font->getAll());
    }  
    
    public function doUpload() {
        echo $this->response($this->font->insert([]));
    }

    public function delete($id) {
        echo $this->response($this->font->delete($id));
    }

    public function fontstyle($fontFile) {
        $this->font->fontStyle($fontFile);
    }
}
