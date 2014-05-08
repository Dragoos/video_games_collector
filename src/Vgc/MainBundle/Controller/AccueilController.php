<?php

namespace Vgc\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vgc\MainBundle\Entity\Utilisateur;

class AccueilController extends Controller {

    /**
     * @var Utilisateur
     */
    private $oUtilisateurConnecte;

    public function preExecute() {
        // $this->oUtilisateurConnecte = $this->get('security.context')->getToken()->getUser();
    }

    /**
     * @Route("/")
     * @Route("/accueil", name="accueil")
     * @Template
     */
    public function accueilAction() {
        $titre = "accueil";

        return ['titre' => $titre];
        //return new \Symfony\Component\HttpFoundation\Response($this->renderView('MainBundle:Accueil:accueilStagiaire.html.twig', ['toTests' => $toTests]));
    }

}
