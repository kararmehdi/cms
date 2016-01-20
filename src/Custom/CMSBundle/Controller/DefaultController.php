<?php

namespace Custom\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CustomCMSBundle:Default:index.html.twig');
    }
}
