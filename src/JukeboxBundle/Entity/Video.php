<?php

namespace JukeboxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="JukeboxBundle\Repository\VideoRepository")
 */
class Video
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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="owner", type="string", length=255)
     */
    private $owner;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_date_played", type="datetime", nullable=true)
     */
    private $lastDatePlayed;


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
     * Set id
     *
     * @param int $id
     *
     * @return Video
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Video
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set owner
     *
     * @param string $owner
     *
     * @return Video
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set lastDatePlayed
     *
     * @param \DateTime $lastDatePlayed
     *
     * @return Video
     */
    public function setLastDatePlayed($lastDatePlayed)
    {
        $this->lastDatePlayed = $lastDatePlayed;

        return $this;
    }

    /**
     * Get lastDatePlayed
     *
     * @return \DateTime
     */
    public function getLastDatePlayed()
    {
        return $this->lastDatePlayed;
    }

    public $urlFromForm;

    public function getUrlFromForm()
    {
        return $this->urlFromForm;
    }

    public function createUrlForDetail()
    {
        $urlForDetail = "video/detail" . "";
    }

}