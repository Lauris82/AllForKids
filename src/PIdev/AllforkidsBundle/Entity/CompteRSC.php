<?php

namespace PIdev\AllforkidsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompteRSC
 *
 * @ORM\Table(name="compte_r_s_c")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\CompteRSCRepository")
 */
class CompteRSC
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRSC", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idRSC;

    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\Enfant")
     *@ORM\JoinColumn(name="enfantRSC",referencedColumnName="id_enfant")
     */
    private $enfant;

    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     * @ORM\JoinColumn(name="userRSC",referencedColumnName="id")
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
     * @ORM\Column(name="activite", type="string", length=255)
     */
    private $activite;


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
     * @var string
     * @ORM\Column(name="respectee",type="string")
     */
    private $respectee;

    /**
     * @var string
     * @ORM\Column(name="travailDevoir",type="string")
     */
    private $travailDevoir;


    /**
     * @var string
     *
     * @ORM\Column(name="RemarqueEcole", type="string", length=255)
     */
    private $RemarqueEcole;



    /**
     * Get idRSC
     *
     * @return int
     */
    public function getId()
    {
        return $this->idRSC;
    }

    /**
     * @return int
     */
    public function getIdRSC()
    {
        return $this->idRSC;
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

    /**
     * @return bool
     */
    public function isTravailDevoir()
    {
        return $this->travailDevoir;
    }

    /**
     * @param bool $travailDevoir
     */
    public function setTravailDevoir($travailDevoir)
    {
        $this->travailDevoir = $travailDevoir;
    }

    /**
     * @return string
     */
    public function getRemarqueEcole()
    {
        return $this->RemarqueEcole;
    }

    /**
     * @param string $RemarqueEcole
     */
    public function setRemarqueEcole($RemarqueEcole)
    {
        $this->RemarqueEcole = $RemarqueEcole;
    }




}

