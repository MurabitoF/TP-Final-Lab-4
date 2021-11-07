<?php

namespace DAO;

use \Exception as Exception;
use DAO\IImageDAO as IImageDAO;
use Models\Image as Image;

class ImageDAO implements IImageDAO
{
    private $validFileTypes = ["bmp", "jpg", "jpeg", "png"];

    public function UploadImage($image, $pathId)
    {
        try {
            $fileName = $image["name"];;
            $tempFileName = $image["tmp_name"];
            $fileType = $image["type"];

            if ($pathId == "flyer") {
                $preFix = "fl_"; //Flyer
            } elseif ($pathId == "student") {
                $preFix = "sp_"; // Student Picture
            } else {
                $preFix = "lg_"; // Company Logo
            }
            // $filePath = UPLOADS_PATH .'img/' . $pathId .'/'. basename($fileName);
            $newFilePath = UPLOADS_PATH . 'img/' . $pathId . '/' . uniqid($preFix) . ".$fileType";

            $fileType = strtolower(pathinfo($newFilePath, PATHINFO_EXTENSION));

            echo $newFilePath;
            if (in_array($fileType, $this->validFileTypes)) {
                if (!is_dir(UPLOADS_PATH . 'img/' . $pathId)) {
                    mkdir(UPLOADS_PATH . 'img/' . $pathId, 0777, true);
                }
                if (move_uploaded_file($tempFileName, $newFilePath)) {
                    return basename($newFilePath);
                }
            } else {
                return NULL;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function DeleteImage($image, $pathId)
    {
        try {
            $filePath = UPLOADS_PATH . 'img/' . $pathId . '/' . $image;
            if (file_exists($filePath)) {
                unlink($filePath);
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function EditImage($oldImage, $newImage, $pathId)
    {
        try {
            if($this->DeleteImage($oldImage, $pathId)){
                $image = $this->UploadImage($newImage, $pathId);
                if($image){
                    return $image;
                } else {
                    throw new Exception("Ocurrio un error al subir la nueva imagen");
                }
            } else {
                throw new Exception("Ocurrio un error al borrar la imagen");
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
