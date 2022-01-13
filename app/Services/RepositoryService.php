<?php

namespace App\Services;


class RepositoryService implements RepositoryServiceImpl
{
    protected $firstRepo;
    protected $secondRepo;
    protected $listRepo;

    public function find(int $id)
    {
        return $this->firstRepo->find($id);
    }

    public function finds(array $ids)
    {
        return $this->firstRepo->finds($ids);
    }

    public function all()
    {
        return $this->firstRepo->all();
    }

    public function create(array $attributes)
    {
        return $this->firstRepo->create($attributes);
    }

    public function createFromRequest($request)
    {
        $attributes = $request->all();
        return $this->firstRepo->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        return $this->firstRepo->update($id, $attributes);
    }

    public function updateFromRequest(int $id, $request)
    {
        $attributes = $request->all();
        return $this->firstRepo->update($id, $attributes);
    }

    public function delete(int $id): bool
    {
        return $this->firstRepo->delete($id);
    }

    public function secondFind(int $id)
    {
        return $this->secondRepo->find($id);
    }

    public function secondFinds(array $ids)
    {
        return $this->secondRepo->finds($ids);
    }

    public function secondAll()
    {
        return $this->secondRepo->all();
    }

    public function secondCreate(array $attributes)
    {
        return $this->secondRepo->create($attributes);
    }

    public function secondCreateFromRequest($request)
    {
        $attributes = $request->all();
        return $this->secondRepo->create($attributes);
    }

    public function secondUpdate(int $id, array $attributes)
    {
        return $this->secondRepo->update($id, $attributes);
    }

    public function secondUpdateFromRequest(int $id, $request)
    {
        $attributes = $request->all();
        return $this->secondRepo->update($id, $attributes);
    }

    public function secondDelete(int $id): bool
    {
        return $this->secondRepo->delete($id);
    }

    public function repoFind(int $id, string $repoName)
    {
        return $this->listRepo[$repoName]->find($id);
    }

    public function repoFinds(array $ids, string $repoName)
    {
        return $this->listRepo[$repoName]->finds($ids);
    }

    public function repoAll(string $repoName)
    {
        return $this->listRepo[$repoName]->all();
    }

    public function repoCreate(array $attributes, string $repoName)
    {
        return $this->listRepo[$repoName]->create($attributes);
    }

    public function repoCreateCreateFromRequest($request, string $repoName)
    {
        $attributes = $request->all();
        return $this->listRepo[$repoName]->create($attributes);
    }

    public function repoUpdate(int $id, array $attributes, string $repoName)
    {
        return $this->listRepo[$repoName]->update($id, $attributes);
    }

    public function repoUpdateFromRequest(int $id, $request, string $repoName)
    {
        $attributes = $request->all();
        return $this->listRepo[$repoName]->update($id, $attributes);
    }

    public function repoDelete(int $id, string $repoName): bool
    {
        return $this->listRepo[$repoName]->delete($id);
    }
}
