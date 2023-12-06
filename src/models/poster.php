<?php
declare(strict_types=1);
namespace MovieApi\models;
use Assert\Assertion;
use Assert\AssertionFailedException;
final readonly class Poster
{
    /**
     * @throws AssertionFailedException
     */
    public function __construct(private string $poster)
    {
        Assertion::url($this->poster, 'This must be in URL format');
        Assertion::notEmpty($this->poster, 'This cannot be empty');
    }
    public function toString(): string
    {
        return $this->poster;
    }
    public function __toString(): string
    {
        return $this->toString();
    }
}