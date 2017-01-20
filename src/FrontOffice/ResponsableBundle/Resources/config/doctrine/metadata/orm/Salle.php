<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Salle
 *
 * @ORM\Table(name="salle", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_4E977E5CD4CE82D0", columns={"Responsable"})})
 * @ORM\Entity
 */
class Salle
{
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
     * @var \Responsable
     *
     * @ORM\ManyToOne(targetEntity="Responsable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Responsable", referencedColumnName="CIN")
     * })
     */
    private $responsable;
    /**
     * @ORMOneToMany(targetEntity="Service", mappedBy="salle", cascade={"persist", "remove", "merge"})
     */
    private $services;
    public function __construct() {
        $this->services = new ArrayCollection();
    }
}
