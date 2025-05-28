<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Guru extends Model
{
   use HasFactory;

    protected $table = 'guru';
    protected $fillable = [ 'nama', 'nip', 'email', 'gender', 'kontak', 'avatar', 'alamat'];
    protected $guard_name = 'teacher';


    public function pkls()
    {
        return $this->hasMany(Rekrutpkl::class);
    }
}