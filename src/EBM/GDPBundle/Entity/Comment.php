<?php

namespace EBM\GDPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="EBM\GDPBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="EBM\GDPBundle\Entity\Conversation", inversedBy="comments",cascade={"persist"})
     *
     * @ORM\JoinColumn(nullable=false)
     */

    private $conversation;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set conversation
     *
     * @param \EBM\GDPBundle\Entity\Conversation $conversation
     *
     * @return Comment
     */
    public function setConversation(\EBM\GDPBundle\Entity\Conversation $conversation)
    {
        $this->conversation = $conversation;

        $conversation->addComment($this);

        return $this;
    }

    /**
     * Get conversation
     *
     * @return \EBM\GDPBundle\Entity\Conversation
     */
    public function getConversation()
    {
        return $this->conversation;
    }
}
