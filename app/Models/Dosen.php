<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $primaryKey = 'nik';

    protected $fillable =['nik','name','tanggal_lahir','email'];

    protected $keyType = 'string';

    public  $incrementing = false;

    public function mahasiswaWali(){
        return $this->hasMany(Mahasiswa::class);
    }

}

