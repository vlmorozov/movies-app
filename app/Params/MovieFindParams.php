<?php

namespace App\Params;

class MovieFindParams implements FindParamsInterface
{
    private ?string $searchQuery = null;

    private ?array $genres = null;

    private ?int $year = null;

    public function __construct(
       private int $offset = 0,
       private int $limit = 10,
    ) {}

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }
    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setOffset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setSearchQuery(?string $searchQuery): self
    {
        $this->searchQuery = $searchQuery;

        return $this;
    }

    public function getSearchQuery(): ?string
    {
        return $this->searchQuery;
    }

    public function setGenres(?array $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    public function getGenres(): ?array
    {
        return $this->genres;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }
}
