<?php
namespace IR\RedmineAPIBundle\Helper;

use Redmine\Client;

/**
 * Class HRedmine - Helper API Client Redmine
 * @package IR\RedmineAPIBundle\Helper
 *
 * if you have comments on the class name, I know that the agreement is not so correct.
 * But it's for me comfortably. This is my style in this project. (RedmineHelper -> HRedmine)
 */
class HRedmine
{
    private $client;

    public function __construct($url, $apiKey)
    {
        $this->client = new Client($url, $apiKey);
    }

    public function getProjects()
    {
        $projects = $this->client->api('project')->all();

        return $projects['projects'];
    }

    public function getProject($projectId)
    {
        $project = $this->client->api('project')->show($projectId);

        return $project['project'];
    }

    public function getTrackers()
    {
        $trackers = $this->client->api('tracker')->all();

        return $trackers['trackers'];
    }

    public function getIssuesByTracker($projectId, $trackerId)
    {
        $issues = $this->client->api('issue')->all(array('project_id' => $projectId, 'tracker_id' => $trackerId));

        return $issues['issues'];
    }

    public function getTrackerIssues($projectId)
    {
        $issues = $this->client->api('issue')->all(array('project_id' => $projectId));
        $issuesByTracker = array();

        if (empty($issues['issues'])) {
            return $issuesByTracker;
        }
        foreach ($issues['issues'] as $issue) {
            $issuesByTracker[$issue['tracker']['name']][] = $issue;
        }

        return array(
            'projectName' => $issues['issues'][0]['project']['name'],
            'issues'      => $issuesByTracker
        );
    }
}