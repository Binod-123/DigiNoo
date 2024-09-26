<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { include_once(database_path('seeders/transaction.php'));

        foreach ($transaction as $trans) {
            Transaction::create([
                'trans_id' => $trans['trans_id'],
                'trans_user_id' => $trans['trans_user_id'],
                'trans_plaid_trans_id' => $trans['trans_plaid_trans_id'],
                'trans_plaid_categories' => $trans['trans_plaid_categories'],
                'trans_plaid_amount' => $trans['trans_plaid_amount'],
                'trans_plaid_category_id' => $trans['trans_plaid_category_id'],
                'trans_plaid_date' => $trans['trans_plaid_date'],
                'trans_plaid_name' => $trans['trans_plaid_name'],
            ]);
        }
    }
}
