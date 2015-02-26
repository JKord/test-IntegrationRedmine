<?php
namespace IR\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IssueController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction($id)
    {
        return array();
    }
}