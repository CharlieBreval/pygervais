<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller
{
    /**
     * Action : Display the home
     *
     * @param  Request $request
     * @return Response
     */
    public function menuAction(Request $request)
    {
        $stack = $this->get('request_stack');
        $masterRequest = $stack->getMasterRequest();
        $currentRoute = $masterRequest->get('_route');

        $categories = $this->getDoctrine()->getManager()->getRepository('AdminBundle:Category')
            ->findAll();

        return $this->render('AppBundle:Menu:menu.html.twig', [
            'currentRoute' => $currentRoute,
            'categories' => $categories
        ]);
    }
}
