<?php

namespace FrontOffice\ResponsableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Proposition
 *
 * @ORM\Table(name="proposition")
 * @ORM\Entity
 */
class Proposition implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_proposition", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProposition;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_proposition", type="string", length=50, nullable=false)
     */
    private $libelleProposition;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_proposition", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixProposition;
    /**
     *
     * @ORM\ManyToOne (targetEntity="Service", inversedBy="propositions")
     * @ORM\JoinColumn(name="service", referencedColumnName="id_service")
     */
    private $service;
    public function __toString ()
    {
        Return empty($this->libelleProposition) ? "--- Session ---" : $this->libelleProposition;
    }

    /**
     * @return int
     */
    public function getIdProposition()
    {
        return $this->idProposition;
    }

    /**
     * @param int $idProposition
     */
    public function setIdProposition($idProposition)
    {
        $this->idProposition = $idProposition;
    }

    /**
     * @return string
     */
    public function getLibelleProposition()
    {
        return $this->libelleProposition;
    }

    /**
     * @param string $libelleProposition
     */
    public function setLibelleProposition($libelleProposition)
    {
        $this->libelleProposition = $libelleProposition;
    }

    /**
     * @return float
     */
    public function getPrixProposition()
    {
        return $this->prixProposition;
    }

    /**
     * @param float $prixProposition
     */
    public function setPrixProposition($prixProposition)
    {
        $this->prixProposition = $prixProposition;
    }

    /**
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param Service $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return array(
          'libelle'=>$this->getLibelleProposition(),
          'Id'=>$this->getIdProposition(),
        );
    }
}
