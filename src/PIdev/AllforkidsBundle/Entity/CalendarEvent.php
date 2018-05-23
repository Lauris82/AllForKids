<?php

namespace PIdev\AllforkidsBundle\Entity;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use Doctrine\ORM\Mapping as ORM ; //doctrine : ORM
/**
 * @ORM\Entity
 */
class CalendarEvent extends FullCalendarEvent
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string",length=255)
     */

    protected $startDate;
    /**
     * @ORM\Column(type="string",length=255)
     */
    protected $title;
    /**
     * @ORM\Column(type="string",length=255)
     */
    protected $endDate;
    /**
     * @ORM\ManyToOne(targetEntity="PIdev\AllforkidsBundle\Entity\Evenement")
     *@ORM\JoinColumn(name="evenement_user",referencedColumnName="id_evenement")
     */
    private $evenement;

    /**
     * @return mixed
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * @param mixed $evenement
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate( $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate( $endDate)
    {
        $this->endDate = $endDate;
    }



























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
     * @return array
     */
    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}