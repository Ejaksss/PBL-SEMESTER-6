<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $table = 'reservations';

    public $timestamps = true; 
    const UPDATED_AT = null; 

    protected $fillable = [
        'user_id',
        'nama_pelanggan',
        'nomor_wa',
        'jadwal_reservasi', // Diubah dari jam_mulai
        'id_service',
        'status'
    ];

    protected $casts = [
        // Pastikan casting menggunakan nama kolom yang baru
        'jadwal_reservasi' => 'datetime:Y-m-d H:i',
    ];

    /**
     * Relasi ke Tabel User
     * Setiap reservasi dimiliki oleh satu User (Pelanggan)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Tabel Service
     * Setiap reservasi merujuk pada satu jenis layanan
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'id_service');
    }
}