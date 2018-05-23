<?php

namespace PIdev\AllforkidsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Galery
 *
 * @ORM\Table(name="galery")
 * @ORM\Entity(repositoryClass="PIdev\AllforkidsBundle\Repository\GaleryRepository")
 */
class Galery
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
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=255)
     */
    private $theme;

    /**
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
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
        return null ===$this->nomImage?null:$this->getUploadDir.'/'.$this->nomImage;
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










    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\User")
     *@ORM\JoinColumn(name="gal_user",referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\Garderie")
     *@ORM\JoinColumn(name="gal_garderie",referencedColumnName="id_garderie",onDelete="CASCADE")
     */
    private $garderie;






    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

