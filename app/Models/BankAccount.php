<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'account_name', 'bank_name', 'swift_code', 
        'branch', 'country', 'city', 
        'iban_usd', 'iban_ils', 'whatsapp_number'
    ];
}