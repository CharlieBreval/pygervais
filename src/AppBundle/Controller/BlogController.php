<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\Comment;
use AdminBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    public function showAction(Request $request, Post $post)
    {
        if ($request->getMethod() === 'POST') {
            $params = $request->request->all();

            $comment = new Comment();
            $comment->setCreatedAt(new \DateTime());
            $comment->setCreatedByEmail($params['email']);
            $comment->setCreatedBy($params['name']);
            $comment->setBody($params['comment']);
            $comment->setPost($post);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }
        return $this->render('AppBundle:Blog:show.html.twig', [
            'post' => $post
        ]);
    }
}
