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
        $locale        = $request->getLocale();
        $stack         = $this->get('request_stack');
        $masterRequest = $stack->getMasterRequest();
        $currentRoute  = $masterRequest->get('_route');

        $categories = $this->getDoctrine()->getManager()->getRepository('AdminBundle:Category')
            ->createQueryBuilder('c')
            ->innerJoin('c.subcategories', 'sc')
            ->innerJoin('sc.paintings', 'p')
            ->getQuery()
            ->getResult()
        ;

        foreach ($categories as $category) {
            $category->translate($locale);

            foreach ($category->getSubcategories() as $subcategory) {
                $subcategory->translate($locale);
            }
        }

        return $this->render('AppBundle:Menu:menu.html.twig', [
            'categories' => $categories,
            'currentRoute' => $currentRoute
        ]);
    }
}
