<?php


namespace VoitureBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 */

class Reservation
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column (type ="integer")
     */
    private $ReservationId ;

    /**
     * @ORM\Column (type ="date")
     */
    private $DateReservation ;
    /**
     * @ORM\Column (type ="date")
     */
    private $DateRetour ;

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->Client;
    }

    /**
     * @param mixed $Client
     */
    public function setClient($Client)
    {
        $this->Client = $Client;
    }

    /**
     * @return mixed
     */
    public function getVoiture()
    {
        return $this->Voiture;
    }

    /**
     * @param mixed $Voiture
     */
    public function setVoiture($Voiture)
    {
        $this->Voiture = $Voiture;
    }

    /**
     * @ORM\ManyToOne(targetEntity="VoitureBundle\Entity\Client", inversedBy="resa")
     * @ORM\JoinColumn(name="Client" , referencedColumnName="client_id")
     */
    private $Client;

    /**
     * @ORM\ManyToOne(targetEntity="VoitureBundle\Entity\Voiture", inversedBy="resa")
     * @ORM\JoinColumn(name="Voiture" , referencedColumnName="matricule")
     */
    private $Voiture;

    /**
     * @return mixed
     */
    public function getFact()
    {
        return $this->fact;
    }

    /**
     * @param mixed $fact
     */
    public function setFact($fact)
    {
        $this->fact = $fact;
    }

    /**
     * @ORM\OneToOne(targetEntity="Facture", mappedBy="resa")
     */
    private $fact;



    /**
     * @return mixed
     */
    public function getReservationId()
    {
        return $this->ReservationId;
    }

    /**
     * @param mixed $ReservationId
     */
    public function setReservationId($ReservationId)
    {
        $this->ReservationId = $ReservationId;
    }

    /**
     * @return mixed
     */
    public function getDateReservation()
    {
        return $this->DateReservation;
    }

    /**
     * @param mixed $DateReservation
     */
    public function setDateReservation($DateReservation)
    {
        $this->DateReservation = $DateReservation;
    }

    /**
     * @return mixed
     */
    public function getDateRetour()
    {
        return $this->DateRetour;
    }

    /**
     * @param mixed $DateRetour
     */
    public function setDateRetour($DateRetour)
    {
        $this->DateRetour = $DateRetour;
    }





}