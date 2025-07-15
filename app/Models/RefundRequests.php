<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefundRequests extends Model
{
    protected $fillable = [
        'transaction_id',
        'requester_account_number',
        'status_transaction_id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
