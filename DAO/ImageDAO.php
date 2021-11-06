<?php

namespace DAO;

use \Exception as Exception;
use DAO\IImageDAO as IImageDAO;
use Models\Image as Image;

class ImageDAO implements IImageDAO
{
    private $validFileTypes = ["bmp", "jpg", "jpeg", "png"];

    public function UploadImage($image, $pathId) {
        try {
            $tempFileName = $image["tmp_name"];
            $fileType = $image["type"];
            $fileName = uniqid("fl_") . $fileType;

            $filePath = UPLOADS_PATH .'img/' . $pathId .'/'. basename($fileName);

            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            if (in_array($fileType, $this->validFileTypes)) {
                if(!is_dir(UPLOADS_PATH .'img/' . $pathId)){
                    mkdir(UPLOADS_PATH .'img/' . $pathId, 0777, true);
                }
                if (move_uploaded_file($tempFileName, $filePath)) {
                    return $fileName;
                }
            } else {
                return NULL;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function DeleteImage($image, $filePath) {
        

    }

    public function EditImage($oldImage, $newImage, $pathId){
        
    }
}
