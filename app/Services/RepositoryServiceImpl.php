<?php

namespace App\Services;


interface RepositoryServiceImpl
{
    public function find(int $id);
    public function finds(array $ids);
    public function all();
    public function create(array $attributes);
    public function createFromRequest($request);
    public function update(int $id, array $attributes);
    public function updateFromRequest(int $id, $request);
    public function delete(int $id): bool;
    public function secondFind(int $id);
    public function secondFinds(array $ids);
    public function secondAll();
    public function secondCreate(array $attributes);
    public function secondCreateFromRequest($request);
    public function secondUpdate(int $id, array $attributes);
    public function secondUpdateFromRequest(int $id, $request);
    public function secondDelete(int $id): bool;
    public function repoFind(int $id, string $repoName);
    public function repoFinds(array $ids, string $repoName);
    public function repoAll(string $repoName);
    public function repoCreate(array $attributes, string $repoName);
    public function repoCreateCreateFromRequest($request, string $repoName);
    public function repoUpdate(int $id, array $attributes, string $repoName);
    public function repoUpdateFromRequest(int $id, $request, string $repoName);
    public function repoDelete(int $id, string $repoName): bool;
}
