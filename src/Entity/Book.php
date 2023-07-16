<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a book in the Library, from kmom05
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 13)]
    private ?string $isbn = null;

    #[ORM\Column(length: 255)]
    private ?string $author = null;

    #[ORM\Column(length: 100)]
    private ?string $img = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns title of the book
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Sets title of the book
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns the ISBN number of the book
     */
    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    /**
     * Sets ISBN of the book, should be 10 digits (as string)
     */
    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Returns name of the authour of the book
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * Sets the author of the book
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Returns link to the image of the book. Should be the full path inkl https:// or http://
     */
    public function getImg(): ?string
    {
        return $this->img;
    }

    /**
     * Sets link to an image of the book. Should be the full path inkl https:// or http://
     */
    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }
}
