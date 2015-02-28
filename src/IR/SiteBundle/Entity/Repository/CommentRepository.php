<?php
namespace IR\SiteBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use IR\SiteBundle\Entity\Comment;

class CommentRepository extends EntityRepository
{
    public function findByProjectId($projectId)
    {
        return $this->createQueryBuilder('c')
            ->select('c.id, c.text, c.authorName')
            ->where('c.projectId = :projectId')
            ->setParameter('projectId', $projectId)
            ->getQuery()->execute();
    }

    public function add($text, $authorName, $projectId)
    {
        $comment = new Comment();
        $comment
            ->setText($text)
            ->setAuthorName($authorName)
            ->setProjectId($projectId);

        $this->_em->persist($comment);
        $this->_em->flush();
    }
}