<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $fillable = ['isi', 'cerita_id', 'user_id'];
    public function cerita()
    {
        return $this->belongsTo(Cerita::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
