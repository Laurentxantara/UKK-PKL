<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Siswa extends Model
{
    use HasFactory;   

    protected $table = 'siswa';
    protected $fillable = [ 'nama', 'nis', 'email', 'gender', 'kontak', 'avatar', 'alamat', 'status_pkl'];
    protected $guard_name = 'student';

     public function pkl()
    {
        return $this->hasOne(Rekrutpkl::class, 'id_siswa'); 
    }
}