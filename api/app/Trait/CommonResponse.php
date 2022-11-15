<?php
trait CommonResponse 
{
    public function upload() {
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

    public function sanitizeData($data) {
        $trimmed_data    = trim($data);
        $str_splash_data = stripslashes($trimmed_data);
        $html_chars_data = htmlspecialchars($str_splash_data);
        return $html_chars_data;
    }

    public function getFontStyle($fontFile) {
        $font = './uploads/'.$fontFile;

        $image = imagecreate(120,20);
        $black = imagecolorallocate($image, 255,255,255);
        $white = ImageColorAllocate($image, 0, 0, 0);

        $size = 10;

        imagettftext($image, $size, 0, 10, 14, $white, $font, "Example Style");
        header("content-type: image/png");
        imagepng($image);
        imagedestroy($image);
    }
}
