<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\PostRepository")
 */
class Post
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
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=255, nullable=true)
     */
    private $titleEn;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_en", type="string", length=255, nullable=true)
     */
    private $slugEn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="string", length=255)
     */
    private $synopsis;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis_en", type="string", length=255, nullable=true)
     */
    private $synopsisEn;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="body_en", type="text", nullable=true)
     */
    private $bodyEn;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail", type="string", length=255)
     */
    private $thumbnail;

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=255)
     */
    private $cover;


    /**
     * @var int
     *
     * @ORM\Column(name="likes", type="integer")
     */
    private $likes;

    public function translate($locale)
    {
        switch ($locale) {
            case 'en':
                if ($this->titleEn !== null) {
                    $this->setTitle($this->getTitleEn());
                }
                if ($this->synopsisEn !== null) {
                    $this->setSynopsis($this->getSynopsisEn());
                }
                if ($this->bodyEn !== null) {
                    $this->setBody($this->getBodyEn());
                }
                break;

            default:
                # code...
                break;
        }
    }

    public function increaseLikes()
    {
        $this->setLikes($this->getLikes() + 1);
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setLikes(0);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set titleEn
     *
     * @param string $titleEn
     *
     * @return Post
     */
    public function setTitleEn($titleEn)
    {
        $this->titleEn = $titleEn;

        return $this;
    }

    /**
     * Get titleEn
     *
     * @return string
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slugEn
     *
     * @param string $slugEn
     *
     * @return Post
     */
    public function setSlugEn($slugEn)
    {
        $this->slugEn = $slugEn;

        return $this;
    }

    /**
     * Get slugEn
     *
     * @return string
     */
    public function getSlugEn()
    {
        return $this->slugEn;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set synopsis
     *
     * @param string $synopsis
     *
     * @return Post
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get synopsis
     *
     * @return string
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set synopsisEn
     *
     * @param string $synopsisEn
     *
     * @return Post
     */
    public function setSynopsisEn($synopsisEn)
    {
        $this->synopsisEn = $synopsisEn;

        return $this;
    }

    /**
     * Get synopsisEn
     *
     * @return string
     */
    public function getSynopsisEn()
    {
        return $this->synopsisEn;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set bodyEn
     *
     * @param string $bodyEn
     *
     * @return Post
     */
    public function setBodyEn($bodyEn)
    {
        $this->bodyEn = $bodyEn;

        return $this;
    }

    /**
     * Get bodyEn
     *
     * @return string
     */
    public function getBodyEn()
    {
        return $this->bodyEn;
    }

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     *
     * @return Post
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set cover
     *
     * @param string $cover
     *
     * @return Post
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Add comment
     *
     * @param \AdminBundle\Entity\Comment $comment
     *
     * @return Post
     */
    public function addComment(\AdminBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AdminBundle\Entity\Comment $comment
     */
    public function removeComment(\AdminBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set likes
     *
     * @param string $likes
     *
     * @return Post
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return string
     */
    public function getLikes()
    {
        return $this->likes;
    }
}
