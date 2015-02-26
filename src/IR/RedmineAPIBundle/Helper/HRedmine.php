<?php
namespace IR\RedmineAPIBundle\Helper;

use Redmine\Client;

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

    public function getIssuesByTracker($projectId)
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