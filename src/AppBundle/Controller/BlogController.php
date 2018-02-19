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
        $locale = $request->getLocale();

        if ($request->getMethod() === 'POST' && $this->captchaverify($request->get('g-recaptcha-response'))) {
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

        $post->translate($locale);

        return $this->render('AppBundle:Blog:show.html.twig', [
            'post' => $post
        ]);
    }

    function captchaverify($recaptcha){
            $url = "https://www.google.com/recaptcha/api/siteverify";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                "secret"=>"6LfpWUcUAAAAACSzbgbPB1RGZc_vsIwPgWPnis6o","response"=>$recaptcha));
            $response = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($response);

        return $data->success;
    }
}
