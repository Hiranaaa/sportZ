<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    public function all(): Collection;

    public function find(string $id): ?Model;

    public function findOrFail(string $id): Model;

    public function create(array $data): Model;

    public function update(string $id, array $data): Model;

    public function delete(string $id): bool;

    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function findWhere(array $conditions): Collection;

    public function count(): int;
}
