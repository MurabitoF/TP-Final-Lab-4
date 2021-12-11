<?php
namespace DAO;
use Models\Image as Image;

interface IImageDAO{
    public function UploadImage($image);
    public function DeleteImage($image);
    public function EditImage($oldImage, $newImage);
}
?>