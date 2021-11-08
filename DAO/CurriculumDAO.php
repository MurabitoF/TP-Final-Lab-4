<?php

namespace DAO;

use \Exception as Exception;
use DAO\ICurriculumDAO as ICurriculumDAO;
use Models\CV as CV;
use ZipArchive;

class CurriculumDAO implements ICurriculumDAO
{
    private $validFileTypes = ["pdf", "doc", "docx", "odt", "ott", "oxt", "txt"];

    public function UploadCV($cv, $idJobOffer)
    {
        try {
            $fileName = $cv["name"];
            $tempFileName = $cv["tmp_name"];
            $fileType = $cv["type"];

            $filePath = UPLOADS_PATH . 'cv/' . $idJobOffer . '/' . basename($fileName);

            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $newFilePath = UPLOADS_PATH . 'cv/' . $idJobOffer . '/' . uniqid("cv_") . ".$fileType";

            echo $newFilePath;
            echo $fileType;
            if (in_array($fileType, $this->validFileTypes)) {
                if (!is_dir(UPLOADS_PATH . 'cv/' . $idJobOffer)) {
                    mkdir(UPLOADS_PATH . 'cv/' . $idJobOffer, 0777, true);
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

    public function DeleteCV($cv, $idJobOffer)
    {
        try {
            $filePath = UPLOADS_PATH . 'cv/' . $idJobOffer . '/' . $cv;
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

    public function EditCV($oldCv, $newCv, $idJobOffer)
    {
        try {
            if ($this->DeleteCV($oldCv, $idJobOffer)) {
                $cv = $this->UploadCV($newCv, $idJobOffer);
                if ($cv) {
                    return $cv;
                } else {
                    throw new Exception("Ocurrio un error al subir el nuevo curriculum");
                }
            } else {
                throw new Exception("Ocurrio un error al borrar el curriculum");
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function CreateBundleCV($idJobOffer)
    {
        $cvPath = UPLOADS_PATH . "cv/$idJobOffer/";
        $zipPath = UPLOADS_PATH . "cv/CV_$idJobOffer.zip";
        $zipFile = new ZipArchive();
        $zipFile->open($zipPath, ZipArchive::CREATE);
        $this->LoadCVToZip($zipFile,$cvPath);

        $zipFile->close();
    }

    private function LoadCVToZip($zipFile, $path)
    {
        if (is_dir($path)) {
            if ($dh = opendir($path)) {
                while (($file = readdir($dh)) !== false) {
                    if (is_file($path . $file)) {
                        if ($file != '' && $file != '.' && $file != '..') {
                            $zipFile->addFile($path . $file, $file);
                            var_dump($zipFile);
                        }
                    }
                }
                closedir($dh);
            }
        }
    }
}
