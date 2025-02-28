<?php

declare(strict_types=1);

namespace App\Application\DTO\Point;

use App\Application\Strategy\ResourceOutputInterface;

class PointCollectionDTO implements ResourceOutputInterface
{
    public function __construct(
        private int $count,
        private int $page,
        private int $totalPages ,
        /** @var PointDTO[] $items */
        private array $items,
    ) {
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function setTotalPages(int $totalPages): self
    {
        $this->totalPages = $totalPages;

        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function addItem(PointDTO $item): self
    {
        $this->items[] = $item;

        return $this;
    }
}