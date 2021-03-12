<?php

namespace VoitureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VoitureBundle:Default:index.html.twig');
    }
    public function contactAction()
    {
        return $this->render('VoitureBundle:Default:contact.html.twig');
    }
    public function aboutAction()
    {
        return $this->render('VoitureBundle:Default:about.html.twig');
    }
    public function loginAction()
    {
        return $this->render('VoitureBundle:Default:authentification.html.twig');
    }


}
