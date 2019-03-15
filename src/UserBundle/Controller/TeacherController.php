<?php
/**
 * Created by PhpStorm.
 * User: hicham benkachoud
 * Date: 27/02/2019
 * Time: 15:16
 */

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use UserBundle\Entity\Teacher;
use UserBundle\Form\TeacherType;

class TeacherController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/teachers", name="list_teacher")
     */
    public function getAllTeachersAction()
    {
        $teachers = $this->getDoctrine()->getRepository('UserBundle:Teacher')->findAll();

        return $this->render('UserBundle:Teacher:list.html.twig',
            array(
                'teachers' => $teachers
            )
        );
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/teacher/{id}", name="show_teacher", requirements={"id"="\d+"})
     */
    public function showTeacherAction($id)
    {
        $teacher = $this->getDoctrine()->getRepository('UserBundle:Teacher')->find($id);

        return $this->render('UserBundle:Teacher:show.html.twig',
            array(
                'teacher' => $teacher
            )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/teacher/add", name="add_teacher")
     */
    public function addTeacherAction(Request $request)
    {
        $teacher = new Teacher();
        $form = $this->createForm(TeacherType::class, $teacher);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $teacher->setPlainPassword('welcome1234');
            $teacher->setEnabled(1);
            $teacher->getImage()->upload();
            $cv = $teacher->getCv();
            $cvName = md5(uniqid()).'.'.$cv->guessExtension();
            $cv->move($teacher->getUploadRootDir(),$cvName);
            $teacher->setCv($cvName);
            $em->persist($teacher);
            $em->flush();

            return $this->redirectToRoute('list_teacher');
        }

        return $this->render('UserBundle:Teacher:addEdit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/teacher/edit/{id}", name="update_teacher", requirements={"id"="\d+"})
     */
    public function updateTeacherAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $teacher = $em->getRepository('UserBundle:Teacher')->find($id);
        $cvName = $teacher->getCv();
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $teacher->getImage()->upload();
            $cv = $teacher->getCv();
            if ($cv){
                $teacher->DeleteFile($cvName);
                $cvName = md5(uniqid()).'.'.$cv->guessExtension();
                $cv->move($teacher->getUploadRootDir(),$cvName);
            }
            $teacher->setCv($cvName);
            $em->flush();

            return $this->redirectToRoute('show_teacher', array('id' => $id));
        }

        return $this->render('UserBundle:Teacher:addEdit.html.twig',
            array(
                'form' => $form->createView(),
                'teacher' => $teacher
            )
        );
    }
}