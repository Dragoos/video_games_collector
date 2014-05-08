<?php

namespace Vgc\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Support_Region
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vgc\MainBundle\Entity\SupportRegionRepository")
 */
class SupportRegion {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Support", cascade={"all"}, inversedBy="supportRegions")
     * @ORM\JoinColumn(name="support_id", referencedColumnName="id", nullable=false)
     */
    private $support;

    /**
     * @ORM\ManyToOne(targetEntity="Region", cascade={"all"}, inversedBy="supportRegions")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id", nullable=false)
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity="Jeu", mappedBy="regionRegion", cascade={"persist"})
     */
    private $jeux;

    /**
     * @ORM\Column(name="fullset", type="integer")
     */
    private $fullset;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fullset
     * @param integer $fullset
     * @return Support_Region
     */
    public function setFullset($fullset) {
        $this->fullset = $fullset;
        return $this;
    }

    /**
     * Get fullset
     * @return integer
     */
    public function getFullset() {
        return $this->fullset;
    }

    /**
     * Set support
     * @param Support $support
     * @return Support_Region
     */
    public function setSupport(Support $support) {
        $this->support = $support;
        return $this;
    }

    /**
     * Get support
     * @return Support
     */
    public function getSupport() {
        return $this->support;
    }

    /**
     * Set region
     * @param Region $region
     * @return Support_Region
     */
    public function setRegion(Region $region) {
        $this->region = $region;
        return $this;
    }

    /**
     * Get region
     * @return Region
     */
    public function getRegion() {
        return $this->region;
    }

    public function __toString() {
        return $this->support->getNom() . ' ' . $this->region->getNom();
    }

}
