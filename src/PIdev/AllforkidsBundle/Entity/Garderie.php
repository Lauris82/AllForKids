<?php

namespace PIdev\AllforkidsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Garderie
 *
 * @ORM\Table(name="garderie")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\GarderieRepository")
 */
class Garderie implements \JsonSerializable
{
    function jsonSerialize()
    {
        return get_object_vars($this);
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id_garderie", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id_garderie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="emplacement", type="string", length=255)
     */
    private $emplacement;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

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
     * @var int
     *
     * @ORM\Column(name="capacite", type="integer")
     */
    private $capacite;

    /**
     * @var int
     *
     * @ORM\Column(name="num_tel", type="integer")
     */
    private $numTel;


    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     * @ORM\JoinColumn(name="user_garderie",referencedColumnName="id")
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
    public function getId_garderie()
    {
        return $this->id_garderie;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Garderie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set emplacement
     *
     * @param string $emplacement
     *
     * @return Garderie
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    /**
     * Get emplacement
     *
     * @return string
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * Set capacite
     *
     * @param integer $capacite
     *
     * @return Garderie
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get capacite
     *
     * @return int
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * Set numTel
     *
     * @param integer $numTel
     *
     * @return Garderie
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get numTel
     *
     * @return int
     */
    public function getNumTel()
    {
        return $this->numTel;
    }



    /**
     * @ORM\Column(name="nomImage", type="string", length=255)
     */
    private $nomImage;
    /**
     * @Assert\File(maxSize="500k")
     */
    public $file;

    /**
     * Get NomImage
     * @return String
     */
    public function getNomImage()
    {
        return $this->nomImage;
    }

    /**
     * Set NomImage
     * @param String $nomImage
     * @return Categorie
     */
    public function setNomImage($nomImage)
    {
        $this->nomImage = $nomImage;
    }


    public function getWebPath()
    {
        return null ===$this->nomImage?null:$this->getUploadDir().'/'.$this->nomImage;
    }
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    protected function getUploadDir()
    {
        return 'images';
    }
    public function uploadProfilPicture()
    {
        $this->file->move($this->getUploadRootDir(),$this->file->getClientOriginalName());
        $this->nomImage=$this->file->getClientOriginalName();
        $this->file=null;
    }



}
