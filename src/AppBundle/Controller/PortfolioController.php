<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\Comment;
use AdminBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PortfolioController extends Controller
{
    public function portfolioAction(Request $request, $categorySlug, $subcategorySlug)
    {
        $manager = $this->getDoctrine()->getManager();
        $category = $manager->getRepository('AdminBundle:Category')->findOneBy([
            'slug' => $categorySlug
        ]);

        $subcategory = $manager->getRepository('AdminBundle:Subcategory')->findOneBy([
            'category' => $category,
            'slug' => $subcategorySlug
        ]);

        return $this->render('AppBundle:Portfolio:portfolio.html.twig', [
            'subcategory' => $subcategory
        ]);
    }
}
