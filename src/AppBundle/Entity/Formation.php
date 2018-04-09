<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormationRepository")
 * @ORM\Table(name="formation")
 * @ApiResource
 *
 * @UniqueEntity("name")
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(type="string", name="name")
     */
    private $name;
    /**
     * @ORM\Column(type="string", name="place")
     */
    private $place;
    /**
     * @ORM\Column(type="string", name="debut")
     */
    private $debut;
    /**
     * @ORM\Column(type="string", name="fin")
     */
    private $fin;
     
     
    public function setId($value)
    {
        $this->id = $value;
    }
     
    public function getId()
    {
        return $this->id;
    }
     
    public function setName($value)
    {
        $this->name = $value;
    }
     
    public function getName()
    {
        return $this->name;
    }
     
    public function setPlace($value)
    {
        $this->place = $value;
    }
     
    public function getPlace()
    {
        return $this->place;
    }
     
    public function setDebut($value)
    {
        $this->debut = $value;
    }
     
    public function getDebut()
    {
        return $this->debut;
    }
     
    public function setFin($value)
    {
        $this->fin = $value;
    }
     
    public function getFin()
    {
        return $this->fin;
    }
}
