<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhmucmon extends Model
{
    use HasFactory;
    protected $table = 'danhmucmon';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
    