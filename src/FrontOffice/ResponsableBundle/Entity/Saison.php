<?php

namespace FrontOffice\ResponsableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Saison
 *
 * @ORM\Table(name="saison")
 * @ORM\Entity
 */
class Saison
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\ManyToOne (targetEntity="Salle", inversedBy="saisons", cascade={"persist", "merge"})
     * @ORM\Column(name="id_salle",type="integer")
     */
    private $idSalle;

    /**
     * @var string
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(name="Debut", type="string", nullable=false,length=10)
     */
    private $debut;

    /**
     * Saison constructor.
     * @param int $idSalle
     * @param string $debut
     * @param string $fin
     * @param float $prix
     */
    public function __construct($idSalle, $debut, $fin, $prix)
    {
        $this->idSalle = $idSalle;
        $this->debut = $debut;
        $this->fin = $fin;
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * @param string $debut
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;
    }

    /**
     * @return string
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * @param string $fin
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="Fin", type="string", nullable=false,length=10)
     */
    private $fin;
    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @return Salle
     */
    public function getIdSalle()
    {
        return $this->idSalle;
    }

    /**
     * @param Salle $idSalle
     */
    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;
    }



    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }
    public function __toString ()
    {
        Return empty($this->libelleSaison) ? "--- Session ---" : $this->libelleSaison;
    }

}
