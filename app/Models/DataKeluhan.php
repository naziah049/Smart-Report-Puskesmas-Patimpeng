<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataKeluhan extends Model
{
    use HasFactory;
    protected $table = 'data_keluhan';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function konsultasi(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'keluhan_id', 'id');
    }
}
