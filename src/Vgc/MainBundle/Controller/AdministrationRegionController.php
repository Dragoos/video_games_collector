<?php

namespace Vgc\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vgc\MainBundle\Entity\Region;
use Vgc\MainBundle\Entity\RegionRepository;
use Vgc\MainBundle\Form\Type\RegionType;

/**
 * @Route("/connected")
 */
class AdministrationRegionController extends Controller {

    /**
     * @var EntityManager
     */
    private $oManager;

    /**
     * @Route("/admin/ajout-region", name="AjoutRegion")
     * @Template
     */
    public function AjoutRegionAction(Request $oRequest) {

        $oRegionRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:Region');
        /* @var $oRegionRepository RegionRepository */
        $toRegion = $oRegionRepository->findAll();
        //ajout
        $oRegion = new Region();
        /* @var $oRegion Region */

        $titre = "Ajouter une région";

        $oForm = $this->createForm(new RegionType(), $oRegion);
        if ($oRequest->isMethod('POST')) {
            //Validation du formulaire
            $oForm->submit($oRequest);
            if ($oForm->isValid()) {
                $this->oManager = $this->getDoctrine()->getManager();
                $this->oManager->persist($oRegion);
                $this->oManager->flush();
                return $this->redirect($this->generateUrl("supportRegions"));
            }
        }

        // on arrive ici dans 2 cas : la requete est de type GET ou le formulaire contient des erreurs
        return ['oForm' => $oForm->createView(), 'titre' => $titre, 'toRegion' => $toRegion];
    }

}
