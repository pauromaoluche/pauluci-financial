<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    protected $fillable = [
        'user_id',
        'account_number',
        'balance',
        'active',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sentTransactions()
    {
        return $this->hasMany(Transaction::class, 'sender_account_number', 'account_number');
    }

        public function incomingTransactions()
    {
        return $this->hasMany(Transaction::class, 'recipient_account_number', 'account_number');
    }
}
