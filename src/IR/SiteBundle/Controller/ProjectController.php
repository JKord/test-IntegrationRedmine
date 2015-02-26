<?php
namespace IR\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectController extends Controller
{
    public function indexAction()
    {
        return $this->render('IRSiteBundle:Project:index.html.twig', array());
    }
}