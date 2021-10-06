<?php
    namespace Models;

    class City{
        private $name;
        private $province;
        private $areaCode;

        public function __construct($name, $province, $areaCode) {
            $this->name = $name;
            $this->province = $province;
            $this->areaCode = $province;
        }

        public function getName(){ return $this->name; }
        public function setName($name){ $this->name = $name; }

        public function getProvince(){ return $this->province; }
        public function setProvince($province){ $this->province = $province; }

        public function getAreaCode(){ return $this->areaCode; }
        public function setAreaCode($areaCode){ $this->areaCode = $areaCode; }
    }
?>