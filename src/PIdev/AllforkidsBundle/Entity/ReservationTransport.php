<?php

namespace PIdev\AllforkidsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationTransport
 *
 * @ORM\Table(name="reservation_transport")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\ReservationTransportRepository")
 */
class ReservationTransport
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreEnfants", type="integer")
     */
    private $nombreEnfants;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reservation", type="date")
     */
    private $dateReservation;

    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     *@ORM\JoinColumn(name="user",referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\OffreTransport")
     *@ORM\JoinColumn(name="offreTransport",referencedColumnName="id")
     */
    private $offreTransport;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreEnfants
     *
     * @param integer $nombreEnfants
     *
     * @return ReservationTransport
     */
    public function setNombreEnfants($nombreEnfants)
    {
        $this->nombreEnfants = $nombreEnfants;

        return $this;
    }

    /**
     * Get nombreEnfants
     *
     * @return int
     */
    public function getNombreEnfants()
    {
        return $this->nombreEnfants;
    }

    /**
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * @param \DateTime $dateReservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;
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
    public function getOffreTransport()
    {
        return $this->offreTransport;
    }

    /**
     * @param mixed $offreTransport
     */
    public function setOffreTransport($offreTransport)
    {
        $this->offreTransport = $offreTransport;
    }

}

