<?php

namespace App\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations;
use Symfony\Component\Security\Core\User\LegacyPasswordAuthenticatedUserInterface;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @ORM\HasLifecycleCallbacks
 */
class User implements LegacyPasswordAuthenticatedUserInterface
{
    
     /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="text", unique="true")
     */
    public $email;
    /**
     * @ORM\Column(type="string")
     */
    public $password;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @var datetime $updated_at
     * 
     * @ORM\Column(type="datetime", nullable = true)
     */
    protected $updated_at;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     */
    public function setCreatedAt(\DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     */
    public function setUpdatedAt(\DateTime $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /** 
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created_at = new \DateTime("now");
    }

    /**
     * Gets triggered every time on update
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated_at = new \DateTime("now");
    }

    /**
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }   
}
