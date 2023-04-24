<?php

namespace App\Params;

interface FindParamsInterface
{
    public function setLimit(int $limit): FindParamsInterface;

    public function getLimit(): int;

    public function setOffset(int $offset): FindParamsInterface;

    public function getOffset(): int;
}
