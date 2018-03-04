<?php

namespace AppBundle\Entity;

/**
 * Feed
 */
class Feed
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $tittle;

    /**
     * @var \DateTime
     */
    private $createdTime;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $category;


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
     * Set tittle
     *
     * @param string $tittle
     *
     * @return Feed
     */
    public function setTittle($tittle)
    {
        $this->tittle = $tittle;

        return $this;
    }

    /**
     * Get tittle
     *
     * @return string
     */
    public function getTittle()
    {
        return $this->tittle;
    }

    /**
     * Set createdTime
     *
     * @param \DateTime $createdTime
     *
     * @return Feed
     */
    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;

        return $this;
    }

    /**
     * Get createdTime
     *
     * @return \DateTime
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Feed
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Feed
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Feed
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }
}

