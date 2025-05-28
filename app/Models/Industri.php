<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Industri extends Model
{
    use HasFactory;
    protected $table = 'industri';
    protected $fillable = ['nama', 'logo', 'bidang_usaha', 'alamat', 'kontak', 'email', 'website'];

    public function pkls()
    {
        return $this->hasMany(Rekrutpkl::class);
    }
}
