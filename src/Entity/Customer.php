<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $customer_admin;

	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $customer_first_name;

	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $customer_last_name;

	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $customer_email;

	/**
	 * @ORM\Column(type="string", length=10, nullable=true)
	 */
	private $customer_phone;

	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $customer_password;

	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $customer_address;

	/**
	 * @ORM\Column(type="string", length=5)
	 */
	private $customer_post_code;

	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $customer_city;

	public function __toString(): string
	{
			return $this->customer_name;
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getCustomerAdmin(): ?int
	{
		return $this->customer_admin;
	}

	public function setCustomerAdmin(int $customer_admin): self
	{
		$this->customer_admin = $customer_admin;

		return $this;
	}

	public function getCustomerFirstName(): ?string
	{
		return $this->customer_first_name;
	}

	public function setCustomerFirstName(string $customer_first_name): self
	{
		$this->customer_first_name = $customer_first_name;

		return $this;
	}

	public function getCustomerLastName(): ?string
	{
		return $this->customer_last_name;
	}

	public function setCustomerLastName(string $customer_last_name): self
	{
		$this->customer_last_name = $customer_last_name;

		return $this;
	}

	public function getCustomerEmail(): ?string
	{
		return $this->customer_email;
	}

	public function setCustomerEmail(string $customer_email): self
	{
		$this->customer_email = $customer_email;

		return $this;
	}

	public function getCustomerPhone(): ?string
	{
		return $this->customer_phone;
	}

	public function setCustomerPhone(?string $customer_phone): self
	{
		$this->customer_phone = $customer_phone;

		return $this;
	}

	public function getCustomerPassword(): ?string
	{
		return $this->customer_password;
	}

	public function setCustomerPassword(string $customer_password): self
	{
		$this->customer_password = $customer_password;

		return $this;
	}

	public function getCustomerAddress(): ?string
	{
		return $this->customer_address;
	}

	public function setCustomerAddress(string $customer_address): self
	{
		$this->customer_address = $customer_address;

		return $this;
	}

	public function getCustomerPostCode(): ?string
	{
		return $this->customer_post_code;
	}

	public function setCustomerPostCode(string $customer_post_code): self
	{
		$this->customer_post_code = $customer_post_code;

		return $this;
	}

	public function getCustomerCity(): ?string
	{
		return $this->customer_city;
	}

	public function setCustomerCity(string $customer_city): self
	{
		$this->customer_city = $customer_city;

		return $this;
	}
}
