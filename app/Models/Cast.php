<?php namespace App\Models;


class Cast extends Base
{
    protected $table = 'casts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug'
    ];

    protected $visible = [
        //'id',
        'slug',
        'hash_id'
    ];

    protected $appends = [
        //'time',
        'hash_id'
    ];

    public function castable()
    {
        return $this->morphTo();
    }

    public function getTimeAttribute()
    {
        return $this->created_at->format('YmdHis');
    }

    public function getHashIdAttribute()
    {
        return encodeNumber($this->id);
    }

    public function getUrlAttribute() {
        return route('cast', $this->toArray());
    }
}
