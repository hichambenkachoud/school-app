<?php

namespace DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Entity\Manager;

class DashboardController extends Controller
{

    /**
     * @Route("/",name="dashboard_home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find($this->getUser()->getId());


        if ($this->isGranted('ROLE_SUPER_ADMIN') && $user instanceof Manager){
            return $this->render('DashboardBundle:Admin:dashboard.html.twig',
                array(
                    'user' => $user
                ));
        }elseif ($this->isGranted('ROLE_USER')){
            return $this->render('DashboardBundle:Student:dashboard.html.twig',
                array(
                    'user' => $user
                ));
        }
    }
}
