<?php
namespace IR\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="IR\SiteBundle\Entity\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var text
     *
     * @ORM\Column(name="text", type="text",  nullable=false)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="author_name", type="string", length=255, nullable=false)
     */
    private $authorName;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="integer", nullable=false)
     */
    private $projectId;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * @return int
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * @return text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}