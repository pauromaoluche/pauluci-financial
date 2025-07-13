<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'active',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
