<?php
namespace DAO;

use Models\CV as CV;

interface ICurriculumDAO{
    public function UploadCV($cv, $idJobOffer);
    public function DeleteCV($cv, $idJobOffer);
    public function EditCV($oldCv, $newCv, $idJobOffer);
    public function CreateBundleCV($idJobOffer);
}