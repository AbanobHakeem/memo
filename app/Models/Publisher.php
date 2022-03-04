<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = ['name', 'avatar', 'bio', 'active'];
    use HasFactory;

    public function getBioAttribute($value)
    {
    return base64_decode($value);
    }

    public function setBioAttribute($value)
    { 
        $this->attributes['bio'] = base64_encode($value);
    }


    //Scopes
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
    public function scopeSearch($query)
    {
        if (request()->has('search'))
            return $query->where('name', 'LIKE', '%' . request('search') . '%');
    }
    public function scopeOrdered($query)
    {
        return $query->orderBy('active', 'desc')->orderBy('id', 'asc');
    }
}
