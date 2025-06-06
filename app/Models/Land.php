<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_name',
        'kode_bidang',
        'alamat',
        'desa_kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'latitude',
        'longitude',
        'luas_m2',
        'status',
        'dokumen_path',
        'dokumen_expiry',
        'photo_path',
        'created_by',
    ];

    protected $casts = [
        'dokumen_expiry' => 'date',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // Relasi ke user yang membuat data
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
