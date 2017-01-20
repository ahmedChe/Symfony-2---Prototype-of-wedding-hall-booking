<?php

namespace FrontOffice\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation",uniqueConstraints={@ORM\UniqueConstraint(name="reservation", columns={"client", "dateReservation","salle"})})
 * @ORM\Entity(repositoryClass="FrontOffice\ClientBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reservation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne (targetEntity="FrontOffice\ResponsableBundle\Entity\Salle", inversedBy="reservations")
     * @ORM\JoinColumn(name="salle", referencedColumnName="id_salle")
     */
    private $salle;

    /**
     * Reservation constructor.
     * @param int $salle
     * @param int $client
     * @param string $dateReservation
     * @param float $prix
     */
    public function __construct($salle, $client, $dateReservation, $prix)
    {
        $this->salle = $salle;
        $this->client = $client;
        $this->dateReservation = $dateReservation;
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * @param mixed $salle
     */
    public function setSalle($salle)
    {
        $this->salle = $salle;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }


    /**
     * @ORM\ManyToOne (targetEntity="FrontOffice\StaticBundle\Entity\Client", inversedBy="reservations")
     * @ORM\JoinColumn(name="client", referencedColumnName="CIN")
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="dateReservation", type="string", length=255)
     */
    private $dateReservation;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix", type="float")
     */
    private $prix;

    /**
     * @return int
     */
    public function getConfirm()
    {
        return $this->confirm;
    }

    /**
     * @param int $confirm
     */
    public function setConfirm($confirm)
    {
        $this->confirm = $confirm;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="Confirmation", type="integer",precision=1,options={"default" = 0})
     */
    private $confirm=0;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set dateReservation
     *
     * @param string $dateReservation
     * @return Reservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return string 
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Reservation
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
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
     * @ORM\OneToMany(targetEntity="ServiceDemande", mappedBy="reservation")
     */
    private $services;
}
