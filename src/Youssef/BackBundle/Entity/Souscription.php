<?php

namespace Youssef\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Souscription
 *
 * @ORM\Table(name="souscription")
 * @ORM\Entity(repositoryClass="Youssef\BackBundle\Repository\SouscriptionRepository")
 */
class Souscription
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_souscription", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    public function __construct()
    {
        $this->dateSouscription = new \Datetime();
        $this->idClient=5;

    }
    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer")
     */
    private $idClient;

    /**
     * @var int
     *
     * @ORM\Column(name="id_offre", type="integer")
     */
    private $idOffre;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_tranche", type="integer")
     */
    private $nombreTranche;

    /**
     * @var int
     *
     * @ORM\Column(name="conjoint", type="integer")
     */
    private $conjoint;
    /**
     * @var int
     *
     * @ORM\Column(name="nb_enfants", type="integer")
     */
    private $nbEnfant;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_souscription", type="date")
     */
    private $dateSouscription;


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
     * Set idClient
     *
     * @param integer $idClient
     *
     * @return Souscription
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Get idClient
     *
     * @return int
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * Set idOffre
     *
     * @param integer $idOffre
     *
     * @return Souscription
     */
    public function setIdOffre($idOffre)
    {
        $this->idOffre = $idOffre;

        return $this;
    }

    /**
     * Get idOffre
     *
     * @return int
     */
    public function getIdOffre()
    {
        return $this->idOffre;
    }

    /**
     * Set nombreTranche
     *
     * @param integer $nombreTranche
     *
     * @return Souscription
     */
    public function setNombreTranche($nombreTranche)
    {
        $this->nombreTranche = $nombreTranche;

        return $this;
    }

    /**
     * Get nombreTranche
     *
     * @return int
     */
    public function getNombreTranche()
    {
        return $this->nombreTranche;
    }

    /**
     * Set conjoint
     *
     * @param integer $conjoint
     *
     * @return Souscription
     */
    public function setConjoint($conjoint)
    {
        $this->conjoint = $conjoint;

        return $this;
    }

    /**
     * Get conjoint
     *
     * @return int
     */
    public function getConjoint()
    {
        return $this->conjoint;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return Souscription
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set dateSouscription
     *
     * @param \DateTime $dateSouscription
     *
     * @return Souscription
     */
    public function setDateSouscription($dateSouscription)
    {
        $this->dateSouscription = $dateSouscription;

        return $this;
    }

    /**
     * Get dateSouscription
     *
     * @return \DateTime
     */
    public function getDateSouscription()
    {
        return $this->dateSouscription;
    }

    /**
     * Set nbEnfant
     *
     * @param integer $nbEnfant
     *
     * @return Souscription
     */
    public function setNbEnfant($nbEnfant)
    {
        $this->nbEnfant = $nbEnfant;

        return $this;
    }

    /**
     * Get nbEnfant
     *
     * @return integer
     */
    public function getNbEnfant()
    {
        return $this->nbEnfant;
    }
}
