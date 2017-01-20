<?php

namespace FrontOffice\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServiceDemande
 *
 * @ORM\Table(name="service_demande")
 * @ORM\Entity(repositoryClass="FrontOffice\ClientBundle\Repository\ServiceDemandeRepository")
 */
class ServiceDemande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=100)
     */
    private $libelle;

    /**
     * ServiceDemande constructor.
     * @param $reservation
     * @param string $libelle
     */
    public function __construct($reservation, $libelle)
    {
        $this->reservation = $reservation;
        $this->libelle = $libelle;
    }


    /**
     * @return mixed
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * @param mixed $reservation
     */
    public function setReservation($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * @ORM\ManyToOne (targetEntity="Reservation", inversedBy="service_demande")
     * @ORM\JoinColumn(name="reservation", referencedColumnName="id_reservation")
     */
    private $reservation;
    /**
     * ServiceDemande constructor.
     * @param string $libelle
     * @param int $client
     */


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
     * Set libelle
     *
     * @param string $libelle
     * @return ServiceDemande
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }


}
