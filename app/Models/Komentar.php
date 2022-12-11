<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    
    protected $table = 'komentar';
    protected $fillable = [
        'id_user',
        'id_buku',
        'comment'
    ];
    
    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
