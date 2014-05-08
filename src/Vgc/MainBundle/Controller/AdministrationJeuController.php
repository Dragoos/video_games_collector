<?php

namespace Vgc\MainBundle\Controller;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vgc\MainBundle\Entity\Jeu;
use Vgc\MainBundle\Entity\JeuRepository;
use Vgc\MainBundle\Entity\Utilisateur;
use Vgc\MainBundle\Form\Type\JeuType;

/**
 * @Route("/connected")
 */
class AdministrationJeuController extends Controller {

    /**
     * @var EntityManager
     */
    private $oManager;

    /**
     * @var Utilisateur
     */
    private $oUtilisateurConnecte;

    /**
     * @Route("/ma-collection/jeu/{id}", name="ficheJeu", requirements={"id" = "-?\d+"})
     * @Template
     */
    public function FicheJeuAction($id) {
        $oJeuRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:Jeu');
        /* @var $oJeuRepository JeuRepository */
        $oJeu = $oJeuRepository->find($id);
        return ['oJeu' => $oJeu];
    }

    /**
     * @Route("/ajout-jeu", name="AjoutJeu")
     * @Template
     */
    public function AjoutJeuAction(Request $oRequest) {
        //ajout
        $oJeu = new Jeu();
        /* @var $oJeu Jeu */

        $titre = "Ajouter un jeu";

        $oForm = $this->createForm(new JeuType(), $oJeu);
        if ($oRequest->isMethod('POST')) {
            //Validation du formulaire
            $oForm->submit($oRequest);
            if ($oForm->isValid()) {
                $this->oUtilisateurConnecte = $this->get('security.context')->getToken()->getUser();
                /* @var $this->oUtilisateurConnecte Utilisateur */
                $oJeu->setCollection($this->oUtilisateurConnecte->getcollection());
                $this->oManager = $this->getDoctrine()->getManager();
                $oJeu->preUpload();
                $oJeu->upload();
                $this->oManager->persist($oJeu);
                $this->oManager->flush();
                return $this->redirect($this->generateUrl("accueil"));
            }
        }

        // on arrive ici dans 2 cas : la requete est de type GET ou le formulaire contient des erreurs
        return ['oForm' => $oForm->createView(), 'titre' => $titre];
    }

}
