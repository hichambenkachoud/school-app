<?php
/**
 * Created by PhpStorm.
 * User: hicham benkachoud
 * Date: 26/02/2019
 * Time: 09:28
 */

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Student;
use UserBundle\Form\StudentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class StudentController extends Controller
{


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/students", name="list_student")
     */
    public function getAllStudentAction(){

        $students = $this->getDoctrine()->getRepository('UserBundle:Student')->findAll();

        return $this->render('UserBundle:Student:list.html.twig',
            array(
                'students' => $students
            ));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/student/add",name="add_student")
     */
    public function addStudentAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
       // var_dump($student);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $student->setDateCreation(new \DateTime());
            $student->setPlainPassword('welcome1234');
            $student->setEnabled(1);
            $student->getImage()->upload();
            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('list_student');
        }

        return $this->render('UserBundle:Student:add.html.twig',
            array(
                'form' => $form->createView(),
                'action' => 'add'
            ));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/student/edit/{id}", name="update_student", requirements={"id"="\d+"})
     */
    public function updateStudentAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('UserBundle:Student')->find($id);
        $form = $this->createForm(StudentType::class,$student);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $student->getImage()->upload();
            $em->flush();

            return $this->redirectToRoute('show_student',array('id' => $id));
        }

        return $this->render('UserBundle:Student:add.html.twig',
            array(
                'form' => $form->createView(),
                'action' => 'update'
            ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/student/{id}", name="show_student",requirements={"id"="\d+"})
     */
    public function getStudentAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('UserBundle:Student')->find($id);

        return $this->render('UserBundle:Student:show.html.twig',array(
            'student' => $student
        ));
    }


}