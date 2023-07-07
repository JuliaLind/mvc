<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Movement of coints to or from participants
 * account
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
#[ORM\Entity(repositoryClass: TransactionRepository::class)]
#[ORM\Table(name: '`transaction`')]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $registered = null;

    #[ORM\Column(length: 100)]
    private ?string $descr = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Gets the transaction date
     */
    public function getRegistered(): ?\DateTimeInterface
    {
        return $this->registered;
    }

    /**
     * Sets the transaction date
     */
    public function setRegistered(\DateTimeInterface $registered): self
    {
        $this->registered = $registered;

        return $this;
    }

    /**
     * Gets the description of the transaction
     */
    public function getDescr(): ?string
    {
        return $this->descr;
    }

    /**
     * Sets a description to the transaction
     */
    public function setDescr(string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }

    /**
     * Gets the amount of the transaction
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * Sets the amount fo the transaction
     */
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Gets the user to which the transaction belongs
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Sets the user to which the transaction belongs
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
