<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Transaction;
class TransactionController extends Controller
{
    public function getUserTransactionBalances($userId): JsonResponse
    {
        $initialBalance = 5.00;
        $transactions = Transaction::where('trans_user_id', $userId)
            ->orderBy('trans_plaid_date', 'asc')
            ->get();
        $runningBalance = $initialBalance;
        $result = [];
        foreach ($transactions as $transaction) { 
            $runningBalance += $transaction->trans_plaid_amount;
            $result[] = [
                'trans_id' => $transaction->trans_id,
                'trans_user_id' => $transaction->trans_user_id,
                'trans_plaid_amount' => $transaction->trans_plaid_amount,
                'trans_plaid_date' => $transaction->trans_plaid_date,
                'trans_plaid_name' => $transaction->trans_plaid_name,
                'trans_plaid_category_id' => $transaction->trans_plaid_category_id,
                'transaction_after_balance' => $runningBalance 
            ];
        }
        return response()->json($result);
    }
}
