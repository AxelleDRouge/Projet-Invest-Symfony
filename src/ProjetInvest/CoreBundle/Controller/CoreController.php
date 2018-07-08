<?php

namespace ProjetInvest\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjetInvestCoreBundle:Core:index.html.twig');
    }
}
