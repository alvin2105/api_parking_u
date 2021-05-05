<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
  
    use HasFactory;

    protected $fillable = [
        'lahan_terpilih',
        'jenis_pembayaran',
        'status_pembayaran',
        'tarif',
        'waktu_booking'
        
    ];
}
