<?php

namespace App\Application\DTO\Point;

use App\Presentation\Front\Validator\Postcode;
use App\Presentation\Front\Validator\StreetWithPostcode;
use Symfony\Component\Validator\Constraints as Assert;

#[StreetWithPostcode]
class PointInputFormDTO
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 3, max: 64)]
        public string $city,

        #[Assert\NotBlank(allowNull: true)]
        #[Assert\Length(min: 3, max: 64)]
        public ?string $street,

        #[Assert\NotBlank(allowNull: true)]
        #[Postcode]
        public ?string $postcode,
    ) {
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;


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
}