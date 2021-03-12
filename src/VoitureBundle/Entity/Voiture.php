<?php


namespace VoitureBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;

/**
 * ...
 * @ORM\HasLifecycleCallbacks()
 * ...
 */
/**
  * @ORM\Entity
  */

class Voiture
{
    /** @ORM\Id
     * @ORM\Column (type ="string" , length =255)
     */
    private $matricule ;
    /**
     * @ORM\Column (type ="string" , length =255)
     */
    private $marque ;
    /**
     * @ORM\Column (type ="string" , length =255)
     */
    private $couleur ;
    /**
     * @ORM\Column (type ="string" , length =255)
     */
    private $modele ;
    /**
     * @ORM\Column (type ="integer")
     */
    private $kilometrage ;
    /**
     * @ORM\Column (type ="float")
     */
    private $prix ;

    /**
     * @return mixed
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    /**
     * @param mixed $disponibilite
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
    }
    /**
     * @ORM\Column (name="dispoibilite", type ="boolean")
     */
    private $disponibilite ;

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->disponibilite = (bool) $this->disponibilite; //Force using boolean value of $this->dispo
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->disponibilite = (bool) $this->disponibilite;
    }

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
     * @ORM\OneToMany(targetEntity="VoitureBundle\Entity\Reservation", mappedBy="Voiture")
     */
    private $resa;



    /**
     * @return mixed
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * @param mixed $matricule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    /**
     * @return mixed
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @param mixed $marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    /**
     * @return mixed
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param mixed $couleur
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }

    /**
     * @return mixed
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * @param mixed $modele
     */
    public function setModele($modele)
    {
        $this->modele = $modele;
    }

    /**
     * @return mixed
     */
    public function getKilometrage()
    {
        return $this->kilometrage;
    }

    /**
     * @param mixed $kilometrage
     */
    public function setKilometrage($kilometrage)
    {
        $this->kilometrage = $kilometrage;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

}