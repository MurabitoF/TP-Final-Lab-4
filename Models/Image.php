<?php
namespace Models;

class Image{
    private $idImage;
    private $imageName;

    public function __construct($imageName, $idImage = NULL) {
        $this->imageName = $imageName;
    }

	public function getIdImage(){ return $this->idImage; }
	public function setIdImage($idImage){ $this->idImage = $idImage; }

	public function getImageName(){ return $this->imageName; }
	public function setImageName($imageName){ $this->imageName = $imageName; }
}
?>