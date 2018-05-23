<?php

namespace PIdev\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PIdevApiBundle:Default:index.html.twig');
    }
}
