<?php

namespace PIdev\AllforkidsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompteRPS
 *
 * @ORM\Table(name="compte_r_p_s")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\CompteRPSRepository")
 */
class CompteRPS
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCRPS", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idCRPS;


    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\Enfant")
     *@ORM\JoinColumn(name="enfantCRPS",referencedColumnName="id_enfant")
     */
    private $enfant;

    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     * @ORM\JoinColumn(name="userCRPS",referencedColumnName="id")
     */
    private $user;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCompteRendu",  type="date")
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
     * @ORM\Column(name="nbrRepas", type="integer")
     */
    private $nbrRepas;

    /**
     * @var string
     *
     * @ORM\Column(name="etatMangee", type="string")
     */
    private $etatMangee;


    /**
     * @var int
     *
     * @ORM\Column(name="temperature", type="integer")
     */
    private $temperature;


    /**
     * @var string
     * @ORM\Column(name="respectee",type="string")
     */
    private $respectee;





    /**
     * Get idCRPS
     *
     * @return int
     */
    public function getId()
    {
        return $this->idCRPS;
    }

    /**
     * @return int
     */
    public function getIdCRPS()
    {
        return $this->idCRPS;
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
    public function getDateCompteRendu()
    {
        return $this->dateCompteRendu;
    }

    /**
     * @param mixed $dateCompteRendu
     */
    public function setDateCompteRendu($dateCompteRendu)
    {
        $this->dateCompteRendu = $dateCompteRendu;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getHumeur()
    {
        return $this->humeur;
    }

    /**
     * @param string $humeur
     */
    public function setHumeur($humeur)
    {
        $this->humeur = $humeur;
    }

    /**
     * @return string
     */
    public function getEtatS()
    {
        return $this->etatS;
    }

    /**
     * @param string $etatS
     */
    public function setEtatS($etatS)
    {
        $this->etatS = $etatS;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * @param string $activite
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;
    }

    /**
     * @return string
     */
    public function getSeparation()
    {
        return $this->separation;
    }

    /**
     * @param string $separation
     */
    public function setSeparation($separation)
    {
        $this->separation = $separation;
    }

    /**
     * @return \DateTime
     */
    public function getDateDS()
    {
        return $this->dateDS;
    }

    /**
     * @param \DateTime $dateDS
     */
    public function setDateDS($dateDS)
    {
        $this->dateDS = $dateDS;
    }

    /**
     * @return \DateTime
     */
    public function getDateFS()
    {
        return $this->dateFS;
    }

    /**
     * @param \DateTime $dateFS
     */
    public function setDateFS($dateFS)
    {
        $this->dateFS = $dateFS;
    }

    /**
     * @return \DateTime
     */
    public function getHeureD()
    {
        return $this->HeureD;
    }

    /**
     * @param \DateTime $HeureD
     */
    public function setHeureD($HeureD)
    {
        $this->HeureD = $HeureD;
    }

    /**
     * @return \DateTime
     */
    public function getHeureF()
    {
        return $this->HeureF;
    }

    /**
     * @param \DateTime $HeureF
     */
    public function setHeureF($HeureF)
    {
        $this->HeureF = $HeureF;
    }

    /**
     * @return int
     */
    public function getNbrRepas()
    {
        return $this->nbrRepas;
    }

    /**
     * @param int $nbrRepas
     */
    public function setNbrRepas($nbrRepas)
    {
        $this->nbrRepas = $nbrRepas;
    }

    /**
     * @return int
     */
    public function getEtatMangee()
    {
        return $this->etatMangee;
    }

    /**
     * @param int $etatMangee
     */
    public function setEtatMangee($etatMangee)
    {
        $this->etatMangee = $etatMangee;
    }

    /**
     * @return int
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param int $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return string
     */
    public function isRespectee()
    {
        return $this->respectee;
    }

    /**
     * @param string $respectee
     */
    public function setRespectee($respectee)
    {
        $this->respectee = $respectee;
    }







}

