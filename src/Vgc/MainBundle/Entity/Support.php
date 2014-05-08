<?php

namespace Vgc\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vgc\MainBundle\Entity\SupportRegion;

/**
 * Support
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SupportRepository")
 */
class Support {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="SupportRegion", mappedBy="support", cascade={"persist"})
     */
    private $supportRegions;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Support
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Add supportRegions
     * @param SupportRegion $oSupportRegion
     * @return Support
     */
    public function addSupportRegion(SupportRegion $oSupportRegion) {
        $this->supportRegions[] = $oSupportRegion;
        return $this;
    }

    /**
     * Remove supportRegions
     * @param SupportRegion $supportRegions
     */
    public function removeSupportRegion(SupportRegion $supportRegions) {
        $this->supportRegions->removeElement($supportRegions);
    }

    /**
     * Get supportRegions
     * @return ArrayCollection
     */
    public function getSupportRegions() {
        return $this->supportRegions;
    }

    public function __construct() {
        $this->supportRegions = new ArrayCollection();
    }

}
