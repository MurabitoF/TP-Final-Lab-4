<?php

namespace DAO;

use \Exception as Exception;
use DAO\IImageDAO as IImageDAO;

class ImageDAO implements IImageDAO
{
    private $validFileTypes = ["bmp", "jpg", "jpeg", "png"];

    public function UploadImage($image)
    {
        try {
            $fileName = $image["name"];
            $tempFileName = $image["tmp_name"];
            $fileType = $image["type"];

            $filePath = UPLOADS_PATH . 'img/flyer/' . basename($fileName);

            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $newFilePath = UPLOADS_PATH . 'img/flyer/' . uniqid("fl_") . ".$fileType";

            if (in_array($fileType, $this->validFileTypes)) {
                if (!is_dir(UPLOADS_PATH . 'img/flyer')) {
                    mkdir(UPLOADS_PATH . 'img/flyer', 0777, true);
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

    public function DeleteImage($image)
    {
        try {
            $filePath = UPLOADS_PATH . 'img/flyer/' . $image;
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

    public function EditImage($oldImage, $newImage)
    {
        try {
            if ($this->DeleteImage($oldImage)) {
                    $image = $this->UploadImage($newImage);
                if ($image) {
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
