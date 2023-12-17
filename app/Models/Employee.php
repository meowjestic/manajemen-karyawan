<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    public $timestamp = true;
    
    protected $fillable = ['id','uuid','nama_lengkap','email','tempat_lahir', 'tanggal_lahir','url_foto','domisili','pekerjaan','jabatan','gaji','divisi_id','pendidikan_terakhir','tanggal_bergabung','user_id','tempat_tinggal'];






    
    /**
     * Get the user associated with the 2023_12_12_093421_create_employees_table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function division(): HasOne
    {
        return $this->hasOne(Division::class, 'id', 'division_id');
    }
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
