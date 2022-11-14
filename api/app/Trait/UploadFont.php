<?php
/**
 * 
 */
trait UploadFont 
{
    public function doUpload() {
        $targetDir = "./uploads/";
        $fileName = basename(str_replace([' '], '-', $_FILES["selectedFiles"]["name"]));
        $originalFileName = basename($_FILES["selectedFiles"]["name"]);
        $targetFile = $targetDir . $fileName;

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        if (file_exists($targetFile)) {
            $data['message'] = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if($imageFileType != "ttf") {
            $data['message'] =  "Sorry, only TTF file allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["selectedFiles"]["tmp_name"], $targetFile)) {
                $data['message'] = "The file ". htmlspecialchars( basename( $_FILES["selectedFiles"]["name"])). " has been uploaded.";
                $data['font_file_name'] = $fileName;
                $data['font_original_file_name']    =  $originalFileName; 
            } else {
                $data['message'] =  "Sorry, there was an error uploading your file.";
                $uploadOk == 0;
            }
        }
        $data['status'] = $uploadOk;
        return $data;
    }
}
