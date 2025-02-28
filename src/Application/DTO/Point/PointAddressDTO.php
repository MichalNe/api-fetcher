<?php

declare(strict_types=1);

namespace App\Application\DTO\Point;

class PointAddressDTO
{
    public function __construct(
        private string $city = '',
        private string $province = '',
        private string $postCode = '',
        private string $street = '',
        private string $buildingNumber = '',
        private ?string $flatNumber = '',
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

    public function getProvince(): string
    {
        return $this->province;
    }

    public function setProvince(string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getPostCode(): string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getBuildingNumber(): string
    {
        return $this->buildingNumber;
    }

    public function setBuildingNumber(string $buildingNumber): self
    {
        $this->buildingNumber = $buildingNumber;

        return $this;
    }

    public function getFlatNumber(): ?string
    {
        return $this->flatNumber;
    }

    public function setFlatNumber(?string $flatNumber): self
    {
        $this->flatNumber = $flatNumber;

        return $this;
    }
}