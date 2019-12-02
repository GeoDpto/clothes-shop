<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    /**
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Your name must be at least {{ limit }} characters long.",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters."
     * )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     *);
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subject;

    /**
     * @Assert\Length(
     *      min = 10,
     *      max = 500,
     *      minMessage = "Your message must be at least {{ limit }} characters long.",
     *      maxMessage = "Your message cannot be longer than {{ limit }} characters."
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
