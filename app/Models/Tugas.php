<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan
    protected $table = 'tugas';

    // Tentukan kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama_tugas',
        'deskripsi',
        'deadline',
        'status',
        'proyek_id',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
    ];

    /**
     * Define a relationship with the Proyek model
     */
    public function proyek()
    {
        return $this->belongsTo(Proyek::class);
    }

    public $timestamps = true;
}
