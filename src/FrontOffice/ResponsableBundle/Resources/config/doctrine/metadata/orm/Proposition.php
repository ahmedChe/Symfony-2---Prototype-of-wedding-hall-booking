<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Proposition
 *
 * @ORM\Table(name="proposition")
 * @ORM\Entity
 */
class Proposition
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


}
