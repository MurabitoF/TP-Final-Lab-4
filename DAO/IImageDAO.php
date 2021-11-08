<?php
namespace DAO;
use Models\Image as Image;

interface IImageDAO{
    public function UploadImage($image, $pathId);
    public function DeleteImage($image, $pathId);
    public function EditImage($oldImage, $newImage, $pathId);
}
?>