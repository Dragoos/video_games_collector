<?php

namespace Vgc\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Vgc\MainBundle\Entity\Support;
use Vgc\MainBundle\Entity\Region;
use Vgc\MainBundle\Entity\SupportRegion;

class LoadSupportRegionData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $oContainer;

    public function setContainer(ContainerInterface $container = null) {
        $this->oContainer = $container;
    }

    public function getOrder() {
        return 2;
    }

    public function load(ObjectManager $oManager) {


        $oRegion = new Region();
        /* @var $oRegion Region */
        $oRegion->setNom('PAL FR');
        $this->addReference('PAL FR', $oRegion);
        $oManager->persist($oRegion);
        $oSupport = new Support();
        /* @var $oSupport Support */
        $oSupport->setNom('Nintendo GameCube');
        $this->addReference('Nintendo GameCube', $oSupport);
        $oManager->persist($oSupport);
        $oSupportRegion = new SupportRegion();
        $oSupportRegion->setRegion($oRegion);
        $oSupportRegion->setSupport($oSupport);
        $oSupportRegion->setFullset(449);
        $this->addReference('Nintendo GameCube PAL FR', $oSupportRegion);
        $oManager->persist($oSupportRegion);

        $oRegion2 = new Region();
        /* @var $oRegion2 Region */
        $oRegion2->setNom('PAL UK');
        $this->addReference('PAL UK', $oRegion2);
        $oManager->persist($oRegion2);
        $oSupport2 = new Support();
        /* @var $oSupport2 Support */
        $oSupport2->setNom('Nintendo WII');
        $this->addReference('Nintendo WII', $oSupport2);
        $oManager->persist($oSupport2);
        $oSupportRegion2 = new SupportRegion();
        $oSupportRegion2->setRegion($oRegion2);
        $oSupportRegion2->setSupport($oSupport2);
        $oSupportRegion2->setFullset(1089);
        $this->addReference('Nintendo WII PAL UK', $oSupportRegion2);
        $oManager->persist($oSupportRegion2);

        $oSupportRegion3 = new SupportRegion();
        $oSupportRegion3->setRegion($oRegion2);
        $oSupportRegion3->setSupport($oSupport);
        $oSupportRegion3->setFullset(642);
        $this->addReference('Nintendo GameCube PAL UK', $oSupportRegion3);
        $oManager->persist($oSupportRegion3);

        $oManager->flush();
    }

}
