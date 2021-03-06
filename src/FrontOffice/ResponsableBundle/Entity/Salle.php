<?php

namespace FrontOffice\ResponsableBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Salle
 *
 * @ORM\Table(name="salle")
 * @ORM\Entity
 */
class Salle
{
    private $prix;

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id_salle", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_salle", type="string", length=35, nullable=false)
     */
    private $nomSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_salle", type="string", length=100, nullable=false)
     */
    private $adresseSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="type_salle", type="string", length=30, nullable=false)
     */
    private $typeSalle;

    /**
     * @var float
     *
     * @ORM\Column(name="surface_salle", type="float", precision=10, scale=0, nullable=false)
     */
    private $surfaceSalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacite_salle", type="integer", nullable=false)
     */
    private $capaciteSalle;
    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=250, nullable=false)
     */
    private $photo;

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @var integer
     * @ORM\OneToOne(targetEntity="FrontOffice\StaticBundle\Entity\Responsable", cascade={"persist", "merge", "remove"})
     * @ORM\JoinColumn(name="Responsable", referencedColumnName="CIN")
     */
    private $responsable;
    /**
     *
     * @ORM\OneToMany(targetEntity="Saison", mappedBy="salle",cascade={"persist", "remove", "merge"}, indexBy="saisons")
     */
    private $saisons;
    /**
     *
     * @ORM\OneToMany(targetEntity="Service", mappedBy="salle",cascade={"persist", "remove", "merge"},indexBy="services")
     */
    private $services;

    /**
     * Salle constructor.
     * @param int $idSalle
     * @param string $nomSalle
     * @param string $adresseSalle
     * @param string $typeSalle
     * @param float $surfaceSalle
     * @param int $capaciteSalle
     * @param int $responsable
     * @param $saisons
     * @param $services
     */
    public function __construct($nomSalle, $adresseSalle, $typeSalle, $surfaceSalle, $capaciteSalle, $photo, $responsable)
    {
        $this->nomSalle = $nomSalle;
        $this->adresseSalle = $adresseSalle;
        $this->typeSalle = $typeSalle;
        $this->surfaceSalle = $surfaceSalle;
        $this->capaciteSalle = $capaciteSalle;
        $this->photo = $photo;
        $this->responsable = $responsable;
        $this->saisons = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSaisons()
    {
        return $this->saisons;
    }

    /**
     * @param mixed $saisons
     */
    public function setSaisons($saisons)
    {
        $this->saisons = $saisons;
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
     * @return int
     */
    public function getIdSalle()
    {
        return $this->idSalle;
    }

    /**
     * @param int $idSalle
     */
    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;
    }

    /**
     * @return string
     */
    public function getNomSalle()
    {
        return $this->nomSalle;
    }

    /**
     * @param string $nomSalle
     */
    public function setNomSalle($nomSalle)
    {
        $this->nomSalle = $nomSalle;
    }

    /**
     * @return string
     */
    public function getAdresseSalle()
    {
        return $this->adresseSalle;
    }

    /**
     * @param string $adresseSalle
     */
    public function setAdresseSalle($adresseSalle)
    {
        $this->adresseSalle = $adresseSalle;
    }

    /**
     * @return string
     */
    public function getTypeSalle()
    {
        return $this->typeSalle;
    }

    /**
     * @param string $typeSalle
     */
    public function setTypeSalle($typeSalle)
    {
        $this->typeSalle = $typeSalle;
    }

    /**
     * @return float
     */
    public function getSurfaceSalle()
    {
        return $this->surfaceSalle;
    }

    /**
     * @param float $surfaceSalle
     */
    public function setSurfaceSalle($surfaceSalle)
    {
        $this->surfaceSalle = $surfaceSalle;
    }

    /**
     * @return int
     */
    public function getCapaciteSalle()
    {
        return $this->capaciteSalle;
    }

    /**
     * @param int $capaciteSalle
     */
    public function setCapaciteSalle($capaciteSalle)
    {
        $this->capaciteSalle = $capaciteSalle;
    }

    /**
     * @return int
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * @param int $responsable
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    }

    public function __toString()
    {
        Return empty($this->nomSalle) ? "--- Session ---" : $this->nomSalle;
    }



    /**
     * Add saisons
     *
     * @param \FrontOffice\ResponsableBundle\Entity\Saison $saisons
     * @return Salle
     */
    public function addSaison(\FrontOffice\ResponsableBundle\Entity\Saison $saisons)
    {
        $this->saisons[] = $saisons;

        return $this;
    }

    /**
     * Remove saisons
     *
     * @param \FrontOffice\ResponsableBundle\Entity\Saison $saisons
     */
    public function removeSaison(\FrontOffice\ResponsableBundle\Entity\Saison $saisons)
    {
        $this->saisons->removeElement($saisons);
    }

    /**
     * Add services
     *
     * @param \FrontOffice\ResponsableBundle\Entity\Service $services
     * @return Salle
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


    /**
     * @ORM\OneToMany(targetEntity="FrontOffice\ClientBundle\Entity\Reservation", mappedBy="salle")
     */
    private $reservations;

    /**
     * @return mixed
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * @param mixed $reservations
     */
    public function setReservations($reservations)
    {
        $this->reservations = $reservations;
    }
}
