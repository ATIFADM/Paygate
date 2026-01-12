<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Added for user relationship

class Invoice extends Model
{
    protected $fillable = [
        'user_id', // Added for user relationship
        'invoice_number',
        'client_name',
        'client_email',
        'client_phone',
        'client_address',
        'company_name',
        'service_description',
        'amount',
        'currency',
        'status',
        'stripe_session_id',
        'stripe_payment_intent',
        'paid_at',
        'tax_amount',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
