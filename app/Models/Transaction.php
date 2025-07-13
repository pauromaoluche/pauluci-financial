<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_account_number',
        'recipient_account_number',
        'type_transaction_id',
        'amount',
        'status_transaction_id',
        'description',
        'error_message',
        'batch_id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function senderAccount()
    {
        return $this->belongsTo(Account::class, 'sender_account_number', 'account_number');
    }

    public function recipientAccount()
    {
        return $this->belongsTo(Account::class, 'recipient_account_number', 'account_number');
    }
    public function typeTransaction()
    {
        return $this->belongsTo(TypeTransaction::class);
    }

    public function statusTransaction()
    {
        return $this->belongsTo(StatusTransaction::class);
    }

    public function transactionStatusHistory()
    {
        return $this->hasMany(TransactionStatusHistory::class);
    }
}
