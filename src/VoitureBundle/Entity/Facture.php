<?php


namespace VoitureBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 */

class Facture
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column (type ="integer")
     */
    private $IdFacture ;
    /**
     * @ORM\Column (type ="float")
     */
    private $MontantFacture ;
    /**
     * @ORM\Column (type ="date")
     */
    private $DateFacture ;

    /**
     * @ORM\OneToOne(targetEntity="Reservation", inversedBy="fact")
     * * @ORM\JoinColumn(name="resa", referencedColumnName="reservation_id")
     **/
    private $resa;

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
    public function getIdFacture()
    {
        return $this->IdFacture;
    }

    /**
     * @param mixed $IdFacture
     */
    public function setIdFacture($IdFacture)
    {
        $this->IdFacture = $IdFacture;
    }

    /**
     * @return mixed
     */
    public function getMontantFacture()
    {
        return $this->MontantFacture;
    }

    /**
     * @param mixed $MontantFacture
     */
    public function setMontantFacture($MontantFacture)
    {
        $this->MontantFacture = $MontantFacture;
    }

    /**
     * @return mixed
     */
    public function getDateFacture()
    {
        return $this->DateFacture;
    }

    /**
     * @param mixed $DateFacture
     */
    public function setDateFacture($DateFacture)
    {
        $this->DateFacture = $DateFacture;
    }




}