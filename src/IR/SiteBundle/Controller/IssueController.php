<?php
namespace IR\SiteBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Component\HttpFoundation\Request;
use IR\SiteBundle\Form\TrackTimeType,
    IR\SiteBundle\Model\TrackTime;

class IssueController extends BaseController
{
    private $redmineApi;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->redmineApi = $this->get('ir.redmine_api');
    }

    /**
     * @Template()
     */
    public function indexAction($projectId)
    {
        return array(
            'project'  => $this->redmineApi->getProject($projectId),
            'trackers' => $this->redmineApi->getTrackers()
        );
    }

    public function getIssuesByTrackerAction(Request $request, $projectId)
    {
        $trackerId = $request->get('trackerId');
        if (empty($trackerId)) {
            return $this->getResponse(4);
        }

        $issues = $this->redmineApi->getIssuesByTracker($projectId, $trackerId);
        $issuesHtml = $this->renderView('IRSiteBundle:Issue:issues.html.twig', array('issues' => $issues));

        return $this->getResponse(1, array('issuesHtml' =>  $issuesHtml));
    }

    /**
     * @Template()
     */
    public function trackTimeAction(Request $request, $projectId, $issueId)
    {
        $trackTime = new TrackTime($projectId, $issueId);
        $form = $this->createTrackTimeForm($trackTime);

        if ('PUT' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {

                return $this->redirect($this->generateUrl('ir_site_projects_issue', array('projectId' => $projectId)));
            }
        }

        return array('trackTime' => $trackTime, 'form' => $form->createView());
    }

    private function createTrackTimeForm(TrackTime $trackTime)
    {
        $form = $this->createForm(new TrackTimeType(), $trackTime, array(
            'action' => $this->generateUrl('ir_site_projects_issue_trackTime', array(
                'projectId' => $trackTime->projectId,
                'issueId' => $trackTime->issueId)),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Відправити'));

        return $form;
    }
}