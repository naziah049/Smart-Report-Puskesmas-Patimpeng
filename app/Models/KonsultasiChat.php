<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsultasiChat extends Model
{
    use HasFactory;
    protected $table = 'konsultasi_chat';
    protected $guarded = ['id'];
}
