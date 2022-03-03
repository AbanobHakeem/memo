<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['prefix', 'name', 'script', 'native', 'regional', 'dir', 'active', 'default'];
    use HasFactory;

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
        return $query->orderBy('default', 'desc')->orderBy('active', 'desc')->orderBy('id', 'asc');
    }
}
