<?php
namespace DAO;

use Models\CV as CV;

interface ICurriculumDAO{
    public function UploadCV($fileCV);
}