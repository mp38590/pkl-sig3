<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $primarykey = "objective_id";
    protected $table = "dokumen";
    protected $fillable =[
        'objective_id',
        'objective',
        'kebutuhan_dokumen',
        'deskripsi',
        'nama_dokumen',
        'format_file',
        'inserted_by',
        'updated_by'
    ];

    public function variabelPenilaian()
    {
        return $this->hasOne(VariabelPenilaian::class)->withTrashed(); // Contoh relasi one-to-one
    }

    public function realisasi()
    {
        return $this->hasOne(Realisasi::class)->withTrashed(); // Contoh relasi one-to-one
    }
    
    // use HasFactory;
}
