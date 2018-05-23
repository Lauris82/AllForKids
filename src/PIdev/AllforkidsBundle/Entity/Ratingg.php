<?php

namespace PIdev\AllforkidsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ratingg
 *
 * @ORM\Table(name="ratingg")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\RatinggRepository")
 */
class Ratingg
{
    /**
     * @var int
     *
     * @ORM\Column(name="idR", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idR;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="string", length=255)
     */
    private $remarques;
    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     *@ORM\JoinColumn(name="rat_user",referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\Garderie")
     *@ORM\JoinColumn(name="rat_garderie",referencedColumnName="id_garderie",onDelete="CASCADE")
     */
    private $garderie;
    /**
     * @var int
     *
     * @ORM\Column(name="vote", type="integer")
     */
    private $vote;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->idR;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     *
     * @return Ratingg
     */
    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;

        return $this;
    }

    /**
     * Get remarques
     *
     * @return string
     */
    public function getRemarques()
    {
        return $this->remarques;
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
     * @return int
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * @param int $vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    }

}

