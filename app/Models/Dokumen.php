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
        'item_penilaian',
        'deskripsi_item_penilaian',
        'nama_dokumen',
        'format_file',
        'inserted_by',
        'updated_by',
        'flag_delete'
    ];
    // use HasFactory;
}
