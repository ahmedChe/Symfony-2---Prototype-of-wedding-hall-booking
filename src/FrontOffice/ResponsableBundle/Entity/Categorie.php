<?php

namespace FrontOffice\ResponsableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_categorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_categorie", type="string", length=35, nullable=false)
     */
    private $libelleCategorie;
    /**
     *
     *@ORM\OneToMany(targetEntity="Service", mappedBy="categorie",cascade={"persist", "remove", "merge"})
     */
    private $services;

    public function __construct()
    {
        $this->services= new ArrayCollection();
    }
    public function __toString ()
    {
        Return empty($this->libelleCategorie) ? "--- Session ---" : $this->libelleCategorie;
    }

    /**
     * @return int
     */
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * @param int $idCategorie
     */
    public function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;
    }

    /**
     * @return string
     */
    public function getLibelleCategorie()
    {
        return $this->libelleCategorie;
    }

    /**
     * @param string $libelleCategorie
     */
    public function setLibelleCategorie($libelleCategorie)
    {
        $this->libelleCategorie = $libelleCategorie;
    }

    /**
     * @return mixed
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param mixed $services
     */
    public function setServices($services)
    {
        $this->services = $services;
    }


    /**
     * Add services
     *
     * @param \FrontOffice\ResponsableBundle\Entity\Service $services
     * @return Categorie
     */
    public function addService(\FrontOffice\ResponsableBundle\Entity\Service $services)
    {
        $this->services[] = $services;

        return $this;
    }

    /**
     * Remove services
     *
     * @param \FrontOffice\ResponsableBundle\Entity\Service $services
     */
    public function removeService(\FrontOffice\ResponsableBundle\Entity\Service $services)
    {
        $this->services->removeElement($services);
    }
}
