<?php

namespace PIdev\AllforkidsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExperiencePersonnel
 *
 * @ORM\Table(name="experience_personnel")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\ExperiencePersonnelRepository")
 */
class ExperiencePersonnel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ep", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_ep;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;
    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     *@ORM\JoinColumn(name="exp_user",referencedColumnName="id")
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id_ep;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return ExperiencePersonnel
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return ExperiencePersonnel
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Get idEp
     *
     * @return integer
     */
    public function getIdEp()
    {
        return $this->id_ep;
    }
}
