<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Str;
use App\Models\Base;

/**
 * trait Filterable
 * @package App
 * @method static EloquentBuilder filter(array $param)
 * @method static Base paginateFilter(Request $request, $perPage = 15)
 */

trait FilterTrait {

    public function scopeFilter(EloquentBuilder $query, $param)
    {
        foreach ($param as $field => $value) {
            $method = 'filter' . Str::studly($field);

            if ($value === '') {
                continue;
            }

            if (method_exists($this, $method)) {
                $this->{$method}($query, $value);
                continue;
            }

            if (empty($this->filterable) || !is_array($this->filterable)) {
                continue;
            }

            if (in_array($field, $this->filterable)) {
                $query->where($this->table . '.' . $field, $value);
                continue;
            }

            if (key_exists($field, $this->filterable)) {
                $query->where($this->table . '.' . $this->filterable[$field], $value);
                continue;
            }
        }

        return $query;
    }

    public function scopePaginateFilter(EloquentBuilder $query, Request $request, $perPage = 15)
    {
        $param = $request->all();
        return $this->scopeFilter($query, $param)->paginate($perPage)->withQueryString();
    }
}
