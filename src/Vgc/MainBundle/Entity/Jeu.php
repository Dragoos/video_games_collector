<?php

namespace Vgc\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Acl\Exception\Exception;
use Vgc\MainBundle\Entity\SupportRegion;

/**
 * Jeu
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="JeuRepository")
 */
class Jeu {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="SupportRegion", cascade={"all"}, inversedBy="jeux")
     * @ORM\JoinColumn(name="supportRegion_id", referencedColumnName="id", nullable=true)
     */
    private $supportRegion;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="Collection", cascade={"all"}, inversedBy="jeux")
     * @ORM\JoinColumn(name="collection_id", referencedColumnName="id", nullable=true)
     */
    private $collection;

    /**
     * @var float
     *
     * @ORM\Column(name="prixAchat", type="decimal", precision=2, scale=1)
     */
    private $prixAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="devise", type="string", length=255)
     */
    private $devise;

    /**
     * @var string
     *
     * @ORM\Column(name="codeBarre", type="string", length=255)
     */
    private $codeBarre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="boite", type="boolean")
     */
    private $boite;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notice", type="boolean")
     */
    private $notice;

    /**
     * @var boolean
     *
     * @ORM\Column(name="jeu", type="boolean")
     */
    private $jeu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pointVIP", type="boolean")
     */
    private $pointVIP;
    private $image;

    /**
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Jeu
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return Jeu
     */
    public function setAlt($alt) {
        $this->alt = $alt;
        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt() {
        return $this->alt;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Jeu
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
     * Set prixAchat
     *
     * @param float $prixAchat
     * @return Jeu
     */
    public function setPrixAchat($prixAchat) {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    /**
     * Get prixAchat
     *
     * @return float
     */
    public function getPrixAchat() {
        return $this->prixAchat;
    }

    /**
     * Set devise
     *
     * @param string $devise
     * @return Jeu
     */
    public function setDevise($devise) {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return string
     */
    public function getDevise() {
        return $this->devise;
    }

    /**
     * Set codeBarre
     *
     * @param string $codeBarre
     * @return Jeu
     */
    public function setCodeBarre($codeBarre) {
        $this->codeBarre = $codeBarre;

        return $this;
    }

    /**
     * Get codeBarre
     *
     * @return string
     */
    public function getCodeBarre() {
        return $this->codeBarre;
    }

    /**
     * Set boite
     *
     * @param boolean $boite
     * @return Jeu
     */
    public function setBoite($boite) {
        $this->boite = $boite;

        return $this;
    }

    /**
     * Get boite
     *
     * @return boolean
     */
    public function getBoite() {
        return $this->boite;
    }

    /**
     * Set notice
     *
     * @param boolean $notice
     * @return Jeu
     */
    public function setNotice($notice) {
        $this->notice = $notice;

        return $this;
    }

    /**
     * Get notice
     *
     * @return boolean
     */
    public function getNotice() {
        return $this->notice;
    }

    /**
     * Set jeu
     *
     * @param boolean $jeu
     * @return Jeu
     */
    public function setJeu($jeu) {
        $this->jeu = $jeu;

        return $this;
    }

    /**
     * Get jeu
     *
     * @return boolean
     */
    public function getJeu() {
        return $this->jeu;
    }

    /**
     * Set pointVIP
     *
     * @param boolean $pointVIP
     * @return Jeu
     */
    public function setPointVIP($pointVIP) {
        $this->pointVIP = $pointVIP;

        return $this;
    }

    /**
     * Get pointVIP
     *
     * @return boolean
     */
    public function getPointVIP() {
        return $this->pointVIP;
    }

    /**
     * Set collection
     * @return Jeu
     */
    public function setCollection(Collection $maColletion) {
        $this->collection = $maColletion;
    }

    /**
     * Get collection
     * @return Collection
     */
    public function getCollection() {
        return $this->collection;
    }

    /**
     * Set supportRegion
     * @return Jeu
     */
    public function setSupportRegion(SupportRegion $supportRegion) {
        $this->supportRegion = $supportRegion;
    }

    /**
     * Get supportRegion
     * @return SupportRegion
     */
    public function getSupportRegion() {
        return $this->supportRegion;
    }

    // On ajoute cet attribut pour y stocker le nom du fichier temporairement
    private $tempFilename;

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    // On modifie le setter de File, pour prendre en compte l'upload d'un fichier lorsqu'il en existe déjà un autre
    public function setImage(UploadedFile $file) {
        $this->image = $file;

        // On vérifie si on avait déjà un fichier pour cette entité
        if (null !== $this->url) {
            // On sauvegarde l'extension du fichier pour le supprimer plus tard
            $this->tempFilename = $this->url;

            // On réinitialise les valeurs des attributs url et alt
            $this->url = null;
            $this->alt = null;
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        // Si jamais il n'y a pas de fichier (champ facultatif)
        if (null === $this->image) {
            return;
        }

        // Le nom du fichier est son id, on doit juste stocker également son extension
        // Pour faire propre, on devrait renommer cet attribut en « extension », plutôt que « url »
        $this->url = $this->image->guessExtension();

        // Et on génère l'attribut alt de la balise <img>, à la valeur du nom du fichier sur le PC de l'internaute
        $this->alt = $this->image->getClientOriginalName();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        // Si jamais il n'y a pas de fichier (champ facultatif)
        if (null === $this->image) {
            return;
        }

        // Si on avait un ancien fichier, on le supprime
        if (null !== $this->tempFilename) {
            $oldFile = $this->getUploadRootDir() . '/' . $this->id . '.' . $this->tempFilename;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        // On déplace le fichier envoyé dans le répertoire de notre choix
        $this->image->move(
                $this->getUploadRootDir(), // Le répertoire de destination
                $this->id . '.' . $this->url   // Le nom du fichier à créer, ici « id.extension »
        );
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload() {
        // On sauvegarde temporairement le nom du fichier, car il dépend de l'id
        $this->tempFilename = $this->getUploadRootDir() . '/' . $this->id . '.' . $this->url;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
        if (file_exists($this->tempFilename)) {
            // On supprime le fichier
            unlink($this->tempFilename);
        }
    }

    public function getUploadDir() {
        // On retourne le chemin relatif vers l'image pour un navigateur
        return 'uploads/img';
    }

    protected function getUploadRootDir() {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

}
