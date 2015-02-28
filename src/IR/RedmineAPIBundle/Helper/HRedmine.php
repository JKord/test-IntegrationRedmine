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

    const PROJECT_LIMIT = 1000;
    const ISSUE_LIMIT = 5;

    public function __construct($url, $apiKey)
    {
        $this->client = new Client($url, $apiKey);
    }

    public function getProjects()
    {
        $projects = $this->client->api('project')->all(array('limit' => self::PROJECT_LIMIT));

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

    public function getIssuesByTracker($projectId, $trackerId, $page = 1)
    {
        $issues = $this->client->api('issue')->all(array(
            'project_id' => $projectId,
            'tracker_id' => $trackerId,
            'limit' => self::ISSUE_LIMIT, 'offset' => self::ISSUE_LIMIT * ($page - 1)
        ));

        return $issues;
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

    public function getIssue($issueId)
    {
        $issues = $this->client->api('issue')->show($issueId);

        return $issues['issue'];
    }

    public function trackTime($issueId, $projectId, $hours, $comments = '')
    {
        return $this->client->api('time_entry')->create(array(
            'issue_id'    => $issueId,
            'project_id'  => $projectId,
            'hours'       => $hours,
            'comments'    => $comments,
        ));
    }
}