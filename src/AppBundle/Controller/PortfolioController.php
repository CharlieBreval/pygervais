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
        var_dump($subcategorySlug); die;
        return $this->render('AppBundle:Blog:show.html.twig', [
            'post' => $post
        ]);
    }
}
