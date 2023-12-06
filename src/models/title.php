<?php
declare(strict_types=1);
namespace MovieApi\models;
use Assert\Assertion;
use Assert\AssertionFailedException;
final readonly class Title
{
    /**
     * @throws AssertionFailedException
     */
    public function __construct(private string $title)
    {
        Assertion::minLength($this->title, 5, 'Title must be at least minimum of 5 character long');
        Assertion::string($this->title, 'Title must be a string');
    }
    public function toString(): string
    {
        return $this->title;
    }
    public function __toString(): string
    {
        return $this->toString();
    }
}