<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyCategory extends Model
{
    protected $table = 'company_categories';
    protected $fillable = ['title'];
    public $timestamps = true;

    public function companies()
    {
        return $this->hasMany(Company::class, 'category_id');
    }
}
