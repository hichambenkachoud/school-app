<?php

namespace StudyncoBundle\Controller;

use StudyncoBundle\Entity\Category;
use StudyncoBundle\Entity\Field;
use StudyncoBundle\Form\CategoryType;
use StudyncoBundle\Form\FieldType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CategoryController extends Controller
{
    /**
     * @Route("/category/create", name="create_category")
     */
    public function createAction(Request $request)
    {
        $category = new Category();

        /*$categpry->setTitle('Logement');
        $categpry->setDescription('Tous ce qui lier au logement en France');
        */
        /*$form = $this->createFormBuilder($category)
            ->add('title', TextType::class, array('label' => 'Title', 'required' => false))
            ->add('description', TextType::class, array('label' => 'Description', 'required' => false))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
            ->getForm();*/
        $form = $this->createForm(CategoryType::class,$category);

        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('show_category', array('id' => $category->getId()));
        }

        return $this->render('StudyncoBundle:Category:create.html.twig',
            array(
                'form' => $form->createView(),
                'create' => true
            ));
    }

    /**
     * @Route("/category/update/{id}", name="category_update")
     */
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('StudyncoBundle:Category')->find($id);
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()){
            $em->flush();

            return $this->redirectToRoute('list_category');
        }

        return $this->render('StudyncoBundle:Category:create.html.twig',
            array(
                'form' => $form->createView(),
                'update' => true
            ));
    }

    /**
     * @Route("/category/list",name="list_category")
     */
    public function listAction()
    {
        $categories = $this->getDoctrine()->getRepository('StudyncoBundle:Category')->getSortedByTitle();
        $fields = $this->getDoctrine()->getRepository('StudyncoBundle:Category')->getFieldOfCategory();
        return $this->render('StudyncoBundle:Category:list.html.twig',array(
            'categories' => $categories,
            'fields' => $fields
        ));
    }

    /**
     * @Route("/category/{id}", name="show_category")
     */
    public function showAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('StudyncoBundle:Category');
        $category = $repository->getCategoryById($id);

        if (!$category){
            throw $this->createNotFoundException();
        }


        return $this->render('StudyncoBundle:Category:show.html.twig',array(
            'category' => $category
        ));
    }

    /**
     * @Route("/category/delete/{id}", name="category_delete")
     */
    public function deleteAction(Category $category)
    {
        /*$em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();*/



        return $this->render('StudyncoBundle:Category:list.html.twig');
    }

    /**
     * @Route("field/create", name="field_create")
     */
    public function fieldAction(Request $request)
    {
        $field = new Field();

        $form = $this->createForm(FieldType::class,$field);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($field);
            $em->flush();

            return $this->redirectToRoute('field_list');
        }


        return $this->render('StudyncoBundle:Field:create.html.twig',
            array('form' => $form->createView() ));
    }

    /**
     * @return Response
     * @Route("/field/list", name="field_list")
     */
    public function fieldListAction(){

        $em = $this->getDoctrine()->getRepository('StudyncoBundle:Field');
        $fields = $em->findAll();

        return $this->render('StudyncoBundle:Field:list.html.twig',array(
            'fields' => $fields
        ));
    }

    /**
     * @param $id
     * @return Response
     * @Route("field/{id}", name="field_show")
     */
    public function fieldShowAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $field = $em->getRepository('StudyncoBundle:Field')->find($id);

        return $this->render('StudyncoBundle:Field:show.html.twig',
            array(
                'field' => $field
            ));

    }


    /**
     * @param $id
     * @return Response
     * @param Request $request
     * @Route("field/update/{id}", name="field_update")
     */

    public function fieldUpdateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('StudyncoBundle:Field');

        $field = $repository->find($id);

        $form = $this->createForm(FieldType::class, $field);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->flush();
            return $this->redirectToRoute('field_show',array(
                'id' => $id
            ));
        }

        return $this->render('StudyncoBundle:Field:create.html.twig', array(
            'form' => $form->createView()
        ));
    }



}
