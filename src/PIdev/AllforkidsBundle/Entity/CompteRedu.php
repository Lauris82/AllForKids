<?php

namespace PIdev\AllforkidsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompteRedu
 *
 * @ORM\Table(name="compte_redu")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\CompteReduRepository")
 */
class CompteRedu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cr", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_cr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCompteRendu", type="date")
     */
    private $dateCompteRendu;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;




    /**
     * @var string
     *
     * @ORM\Column(name="humeur", type="string", length=255)
     */
    private $humeur;


    /**
     * @var string
     *
     * @ORM\Column(name="etatS", type="string", length=255)
     */
    private $etatS;

    /**
     * @var string
     *
     * @ORM\Column(name="selles", type="string", length=255)
     */
    private $selles;

    /**
     * @var string
     *
     * @ORM\Column(name="apporter", type="string", length=255)
     */
    private $apporter;
    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="activite", type="string", length=255)
     */
    private $activite;

    /**
     * @var string
     *
     * @ORM\Column(name="medicament", type="string", length=255)
     */
    private $medicament;

    /**
     * @var string
     *
     * @ORM\Column(name="separation", type="string", length=255)
     */
    private $separation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDS",  type="date")
     */
    private $dateDS;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFS",  type="date")
     */
    private $dateFS;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HeureD",  type="date")
     */
    private $HeureD;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HeureF",  type="date")
     */
    private $HeureF;
    /**
     * @var int
     *
     * @ORM\Column(name="nbrBib", type="integer")
     */
    private $nbrBib;


    /**
     * @var int
     *
     * @ORM\Column(name="nbrCouche", type="integer")
     */
    private $nbrCouche;


    /**
     * @var int
     *
     * @ORM\Column(name="temperature", type="integer")
     */
    private $temperature;

    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\Enfant")
     *@ORM\JoinColumn(name="enfant_cr",referencedColumnName="id_enfant")
     */
    private $enfant;

    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     * @ORM\JoinColumn(name="userCompteR",referencedColumnName="id")
     */
    private $user;


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
     * @return mixed
     */
    public function getEnfant()
    {
        return $this->enfant;
    }

    /**
     * @param mixed $enfant
     */
    public function setEnfant($enfant)
    {
        $this->enfant = $enfant;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId_cr()
    {
        return $this->id_cr;
    }

    /**
     * Set dateCompteRendu
     *
     * @param \DateTime $dateCompteRendu
     *
     * @return CompteRedu
     */
    public function setDateCompteRendu($dateCompteRendu)
    {
        $this->dateCompteRendu = $dateCompteRendu;

        return $this;
    }

    /**
     * Get dateCompteRendu
     *
     * @return \DateTime
     */
    public function getDateCompteRendu()
    {
        return $this->dateCompteRendu;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CompteRedu
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
     * @return mixed
     */
    public function getHumeur()
    {
        return $this->humeur;
    }

    /**
     * @param mixed $humeur
     */
    public function setHumeur($humeur)
    {
        $this->humeur = $humeur;
    }

    /**
     * @return mixed
     */
    public function getEtatS()
    {
        return $this->etatS;
    }

    /**
     * @param mixed $etatS
     */
    public function setEtatS($etatS)
    {
        $this->etatS = $etatS;
    }

    /**
     * @return mixed
     */
    public function getSelles()
    {
        return $this->selles;
    }

    /**
     * @param mixed $selles
     */
    public function setSelles($selles)
    {
        $this->selles = $selles;
    }

    /**
     * @return mixed
     */
    public function getApporter()
    {
        return $this->apporter;
    }

    /**
     * @param mixed $apporter
     */
    public function setApporter($apporter)
    {
        $this->apporter = $apporter;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * @param mixed $activite
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;
    }

    /**
     * @return mixed
     */
    public function getMedicament()
    {
        return $this->medicament;
    }

    /**
     * @param mixed $medicament
     */
    public function setMedicament($medicament)
    {
        $this->medicament = $medicament;
    }

    /**
     * @return mixed
     */
    public function getSeparation()
    {
        return $this->separation;
    }

    /**
     * @param mixed $separation
     */
    public function setSeparation($separation)
    {
        $this->separation = $separation;
    }

    /**
     * @return mixed
     */
    public function getDateDS()
    {
        return $this->dateDS;
    }

    /**
     * @param mixed $dateDS
     */
    public function setDateDS($dateDS)
    {
        $this->dateDS = $dateDS;
    }

    /**
     * @return mixed
     */
    public function getDateFS()
    {
        return $this->dateFS;
    }

    /**
     * @param mixed $dateFS
     */
    public function setDateFS($dateFS)
    {
        $this->dateFS = $dateFS;
    }

    /**
     * @return mixed
     */
    public function getHeureD()
    {
        return $this->HeureD;
    }

    /**
     * @param mixed $HeureD
     */
    public function setHeureD($HeureD)
    {
        $this->HeureD = $HeureD;
    }

    /**
     * @return mixed
     */
    public function getHeureF()
    {
        return $this->HeureF;
    }

    /**
     * @param mixed $HeureF
     */
    public function setHeureF($HeureF)
    {
        $this->HeureF = $HeureF;
    }

    /**
     * @return mixed
     */
    public function getNbrBib()
    {
        return $this->nbrBib;
    }

    /**
     * @param mixed $nbrBib
     */
    public function setNbrBib($nbrBib)
    {
        $this->nbrBib = $nbrBib;
    }

    /**
     * @return mixed
     */
    public function getNbrCouche()
    {
        return $this->nbrCouche;
    }

    /**
     * @param mixed $nbrCouche
     */
    public function setNbrCouche($nbrCouche)
    {
        $this->nbrCouche = $nbrCouche;
    }

    /**
     * @return mixed
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param mixed $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return int
     */





}

