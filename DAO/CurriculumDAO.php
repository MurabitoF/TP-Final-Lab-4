<?php

namespace DAO;

use \Exception as Exception;
use DAO\ICurriculumDAO as ICurriculumDAO;
use Models\CV as CV;

class CurriculumDAO implements ICurriculumDAO
{
    private $validFileTypes = ["pdf", "doc", "docx", "odt", "ott", "oxt", "txt"];

    public function UploadCV($cv, $idJobOffer)
    {
        try {
            $fileName = $cv["name"];
            $tempFileName = $cv["tmp_name"];
            $fileType = $cv["type"];

            $filePath = UPLOADS_PATH . $idJobOffer .'/'. basename($fileName);

            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            if (in_array($fileType, $this->validFileTypes)) {
                if(!is_dir(UPLOADS_PATH . $idJobOffer )){
                    mkdir(UPLOADS_PATH . $idJobOffer );
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
}
