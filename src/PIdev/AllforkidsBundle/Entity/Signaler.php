<?php
/**
 * Created by PhpStorm.
 * User: amine
 * Date: 26/02/2018
 * Time: 13:19
 */

namespace PIdev\AllforkidsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="signaler")
 * @ORM\Entity()
 */
class Signaler
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *@ORM\Column( type="integer")
     */
    private $nbsignal;

    /**
     *@ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\Post")
     *@ORM\JoinColumn(name="idPost",referencedColumnName="id_post", nullable=true, onDelete="SET NULL")
     */
    private $idPost;

    /**
     *@ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     */
    private $idUser;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNbsignal()
    {
        return $this->nbsignal;
    }

    /**
     * @param mixed $nbsignal
     */
    public function setNbsignal($nbsignal)
    {
        $this->nbsignal = $nbsignal;
    }

    /**
     * @return mixed
     */
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * @param mixed $idPost
     */
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;
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

}
