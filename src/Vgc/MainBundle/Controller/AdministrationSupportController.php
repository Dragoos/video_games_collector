<?php

namespace Vgc\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vgc\MainBundle\Entity\Support;
use Vgc\MainBundle\Entity\SupportRepository;
use Vgc\MainBundle\Entity\Utilisateur;
use Vgc\MainBundle\Form\Type\SupportType;

/**
 * @Route("/connected")
 */
class AdministrationSupportController extends Controller {

    /**
     * @var EntityManager
     */
    private $oManager;

    /**
     * @var Utilisateur
     */
    private $oUtilisateurConnecte;

    /**
     * @Route("/admin/ajout-support", name="AjoutSupport")
     * @Template
     */
    public function AjoutSupportAction(Request $oRequest) {

        $oSupportRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:Support');
        /* @var $oSupportRepository SupportRepository */
        $toSupport = $oSupportRepository->findAll();
        //ajout
        $oSupport = new Support();
        /* @var $oSupport Support */

        $titre = "Ajouter un support";

        $oForm = $this->createForm(new SupportType(), $oSupport);
        if ($oRequest->isMethod('POST')) {
            //Validation du formulaire
            $oForm->submit($oRequest);
            if ($oForm->isValid()) {
                $this->oManager = $this->getDoctrine()->getManager();
                $this->oManager->persist($oSupport);
                $this->oManager->flush();
                return $this->redirect($this->generateUrl("supportRegions"));
            }
        }

        // on arrive ici dans 2 cas : la requete est de type GET ou le formulaire contient des erreurs
        return ['oForm' => $oForm->createView(), 'titre' => $titre, 'toSupport' => $toSupport];
    }

}
