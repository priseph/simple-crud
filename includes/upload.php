<?php
class upload{
    public $src = "./upload/";
    public $tmp;
    public $filename;
    public $type;
    public $uploadfile;

    public function startupload(){
        $this -> filename = $_FILES["file"]["name"];
        $this -> tmp = $_FILES["file"]["tmp_name"];
        $this -> uploadfile = $src . basename($this -> name);
    }
    public function uploadfile(){
        if(move_uploaded_file($this -> tmp, $this -> uploadFile)){
            return true;
        }
    }


}

?>