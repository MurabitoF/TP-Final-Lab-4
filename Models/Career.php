<?php

namespace Models;

class Career{

    private $idCareer;
    private $name;
    private $active;

    public function __construct()
    {
        $this->active = true;
    }

    public function getIdCareer()
    {
        return $this->idCareer;
    }

    public function setIdCareer($idCareer)
    {
        $this->idCareer = $idCareer;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }
}

?>