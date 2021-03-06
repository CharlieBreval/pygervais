<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * Action : Display the home
     *
     * @param  Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $locale = $request->getLocale();
        $stack = $this->get('request_stack');
        $masterRequest = $stack->getMasterRequest();
        $posts = $this->getDoctrine()->getManager()->getRepository('AdminBundle:Post')->findBy([], [
            'createdAt' => 'DESC',
        ], 10);

        foreach ($posts as $post) {
            $post->translate($locale);
        }

        return $this->render('AppBundle:Home:index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @param  Request $request
     * @return JsonResponse
     */
    public function likeAction(Request $request, $post_id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AdminBundle:Post')->find($post_id);
        $post->increaseLikes();

        $em->flush();

        return new JsonResponse(['html' => $post->getLikes()]);
    }
}
