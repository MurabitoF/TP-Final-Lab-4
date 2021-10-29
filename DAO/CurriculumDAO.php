<?php

namespace DAO;

use \Exception as Exception;
use DAO\ICurriculumDAO as ICurriculumDAO;
use Models\CV as CV;

class CurriculumDAO implements ICurriculumDAO
{
    private $validFileTypes = ["pdf", "doc", "docx", "odt", "ott", "oxt"];

    public function UploadCV($cv)
    {
        try {
            $fileName = $cv["name"];
            $tempFileName = $cv["tmp_name"];
            $fileType = $cv["type"];

            $filePath = UPLOADS_PATH . basename($fileName);

            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            if (in_array($fileType, $this->validFileTypes)) {
                if (move_uploaded_file($tempFileName, $filePath)) {
                    $cv = new CV($fileName);
                    return $cv;
                }
            } else {
                return NULL;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
