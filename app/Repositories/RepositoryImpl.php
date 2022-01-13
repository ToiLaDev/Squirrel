<?php

namespace App\Repositories;


interface RepositoryImpl
{

    public function filter(array $attributes): array;

    public function model();

    public function all();

    public function count(): int;

    public function find($id);

    public function finds($ids);

    public function create(array $attributes);

    public function insert(array $attributes);

    public function update(int $id, array $attributes);

    public function updateWithExtend(int $id, array $attributes);

    public function delete(int $id): bool;

    public function newQuery() : \Illuminate\Database\Eloquent\Builder;

    public function firstOrCreate($wheres, $attributes = null);

    public function updateOrCreate($wheres, $attributes = null);
}
