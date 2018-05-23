<?php

namespace PIdev\AllforkidsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\ReclamationRepository")
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRec", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idRec;

    /**
     * @var string
     *
     * @ORM\Column(name="objetRec", type="string", length=255)
     */
    private $objetRec;

    /**
     * @var string
     *
     * @ORM\Column(name="typeRec", type="string", length=255)
     */
    private $typeRec;

    /**
     * @var int
     *
     * @ORM\Column(name="etatRec", type="integer")
     */
    private $etatRec;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuRec", type="string", length=255)
     */
    private $contenuRec;


    /**
     * @var int
     *
     * @ORM\Column(name="user", type="integer")
     */
    private $user;



    /**
     * @var string
     *
     * @ORM\Column(name="membreRec", type="string", length=255)
     */
    private $membreRec;


    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;



    /**
     * Get idRec
     *
     * @return int
     */
    public function getIdRec()
    {
        return $this->idRec;
    }

    /**
     * Set objetRec
     *
     * @param string $objetRec
     *
     * @return Reclamation
     */
    public function setObjetRec($objetRec)
    {
        $this->objetRec = $objetRec;

        return $this;
    }

    /**
     * Get objetRec
     *
     * @return string
     */
    public function getObjetRec()
    {
        return $this->objetRec;
    }

    /**
     * Set typeRec
     *
     * @param string $typeRec
     *
     * @return Reclamation
     */
    public function setTypeRec($typeRec)
    {
        $this->typeRec = $typeRec;

        return $this;
    }

    /**
     * Get typeRec
     *
     * @return string
     */
    public function getTypeRec()
    {
        return $this->typeRec;
    }

    /**
     * Set etatRec
     *
     * @param integer $etatRec
     *
     * @return Reclamation
     */
    public function setEtatRec($etatRec)
    {
        $this->etatRec = $etatRec;

        return $this;
    }

    /**
     * Get etatRec
     *
     * @return int
     */
    public function getEtatRec()
    {
        return $this->etatRec;
    }

    /**
     * Set contenuRec
     *
     * @param string $contenuRec
     *
     * @return Reclamation
     */
    public function setContenuRec($contenuRec)
    {
        $this->contenuRec = $contenuRec;

        return $this;
    }

    /**
     * Get contenuRec
     *
     * @return string
     */
    public function getContenuRec()
    {
        return $this->contenuRec;
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
     * @return string
     */
    public function getMembreRec()
    {
        return $this->membreRec;
    }

    /**
     * @param string $membreRec
     */
    public function setMembreRec($membreRec)
    {
        $this->membreRec = $membreRec;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }


}

