<?php

namespace PIdev\AllforkidsBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_post", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_post;

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
     * @var datetime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getNmbrsignal()
    {
        return $this->nmbrsignal;
    }

    /**
     * @param int $nmbrsignal
     */
    public function setNmbrsignal($nmbrsignal)
    {
        $this->nmbrsignal = $nmbrsignal;
    }
    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Ajouter une image jpg")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */

    private $image;



    /**
     * @var integer
     * @ORM\Column(name="nmbrsignal", type="integer")
     */
    private $nmbrsignal = 0;



    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     *@ORM\JoinColumn(name="post_user",referencedColumnName="id")
     */
    private $user;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="PIdev\AllforkidsBundle\Entity\Signaler", mappedBy="idPost", cascade={"persist","remove"})
     */
    private $Signalers;

    /**
     * @return int
     */
    public function getIdPost()
    {
        return $this->id_post;
    }

    /**
     * @param int $id_post
     */
    public function setIdPost($id_post)
    {
        $this->id_post = $id_post;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
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
     * Constructor
     */
    public function __construct()
    {
        $this->Signalers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add signaler
     *
     * @param \PIdev\AllforkidsBundle\Entity\Signaler $signaler
     *
     * @return Post
     */
    public function addSignaler(\PIdev\AllforkidsBundle\Entity\Signaler $signaler)
    {
        $this->Signalers[] = $signaler;

        return $this;
    }

    /**
     * Remove signaler
     *
     * @param \PIdev\AllforkidsBundle\Entity\Signaler $signaler
     */
    public function removeSignaler(\PIdev\AllforkidsBundle\Entity\Signaler $signaler)
    {
        $this->Signalers->removeElement($signaler);
    }

    /**
     * Get signalers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSignalers()
    {
        return $this->Signalers;
    }
}
