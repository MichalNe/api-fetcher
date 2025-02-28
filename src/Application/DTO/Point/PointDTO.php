<?php

declare(strict_types=1);

namespace App\Application\DTO\Point;

class PointDTO
{
    public function __construct(
        private string $name,
        private PointAddressDTO $addressDetails = new PointAddressDTO(),
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddressDetails(): PointAddressDTO
    {
        return $this->addressDetails;
    }

    public function setAddressDetails(PointAddressDTO $addressDetails): self
    {
        $this->addressDetails = $addressDetails;

        return $this;
    }


}