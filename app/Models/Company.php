<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = ['category_id', 'title', 'image', 'description', 'status'];
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(CompanyCategory::class, 'category_id');
    }
}
