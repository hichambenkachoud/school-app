<?php

namespace StudyncoBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use StudyncoBundle\Entity\Word;
use StudyncoBundle\Form\CategoryType;
use StudyncoBundle\Form\WordType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Delete;

class WordController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/words", name="list_word")
     *
     */
    public function listWordAction()
    {
        $words = $this->getDoctrine()->getRepository('StudyncoBundle:Word')->findAll();

        return $this->render('StudyncoBundle:Word:list.html.twig',
            array(
                'words' => $words
            ));

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/words/add", name="add_word")
     */
    public function addWordAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $word = new Word();

        $form = $this->createForm(WordType::class,$word);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            if ($word->getParent()){
                $parent = $em->getRepository('StudyncoBundle:Word')->find($word->getParent());
                $word->setDefinition($parent->getDefinition());
            }
            $em->persist($word);
            $em->flush();


            return $this->redirectToRoute('show_word', array('id'=> $word->getId()));
        }

        return $this->render('StudyncoBundle:Word:add.html.twig',array(
            'form' => $form->createView(),
            'action' => 'add'
        ));

    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("words/{id}", name="show_word")
     */
    public function showWordAction($id)
    {
        $word = $this->getDoctrine()->getRepository('StudyncoBundle:Word')->find($id);

        if (!$word){
            return new Response(Response::HTTP_NOT_FOUND);
        }

        return $this->render('StudyncoBundle:Word:show.html.twig', array('word' => $word));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Route("/words/update/{id}", name="update_word")
     */
    public function updateWordAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $word = $em->getRepository('StudyncoBundle:Word')->find($id);

        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();

            return $this->redirectToRoute('show_word', array('id' => $id));
        }

        return $this->render('StudyncoBundle:Word:add.html.twig', array(
            'form' => $form->createView(),
            'action' => 'update'
        ));
    }





}