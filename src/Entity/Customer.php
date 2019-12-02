<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Customer\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long.",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters."
     * )
     */
    private $firstName;

    /**
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Your second name must be at least {{ limit }} characters long.",
     *      maxMessage = "Your second name cannot be longer than {{ limit }} characters."
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $companyName;

    /**
     * @Assert\Length(
     *     min = 8,
     *     max = 20,
     *     minMessage = "Your phone number must be at least {{ limit }} characters long.",
     *     maxMessage = "Your phone number annot be longer than {{ limit }} characters."
     * )
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/",
     *     message="number_only"
     * )
     * @ORM\Column(type="string", length=10)
     */
    private $phone;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     *);
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @Assert\Choice(
     *     {"Ukraine", "Germany", "Poland"},
     *     message = "Invalid value of choice."
     *     )
     *
     * @ORM\Column(type="string", length=50)
     */
    private $country;

    /**
     * @Assert\NotBlank(
     *     message = "Value can not be a null."
     * )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $firstAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondAddress;

    /**
     * @Assert\Length(
     *     min = 2,
     *     max = 50,
     *     minMessage = "Your city must be at least {{ limit }} characters long.",
     *     maxMessage = "Your city annot be longer than {{ limit }} characters."
     *
     * )
     *
     * @ORM\Column(type="string", length=100)
     */
    private $city;

    /**
     * @Assert\Type(
     *     type = "integer",
     *     message = "Value is not valid."
     * )
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $postcode;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="customer")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getFirstAddress(): ?string
    {
        return $this->firstAddress;
    }

    public function setFirstAddress(string $firstAddress): self
    {
        $this->firstAddress = $firstAddress;

        return $this;
    }

    public function getSecondAddress(): ?string
    {
        return $this->secondAddress;
    }

    public function setSecondAddress(?string $secondAddress): self
    {
        $this->secondAddress = $secondAddress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCustomer($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getCustomer() === $this) {
                $order->setCustomer(null);
            }
        }

        return $this;
    }
}
