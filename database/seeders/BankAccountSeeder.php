<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         \App\Models\BankAccount::updateOrCreate(
        ['id' => 1], // لضمان عدم التكرار
        [
            'account_name' => 'Tala Ashraf Yousef AlTaweel',
            'bank_name' => 'Bank of Palestine',
            'swift_code' => 'PALPLUPS',
            'branch' => 'Gaza Main Branch',
            'city' => 'Gaza',
            'country' => 'Palestine 🇵🇸',
            'iban_usd' => 'PS66PALS045511463790013000000',
            'iban_ils' => 'PS51PALS045511463790993000000',
            'whatsapp_number' => '972568200088'
        ]
    );
    }
}
