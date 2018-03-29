<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index as Index;

/**
 * Log
 *
 * @ORM\Table(name="log", indexes={@Index(name="created", columns={"created_at"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LogRepository")
 */
class Log
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
     * @ORM\Column(name="session_id", type="string", length=40)
     */
    private $sessionId;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_address", type="string", length=45)
     */
    private $ipAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="request_uri", type="string", length=65535, nullable=true)
     */
    private $requestUri;

    /**
     * @var string
     *
     * @ORM\Column(name="post_params", type="string", length=65535, nullable=true)
     */
    private $postParams;

    /**
     * @var string
     *
     * @ORM\Column(name="get_params", type="string", length=65535, nullable=true)
     */
    private $getParams;

    /**
     * @var string
     *
     * @ORM\Column(name="request_method", type="string", length=7)
     */
    private $requestMethod;

    /**
     * @var string
     *
     * @ORM\Column(name="sent_files", type="string", length=65535, nullable=true)
     */
    private $sentFiles;

    /**
     * @var string
     *
     * @ORM\Column(name="http_referer", type="string", length=65535, nullable=true)
     */
    private $httpReferer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

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
     * Set sessionId
     *
     * @param string $sessionId
     *
     * @return Log
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * Get sessionId
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     *
     * @return Log
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set requestUri
     *
     * @param string $requestUri
     *
     * @return Log
     */
    public function setRequestUri($requestUri)
    {
        $this->requestUri = $requestUri;

        return $this;
    }

    /**
     * Get requestUri
     *
     * @return string
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * Set postParams
     *
     * @param string $postParams
     *
     * @return Log
     */
    public function setPostParams($postParams)
    {
        $this->postParams = $postParams;

        return $this;
    }

    /**
     * Get postParams
     *
     * @return string
     */
    public function getPostParams()
    {
        return $this->postParams;
    }

    /**
     * Set getParams
     *
     * @param string $getParams
     *
     * @return Log
     */
    public function setGetParams($getParams)
    {
        $this->getParams = $getParams;

        return $this;
    }

    /**
     * Get getParams
     *
     * @return string
     */
    public function getGetParams()
    {
        return $this->getParams;
    }

    /**
     * Set requestMethod
     *
     * @param string $requestMethod
     *
     * @return Log
     */
    public function setRequestMethod($requestMethod)
    {
        $this->requestMethod = $requestMethod;

        return $this;
    }

    /**
     * Get requestMethod
     *
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * Set sentFiles
     *
     * @param string $sentFiles
     *
     * @return Log
     */
    public function setSentFiles($sentFiles)
    {
        $this->sentFiles = $sentFiles;

        return $this;
    }

    /**
     * Get sentFiles
     *
     * @return string
     */
    public function getSentFiles()
    {
        return $this->sentFiles;
    }

    /**
     * Set httpReferer
     *
     * @param string $httpReferer
     *
     * @return Log
     */
    public function setHttpReferer($httpReferer)
    {
        $this->httpReferer = $httpReferer;

        return $this;
    }

    /**
     * Get httpReferer
     *
     * @return string
     */
    public function getHttpReferer()
    {
        return $this->httpReferer;
    }

    /**
     * Set createdAt
     * @ORM\PrePersist
     * @param \DateTime $createdAt
     *
     * @return Animal
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime();

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
}

