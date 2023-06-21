<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Project\UserNotRegisteredException;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $acronym = null;

    #[ORM\Column(length: 100)]
    private ?string $hash = null;


    /**
     * @var Collection<int,Transaction> $transactions
     */
    #[ORM\OneToMany(mappedBy: 'userid', targetEntity: Transaction::class)]
    private Collection $transactions;

    /**
     * @var Collection<int,Score> $scores
     */
    #[ORM\OneToMany(mappedBy: 'userid', targetEntity: Score::class)]
    private Collection $scores;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->scores = new ArrayCollection();
    }

    public function getId(): int
    {
        if (!$this->id) {
            throw new UserNotRegisteredException();
        }
        return $this->id;
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

    public function getAcronym(): ?string
    {
        return $this->acronym;
    }

    public function setAcronym(string $acronym): self
    {
        $this->acronym = $acronym;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    // public function getBalance(): int
    // {
    //     $balance = 0;
    //     $transactions = $this->transactions->toArray();
    //     foreach($transactions as $transaction) {
    //         $balance += $transaction->getAmount();
    //     }
    //     return $balance;
    // }

    /**
     * @return Collection<int, Transaction>
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions->add($transaction);
            $transaction->setUserid($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getUserid() === $this) {
                $transaction->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Score>
     */
    public function getScores(): Collection
    {
        return $this->scores;
    }

    public function addScore(Score $score): self
    {
        if (!$this->scores->contains($score)) {
            $this->scores->add($score);
            $score->setUserid($this);
        }

        return $this;
    }

    public function removeScore(Score $score): self
    {
        if ($this->scores->removeElement($score)) {
            // set the owning side to null (unless already changed)
            if ($score->getUserid() === $this) {
                $score->setUserid(null);
            }
        }

        return $this;
    }
}
