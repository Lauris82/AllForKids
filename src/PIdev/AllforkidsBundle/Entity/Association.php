<?php

namespace PIdev\AllforkidsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Association
 *
 * @ORM\Table(name="association")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\AssociationRepository")
 */
class Association
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_aasociation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id_aasociation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     * @var int
     *
     * @ORM\Column(name="num_tel", type="integer")
     */
    private $numTel;
    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     *@ORM\JoinColumn(name="association_user",referencedColumnName="id")
     */
    private $user;


    /**
     * @var string
     *
     * @ORM\Column(name="gouvernorat", type="string", length=255)
     */
    private $gouvernorat;

    /**
     * @var string
     *
     * @ORM\Column(name="municipalite", type="string", length=255)
     */
    private $municipalite;


    /**
     * @var string
     *
     * @ORM\Column(name="nomrue", type="string", length=255)
     */
    private $nomrue;

    /**
     * @var string
     *
     * @ORM\Column(name="coderue", type="string", length=255)
     */
    private $coderue;



    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float")
     */
    private $lat;


    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="float")
     */
    private $lng;




    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId_aasociation()
    {
        return $this->id_aasociation;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Association
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Association
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * Set numTel
     *
     * @param integer $numTel
     *
     * @return Association
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get numTel
     *
     * @return int
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * Get gouvernorat
     *
     * @return string
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * Set gouvernorat
     *
     * @param string $gouvernorat
     */
    public function setGouvernorat($gouvernorat)
    {
        $this->gouvernorat = $gouvernorat;
    }

    /**
     * Get municipalite
     *
     * @return string
     */
    public function getMunicipalite()
    {
        return $this->municipalite;
    }

    /**
     * @param string $municipalite
     */
    public function setMunicipalite($municipalite)
    {
        $this->municipalite = $municipalite;
    }



    /**
     * Get coderue
     *
     * @return string
     */
    public function getCoderue()
    {
        return $this->coderue;
    }

    /**
     * @param string $coderue
     */
    public function setCoderue($coderue)
    {
        $this->coderue = $coderue;
    }

    /**
     * Get nomrue
     *
     * @return string
     */
    public function getNomrue()
    {
        return $this->nomrue;
    }

    /**
     * @param string $nomrue
     */
    public function setNomrue($nomrue)
    {
        $this->nomrue = $nomrue;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param float $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @param int $id_aasociation
     */
    public function setIdAasociation($id_aasociation)
    {
        $this->id_aasociation = $id_aasociation;
    }




}

