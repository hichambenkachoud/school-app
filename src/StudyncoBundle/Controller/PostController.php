<?php

namespace StudyncoBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\FOSRestBundle;
use StudyncoBundle\Service\Validate;
use \Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use StudyncoBundle\Repository\FieldRepository;

class PostController extends FOSRestController
{
    /**
     * @Rest\Get("/posts")
     */
    public function getAction()
    {
        $restresult = $this->getDoctrine()->getRepository('StudyncoBundle:Post')->findAll();
        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }

        //$d = $this->get('jms_serializer')->serialize($restresult,'json');
        return $restresult;
    }


    /**
     * @Rest\Get("/post/{id}")
     */
    public function getOneAction($id)
    {
        $singleresult = $this->getDoctrine()->getRepository('StudyncoBundle:Post')->find($id);
        if ($singleresult === null) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/post")
     */
    public function addPost(Request $request)
    {
        $data = $request->getContent();

        $post=$this->get('jms_serializer')->deserialize($data,'StudyncoBundle\Entity\Post','json');

        $em=$this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new View("User Added Successfully", Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param $id
     * @return View
     *
     * @Rest\Put("post/{id}")
     */
    public function updatePost(Request $request, $id)
    {
        $post=$this->getDoctrine()->getRepository('StudyncoBundle:Post')->find($id);

        $body = $request->getContent();
        $data=$this->get('jms_serializer')->deserialize($body,'StudyncoBundle\Entity\Post','json');

        $post->setTitle($data->getTitle());
        $post->setDescription($data->getDescription());
        $em=$this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new View("User Name Updated Successfully", Response::HTTP_OK);

    }

    /**
     * @Rest\Delete("/post/{id}")
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('StudyncoBundle:Post')->find($id);
        if (empty($user)) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        else {
            $em->remove($user);
            $em->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }


    /**
     * @param $id
     * @return JsonResponse
     * @Rest\Delete("/words/delete/{id}")
     */
    public function deleteWordAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $word = $this->getDoctrine()->getRepository('StudyncoBundle:Word')->find($id);
        $isSynonym  = $word->getIsSynonym();
        $em->remove($word);

        $em->flush();

        return new JsonResponse(
            array(
                'response' => 'ok',
                'isSynonym' => $isSynonym
            ),

            Response::HTTP_ACCEPTED);
    }

    /**
     * @param $id
     * @return JsonResponse
     *
     * @Rest\Delete("/fields/delete/{id}")
     */
    public function deleteFieldAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $field = $em->getRepository('StudyncoBundle:Field')->find($id);

        $em->remove($field);
        $em->flush();

        return new JsonResponse(
            array(
                'response' => 'ok'
            ),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @param $id
     * @return string
     * @Rest\Delete("/category/delete/{id}")
     */
    public function deleteCategoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('StudyncoBundle:Category')->find($id);
        $em->remove($category);
        $em->flush();
        return new JsonResponse(array(
            'category' => $category,
            //'fields' => $fields
        ),
            Response::HTTP_ACCEPTED);
    }
}   