<?php

namespace Vgc\MainBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vgc\MainBundle\Entity\CollectionRepository;
use Vgc\MainBundle\Entity\JeuRepository;
use Vgc\MainBundle\Entity\SupportRegion;
use Vgc\MainBundle\Entity\SupportRegionRepository;
use Vgc\MainBundle\Entity\Utilisateur;
use Vgc\MainBundle\Form\Type\SupportRegionType;

/**
 * @Route("/connected")
 */
class AdministrationSupportRegionsController extends Controller {

    /**
     * @var EntityManager
     */
    private $oManager;

    /**
     * @var Utilisateur
     */
    private $oUtilisateurConnecte;

    /**
     * @Route("/ma-collection", name="supportRegions")
     * @Template
     */
    public function listeSupportRegionsAction() {
        $oSupportRegionRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:SupportRegion');
        /* @var $oSupportRegionRepository SupportRegionRepository */
        $toSupportRegion = $oSupportRegionRepository->findBy(array(), array('support' => 'asc', 'region' => 'asc'));
        $this->oUtilisateurConnecte = $this->get('security.context')->getToken()->getUser();
        $collection = $this->oUtilisateurConnecte->getcollection();
        $toCollectionFullset = new ArrayCollection();
        $oJeuRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:Jeu');
        /* @var $oJeuRepository JeuRepository */
        $j = 0;
        foreach ($toSupportRegion as $oSupportRegion) {
            $toJeu = $oJeuRepository->findBy(['supportRegion' => $oSupportRegion, 'collection' => $collection]);
            $toCollectionFullset[$j] = count($toJeu);
            $j++;
        }
        return ['toSupportRegion' => $toSupportRegion, 'toCollectionFullset' => $toCollectionFullset];
    }

    /**
     * @Route("/ma-collection/{id}/{supportRegion}", name="supportRegionCollection", requirements={"id" = "-?\d+"})
     * @Template
     */
    public function listeSupportRegionsCollectionAction($id, $supportRegion) {
        /* @var $supportRegion SupportRegion */
        $oCollectionRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:Collection');
        /* @var $oCollectionRepository CollectionRepository */
        $collection = $oCollectionRepository->find($id);
        $oJeuRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:Jeu');
        /* @var $oJeuRepository JeuRepository */
        $oSupportRegionRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:SupportRegion');
        /* @var $oSupportRegionRepository SupportRegionRepository */
        $toSupportRegion = $oSupportRegionRepository->findBy(array(), array('support' => 'asc'));
        $oSupportRegion = null;
        foreach ($toSupportRegion as $oSupportRegions) {
            if ($supportRegion == $oSupportRegions) {
                $oSupportRegion = $oSupportRegions;
            }
        }
        $toJeu = $oJeuRepository->findBy(['supportRegion' => $oSupportRegion], array('nom' => 'asc'));
        return ['toJeu' => $toJeu, 'collection' => $collection];
    }

    /**
     * @Route("/admin/ajout-support-region", name="AjoutSupportRegion")
     * @Template
     */
    public function AjoutSupportRegionAction(Request $oRequest) {
        //ajout
        $oSupportRegion = new SupportRegion();
        /* @var $oSupportRegion SupportRegion */

        $titre = "Ajouter un support-Region";

        $oForm = $this->createForm(new SupportRegionType(), $oSupportRegion);
        if ($oRequest->isMethod('POST')) {
            //Validation du formulaire
            $oForm->submit($oRequest);
            if ($oForm->isValid()) {
                $this->oManager = $this->getDoctrine()->getManager();
                $this->oManager->persist($oSupportRegion);
                $this->oManager->flush();
                return $this->redirect($this->generateUrl("supportRegions"));
            }
        }

        // on arrive ici dans 2 cas : la requete est de type GET ou le formulaire contient des erreurs
        return ['oForm' => $oForm->createView(), 'titre' => $titre];
    }

}
