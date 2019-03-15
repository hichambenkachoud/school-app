<?php
/**
 * Created by PhpStorm.
 * User: hicham benkachoud
 * Date: 05/03/2019
 * Time: 14:56
 */

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use UserBundle\Entity\Manager;
use UserBundle\Form\ManagerType;

class ManagerController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/managers", name="list_manager")
     */
    public function getAllManagerAction()
    {
        $managers = $this->getDoctrine()->getRepository('UserBundle:Manager')->findAll();

        return $this->render('UserBundle:Manager:list.html.twig',
            array(
                'managers' => $managers
            ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/manager/add", name="add_manager")
     */
    public function addManagerAction(Request $request)
    {
        $manager = new Manager();
        $form = $this->createForm(ManagerType::class,$manager);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $manager->setPlainPassword('welcome1234');
            $manager->setEnabled(1);
            $manager->getImage()->upload();
            $em->persist($manager);
            $em->flush();

            return $this->redirectToRoute('list_manager');
        }

        return $this->render('UserBundle:Manager:addEdit.html.twig',
            array(
                'form' => $form->createView()
            ));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/manager/edit/{id}", name="update_manager", requirements={"id"="\d+"})
     */
    public function updateManagerAction(Request $request, $id)
    {
       $em = $this->getDoctrine()->getManager();
       $manager = $em->getRepository('UserBundle:Manager')->find($id);
       $form = $this->createForm(ManagerType::class, $manager);

       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()){
            $manager->getImage()->upload();
            $em->flush();


            return $this->redirectToRoute('show_manager', array('id' => $id));
       }

       return $this->render('UserBundle:Manager:addEdit.html.twig',
           array(
               'form' => $form->createView()
           ));

    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/manager/{id}", name="show_manager", requirements={"id"="\d+"})
     */
    public function showManageAction($id)
    {
        $manager = $this->getDoctrine()->getRepository('UserBundle:Manager')->find($id);

        return $this->render('UserBundle:Manager:show.html.twig',
            array(
                'manager' => $manager
            ));
    }
}