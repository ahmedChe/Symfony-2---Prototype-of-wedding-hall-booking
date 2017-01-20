<?php

namespace FrontOffice\ResponsableBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="FrontOffice\ResponsableBundle\Entity\Repo\ServiceRepository")
 */
class Service
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_service", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idService;
    /**
     * @var string
     *
     * @ORM\Column(name="libelle_service", type="string", length=35, nullable=false)
     */
    private $libelleService;
    /**
     *
     *@ORM\ManyToOne(targetEntity="Salle", inversedBy="services")
     *@ORM\JoinColumn(name="salle", referencedColumnName="id_salle")
     */
    private $salle;
    /**
     *
     *@ORM\ManyToOne(targetEntity="Categorie", inversedBy="services")
     *@ORM\JoinColumn(name="categorie", referencedColumnName="id_categorie")
     */
    private $categorie;
    /**
     *
     *@ORM\OneToMany(targetEntity="Proposition", mappedBy="service",cascade={"persist", "remove", "merge"})
     */
    private $propositions;
    /**
     * @return Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param Categorie $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return int
     */
    public function getIdService()
    {
        return $this->idService;
    }
    public function getService()
    {
        return $this;
    }
    /**
     * @param int $idService
     */
    public function setIdService($idService)
    {
        $this->idService = $idService;
    }

    /**
     * @return string
     */
    public function getLibelleService()
    {
        return $this->libelleService;
    }

    /**
     * @param string $libelleService
     */
    public function setLibelleService($libelleService)
    {
        $this->libelleService = $libelleService;
    }

    /**
     * @return \FrontOffice\ResponsableBundle\Entity\Salle
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * @param \FrontOffice\ResponsableBundle\Entity\Salle $salle
     */
    public function setSalle($salle)
    {
        $this->salle = $salle;
    }
    public function __toString ()
    {
        Return empty($this->libelleService) ? "--- Session ---" : $this->libelleService;
    }
    public function __construct() {
        $this->propositions= new ArrayCollection();
    }


    /**
     * Add propositions
     *
     * @param \FrontOffice\ResponsableBundle\Entity\Proposition $propositions
     * @return Service
     */
    public function addProposition(\FrontOffice\ResponsableBundle\Entity\Proposition $propositions)
    {
        $this->propositions[] = $propositions;

        return $this;
    }

    /**
     * Remove propositions
     *
     * @param \FrontOffice\ResponsableBundle\Entity\Proposition $propositions
     */
    public function removeProposition(\FrontOffice\ResponsableBundle\Entity\Proposition $propositions)
    {
        $this->propositions->removeElement($propositions);
    }

    /**
     * Get propositions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPropositions()
    {
        return $this->propositions;
    }
}
