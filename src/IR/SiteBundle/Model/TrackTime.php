<?php
namespace IR\SiteBundle\Model;

/**
 * TrackTime
 */
class TrackTime
{
    public $issueId,
        $projectId,
        $hours,
        $comments;

    public function __construct($issueId, $projectId)
    {
        $this->issueId = $issueId;
        $this->projectId = $projectId;
    }
}