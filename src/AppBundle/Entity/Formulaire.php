<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Formulaire
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(name="gender", length=6)
     * @Assert\Choice(callback = "getGenderKeys")
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(max="250")
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(max="250")
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", nullable=false)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime", name="datebirth", nullable=false)
     */
    private $datebirth;

    /**
     * @ORM\Column(name="offer", type="boolean")
     */
    private $offer;

    /**
     * @var string
     *
     * @ORM\Column(name="country")
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(max = 5)
     */
    private $zipcode;

    /**
     * @ORM\Column(name="other_residence", type="boolean")
     */
    private $otherResidence;

    /**
     * @var string
     *
     * @ORM\Column(name="other_country")
     */
    private $otherCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="id_number_fiscale")
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
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    private static $genderValues = [
        'M' => 'male',
        'Mme' => 'female',
    ];

    public static function getGenderValues()
    {
        return static::$genderValues;
    }

    public static function getGenderKeys()
    {
        return array_values(static::$genderValues);
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
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

        return $this;
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

        return $this;
    }

    /**
     * @return string
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * @param string $offer
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
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

        return $this;
    }

    /**
     * @return string
     */
    public function getOtherResidence()
    {
        return $this->otherResidence;
    }

    /**
     * @param string $otherResidence
     */
    public function setOtherResidence($otherResidence)
    {
        $this->otherResidence = $otherResidence;

        return $this;
    }

    private static $otherResidenceValues = [
        'No' => false,
        'Yes' => true,
    ];

    public static function getOtherResidenceValues()
    {
        return static::$otherResidenceValues;
    }

    public static function getOtherResidenceKeys()
    {
        return array_values(static::$otherResidenceValues);
    }

    /**
     * @return string
     */
    public function getOtherCountry()
    {
        return $this->otherCountry;
    }

    /**
     * @param string $otherCountry
     */
    public function setOtherCountry($otherCountry)
    {
        $this->otherCountry = $otherCountry;

        return $this;
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

        return $this;
    }
}
