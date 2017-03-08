<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Admin controller.
 *
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:default:index.html.twig');
    }
}
