<?php


namespace VoitureBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 */

class Client

{
    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getMDP()
    {
        return $this->MDP;
    }

    /**
     * @param mixed $MDP
     */
    public function setMDP($MDP)
    {
        $this->MDP = $MDP;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }



    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column (type ="integer")
     */
    private $ClientId ;
    /**
     * @ORM\Column (type ="string" , length =255)
     */
    private $nom ;
    /**
     * @ORM\Column (type ="string" , length =255)
     */
    private $prenom ;
    /**
     * @ORM\Column (type ="string" , length =255)
     */
    private $MDP ;
    /**
     * @ORM\Column (type ="string" , length =255)
     */
    private $mail ;
    /**
     * @ORM\Column (type ="string" , length =255)
     */
    private $adresse;


    /**
     * @ORM\OneToMany(targetEntity="VoitureBundle\Entity\Reservation", mappedBy="Client")
     */
    private  $resa;


    /**
     * @return mixed
     */
    public function getResa()
    {
        return $this->resa;
    }

    /**
     * @param mixed $resa
     */
    public function setResa($resa)
    {
        $this->resa = $resa;
    }




    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->ClientId;
    }

    /**
     * @param mixed $ClientId
     */
    public function setClientId($ClientId)
    {
        $this->ClientId = $ClientId;
    }

}