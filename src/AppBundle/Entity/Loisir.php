<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LoisirRepository")
 * @ORM\Table(name="loisir")
 * @ApiResource
 */
class Loisir
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
     
    /**
     * @ORM\Column(type="string", name="name")
     */
    private $name;
     
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
     
    public function getLowerName()
    {
        return strtolower($this->name);
    }
}
