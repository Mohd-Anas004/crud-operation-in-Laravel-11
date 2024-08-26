<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudModel extends Model
{
    use HasFactory;
    protected $table = 'student';
    protected $primaryKey = 'id';
    public function setNameAttribute($key)
    {
        $this->attributes['name'] = ucwords($key);
    }
    public function setAddressAttribute($key)
    {
        $this->attributes['address'] = ucwords($key);
    }
    public function setQualificationAttribute($key)
    {
        $this->attributes['qualification'] = ucwords($key);
    }
}
