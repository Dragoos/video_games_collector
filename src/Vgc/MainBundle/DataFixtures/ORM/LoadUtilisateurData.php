<?php

namespace Vgc\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vgc\MainBundle\Entity\Utilisateur;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUtilisateurData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $oContainer;

    public function setContainer(ContainerInterface $container = null) {
        $this->oContainer = $container;
    }

    public function getOrder() {
        return 1;
    }

    public function load(ObjectManager $oManager) {
        $oUserManager = $this->oContainer->get('fos_user.user_manager');
        /* @var $oUserManager UserManager */

        /**
         * ADMIN
         */
        $oUtilisateur = $oUserManager->createUser();
        /* @var $oUtilisateur Utilisateur */
        $oUtilisateur->setUsername('admin')
                ->setEmail('admin@mail.fr')
                ->setPlainPassword('admin')
                ->addRole('ROLE_ADMIN')
                ->setEnabled(true);
        $oUserManager->updateUser($oUtilisateur);
        $this->addReference('administrateur', $oUtilisateur);
    }

}
