<?php



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
     * @ORM\ManyToOne (targetEntity="Salle", inversedBy="services")
     * @ORM\JoinColumn(name="salle", referencedColumnName="id_salle")
     */
    private $salle;

    /**
     * @return int
     */
    public function getIdService()
    {
        return $this->idService;
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
}
