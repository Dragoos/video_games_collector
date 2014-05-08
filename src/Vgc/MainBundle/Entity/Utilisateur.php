<?php

namespace Vgc\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User;
use Vgc\MainBundle\Entity\Collection;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="UtilisateurRepository")
 */
class Utilisateur extends User {

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Collection", cascade={"persist"})
     */
    private $collection;

    /**
     * Constructor
     */
    public function __construct() {
        $this->collection = new Collection();
        parent::__construct();
    }

    /**
     * Get id
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Verifie si l'utilisateur est un membre
     * @return boolean
     */
    public function estMembre() {
        return in_array('ROLE_MEMBRE', $this->getRoles());
    }

    /**
     * Verifie si l'utilisateur est un administrateur
     * @return boolean
     */
    public function estAdministrateur() {
        return in_array('ROLE_ADMIN', $this->getRoles());
    }

    /**
     * Add collection
     * @param Collection $collection
     * @return Utilisateur
     */
    public function addCollection(Collection $collection) {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Remove collection
     * @param Collection $collection
     */
    public function removeCollection(Collection $collection) {
        $this->collection->removeElement($collection);
    }

    /**
     * Get collection
     * @return Collection
     */
    public function getcollection() {
        return $this->collection;
    }

    public function getStatus() {
        if ($this->estAdministrateur()) {
            return 'Administrateur';
        } else if ($this->estMembre()) {
            return 'Membre';
        } else {
            return '';
        }
    }

}
