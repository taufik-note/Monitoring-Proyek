<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyeks';

    protected $fillable = [
        'nama_proyek',
        'deskripsi',
        'status',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
    ];
    
    public $timestamps = true;
}
