<?php
namespace IR\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IssueController extends Controller
{
    public function indexAction()
    {
        return $this->render('IRSiteBundle:Issue:index.html.twig', array());
    }
}