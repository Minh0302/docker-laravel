<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at'
    ];
    public $timestamps = false;
    protected $fillable = [
        'name', 'path', 'created_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'files';
}
