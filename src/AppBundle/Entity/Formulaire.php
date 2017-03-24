<?php
/**
 * Created by PhpStorm.
 * User: vasilina
 * Date: 23/03/2017
 * Time: 10:31
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Formulaire
 * @package AppBundle\Entity
 * @ORM\Entity
 */

class Formulaire
{

    /**
     * @var int The entity Id
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private  $datebirth;

    /**
     *
     * @ORM\Column(type="boolean")
     */
    private $offre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sexe;


    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max = 5)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="boolean")
     */
    private $autreResidence;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $autrePays;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $idNumberFiscale;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
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
     * @return \DateTimeInterface
     */
    public function getDatebirth()
    {
        return $this->datebirth;
    }

    /**
     * @param \DateTimeInterface $datebirth
     */
    public function setDatebirth($datebirth)
    {
        $this->datebirth = $datebirth;
    }

    /**
     * @return mixed
     */
    public function getOffre()
    {
        return $this->offre;
    }

    /**
     * @param mixed $offre
     */
    public function setOffre($offre)
    {
        $this->offre = $offre;
    }

    /**
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param string $pays
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return mixed
     */
    public function getAutreResidence()
    {
        return $this->autreResidence;
    }

    /**
     * @param mixed $autreResidence
     */
    public function setAutreResidence($autreResidence)
    {
        $this->autreResidence = $autreResidence;
    }

    /**
     * @return string
     */
    public function getAutrePays()
    {
        return $this->autrePays;
    }

    /**
     * @param string $autrePays
     */
    public function setAutrePays($autrePays)
    {
        $this->autrePays = $autrePays;
    }

    /**
     * @return string
     */
    public function getIdNumberFiscale()
    {
        return $this->idNumberFiscale;
    }

    /**
     * @param string $idNumberFiscale
     */
    public function setIdNumberFiscale($idNumberFiscale)
    {
        $this->idNumberFiscale = $idNumberFiscale;
    }



}