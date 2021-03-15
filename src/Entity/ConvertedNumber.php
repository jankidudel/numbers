<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ConvertedNumberRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ConvertedNumberRepository::class)
 */
class ConvertedNumber
{
    public const TYPE_BINARY = 0;
    public const TYPE_INTEGER = 1;
    public const TYPE_ROMAN = 2;
    public const TYPE_HEX = 3;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"write"})
     */
    private $original;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *     min = 1,
     *     max = 3999,
     *     notInRangeMessage = "Number to convert must be between {{ min }} and {{ max }}",
     * )
     */
    private $originalInteger;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $converted;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"write"})
     */
    private $numeralTypeFrom;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"write"})
     */
    private $numeralTypeTo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginal(): ?string
    {
        return $this->original;
    }

    public function setOriginal(string $original): self
    {
        $this->original = $original;

        return $this;
    }

    public function getOriginalInteger(): ?int
    {
        return $this->originalInteger;
    }

    public function setOriginalInteger(int $originalInteger): self
    {
        $this->originalInteger = $originalInteger;

        return $this;
    }

    public function getConverted(): ?string
    {
        return $this->converted;
    }

    public function setConverted(string $converted): self
    {
        $this->converted = $converted;

        return $this;
    }

    public function getNumeralTypeFrom(): ?int
    {
        return $this->numeralTypeFrom;
    }

    public function setNumeralTypeFrom(int $numeralTypeFrom): self
    {
        $this->numeralTypeFrom = $numeralTypeFrom;

        return $this;
    }

    public function getNumeralTypeTo(): ?int
    {
        return $this->numeralTypeTo;
    }

    public function setNumeralTypeTo(int $numeralTypeTo): self
    {
        $this->numeralTypeTo = $numeralTypeTo;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }
}
