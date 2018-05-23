<?php

namespace PIdev\AllforkidsBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
/**
 * Aime
 * @ORM\Table(name="aime")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\AimeRepository")
 */

class Aime
{
    /**
     * @ORM\Column(name="id", type="integer")
     *  @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *@ORM\Column( type="integer")
     */
    private $nbLike;

    /**
     *@ORM\Column(name="idPost", type="integer")
     *@ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\Post",cascade={"persist","remove"})
     *@ORM\JoinColumn(name="idPost",referencedColumnName="id_post", onDelete="CASCADE")
     */
    private $idPost;

    /**
     *@ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     *@ORM\JoinColumn(name="idUser",referencedColumnName="id")
     */
    private $idUser;


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
     * Set nbLike
     *
     * @param integer $nbLike
     *
     * @return Aime
     */
    public function setNbLike($nbLike)
    {
        $this->nbLike = $nbLike;

        return $this;
    }

    /**
     * Get nbLike
     *
     * @return int
     */
    public function getNbLike()
    {
        return $this->nbLike;
    }

    /**
     * Set idPost
     *
     * @param integer $idPost
     *
     * @return Aime
     */
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * Get idPost
     *
     * @return int
     */
    public function getIdPost()
    {
        return $this->idPost;
    }


    public function __toString()
    {
        return (string) $this->getIdPost();
    }
}
