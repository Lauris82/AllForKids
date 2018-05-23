<?php

namespace PIdev\AllforkidsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListeAtt
 *
 * @ORM\Table(name="liste_att")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\ListeAttRepository")
 */
class ListeAtt
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idListe;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEnfant", type="string", length=255)
     */
    private $nomEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaiss", type="date")
     */
    private $dateNaiss;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;


    /**
     * Get idListe
     *
     * @return int
     */


    /**
     * Set nomEnfant
     *
     * @param string $nomEnfant
     *
     * @return ListeAtt
     */
    public function setNomEnfant($nomEnfant)
    {
        $this->nomEnfant = $nomEnfant;

        return $this;
    }

    /**
     * Get nomEnfant
     *
     * @return string
     */
    public function getNomEnfant()
    {
        return $this->nomEnfant;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return ListeAtt
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }


    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     *@ORM\JoinColumn(name="enfant_user",referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\Garderie")
     *@ORM\JoinColumn(name="reservation_garderie",referencedColumnName="id_garderie",onDelete="CASCADE")
     */
    private $garderie;
    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ListeAtt
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getIdListe()
    {
        return $this->idListe;
    }




    /**
     * @return \DateTime
     */
    public function getDateNaiss()
    {
        return $this->dateNaiss;
    }

    /**
     * @param \DateTime $dateNaiss
     */
    public function setDateNaiss($dateNaiss)
    {
        $this->dateNaiss = $dateNaiss;
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
    public function getGarderie()
    {
        return $this->garderie;
    }

    /**
     * @param mixed $garderie
     */
    public function setGarderie($garderie)
    {
        $this->garderie = $garderie;
    }

}

