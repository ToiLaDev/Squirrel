<?php

namespace App\Repositories;

abstract class Repository implements RepositoryImpl
{

    protected $_model;

    public function filter(array $attributes): array
    {
        $count = empty($attributes['count'])?10:$attributes['count'];
        $page = empty($attributes['page'])?1:$attributes['page'];
        $offset = $count * ($page - 1);
        $total = -1;

        $query = $this->_model->where(function ($q) use ($attributes) {
            if (isset($attributes['filter'])) {
                foreach ($attributes['filter'] as $key => $filter) {
                    if ($key == 'status') {
                        $q->where('status', filter_var($filter, FILTER_VALIDATE_BOOLEAN));
                    } else {
                        $q->where($key, 'like', "%$filter%");
                    }
                }
            }
        });
        if (isset($attributes['sorting'])) {
            foreach ($attributes['sorting'] as $key => $val) {
                $query->orderBy($key, $val);
            }
        }
        if($count != -1) {
            $query->limit($count)
                ->offset($offset)
            ;
            $total = $this->_model->where(function ($q) use ($attributes) {
                if (isset($attributes['filter'])) {
                    foreach ($attributes['filter'] as $key => $filter) {
                        if ($key == 'status') {
                            $q->where('status', filter_var($filter, FILTER_VALIDATE_BOOLEAN));
                        } else {
                            $q->where($key, 'like', "%$filter%");
                        }
                    }
                }
            })->count();
        }

        return [$query->get(), $total];
    }

    public function all()
    {
        return $this->_model->all();
    }

    public function model()
    {
        return $this->_model;
    }

    public function count(): int
    {
        return $this->_model->count('id');
    }

    public function find($id)
    {
        return $this->_model->find($id);
    }

    public function finds($ids)
    {
        return $this->_model->whereIn('id', $ids)->get();
    }

    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    public function insert(array $attributes)
    {
        return $this->_model->insert($attributes);
    }

    public function update(int $id, array $attributes)
    {
        $model = $this->find($id);
        if($model) {
            if (isset($attributes['toggleStatus'])) {
                $attributes = [
                    'status' => $attributes['status']
                ];
            }

            $model->update($attributes);
        }
        return $model;
    }

    public function updateWithExtend(int $id, array $attributes)
    {
        $model = $this->find($id);
        if($model) {
            foreach ($attributes as $key => $value) {
                $model->{$key} = $value;
            }
            $model->save();
        }
        return $model;
    }

    public function delete($id): bool
    {
        $result = $this->find($id);
        if($result) {
            $result->delete();
            return true;
        }

        return false;
    }

    public function newQuery() : \Illuminate\Database\Eloquent\Builder
    {
        return $this->_model->newQuery();
    }

    public function firstOrCreate($wheres, $attributes = null) {
        return $this->_model->firstOrCreate($wheres, $attributes);
    }

    public function updateOrCreate($wheres, $attributes = null) {
        return $this->_model->updateOrCreate($wheres, $attributes);
    }
}
