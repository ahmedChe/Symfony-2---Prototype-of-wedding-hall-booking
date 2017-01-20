<?php

namespace FrontOffice\StaticBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Responsable
 *
 * @ORM\Table(name="responsable")
 * @ORM\Entity(repositoryClass="FrontOffice\StaticBundle\Entity\ResponsableRepository")
 */
class Responsable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CIN", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=8,
     *     minMessage = "Il faut que ton Numéro d'identité contient au minimum 8 chiffres"
     *  )
     * @Assert\Type(
     *     type="integer",
     *     message="cette {{ value }} n'est pas de type {{ type }}."
     * )
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="NomPrenom", type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     */
    private $nomprenom;

    /**
     * @var integer
     *
     * @ORM\Column(name="Tel", type="integer", nullable=false)
     * @Assert\NotBlank()
     *  @Assert\Type(
     *     type="integer",
     *     message="cette {{ value }} n'est pas de type {{ type }}."
     * )
     * @Assert\Range(
     *      min = 10000000,
     *      minMessage = "Il faut que ton numéro contient au minimum 8 chiffres"
     * )
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide.",
     *     checkMX = false
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=250, nullable=false)
     */
    private $photo;
    /**
     * @var integer
     *
     * @ORM\Column(name="bloc", type="integer", nullable=false)
     */
    private $bloquage;

    /**
     * Responsable constructor.
     * @param int $cin
     * @param string $nomprenom
     * @param int $tel
     * @param string $email
     * @param string $photo
     * @param string $login
     * @param string $password
     * @param string $note
     * @param int $bloquage
     */
    public function __construct($cin, $nomprenom, $tel, $email, $photo, $login, $password, $note)
    {
        $this->cin = $cin;
        $this->nomprenom = $nomprenom;
        $this->tel = $tel;
        $this->email = $email;
        $this->photo = $photo;
        $this->login = $login;
        $this->password = $password;
        $this->bloquage = 0;
    }

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
     * @var string
     *
     * @ORM\Column(name="Login", type="string", length=20, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 8,
     *      minMessage = "Il faut que ton nom d'utilisateur contient au minimum {{ limit }} caractéres"
     * )
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=15, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 8,
     *      max = 15,
     *      minMessage = "Il faut que ton mot de passe contient au minimum {{ limit }} caractéres",
     *      maxMessage = "Il faut que ton mot de passe contient au maximum {{ limit }} caractéres"
     * )
     */
    private $password;


    private $note;
    /**
     * @return int
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param int $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @return string
     */
    public function getNomprenom()
    {
        return $this->nomprenom;
    }

    /**
     * @param string $nomprenom
     */
    public function setNomprenom($nomprenom)
    {
        $this->nomprenom = $nomprenom;
    }

    /**
     * @return int
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param int $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @return int
     */
    public function getBloquage()
    {
        return $this->bloquage;
    }

    /**
     * @param int $bloquage
     */
    public function setBloquage($bloquage)
    {
        $this->bloquage = $bloquage;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }


}
