<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Transaction;
class TransactionController extends Controller
{
    public function getUserTransactionBalances($userId)
    {
        $initialBalance = 5.00;
        $transactions = Transaction::where('trans_user_id', $userId)
            ->orderBy('trans_plaid_date', 'asc')
            ->get();
        $runningBalance = $initialBalance;
        $result = [];
        foreach ($transactions as $transaction) { 
            if ($transaction->trans_plaid_amount < 0) {
                $runningBalance += $transaction->trans_plaid_amount;
            } else {
                $runningBalance += $transaction->trans_plaid_amount;
            }
            $transactionAfterBalances[] = [
                'trans_id' => $transaction->trans_id,
                'trans_user_id' => $transaction->trans_user_id,
                'trans_plaid_date' => $transaction->trans_plaid_date,
                'transaction_after_balance' => $runningBalance 
            ];
        }
        return $transactionAfterBalances;
    }
   
    public function calculateBalances($userId)
    {
        $balances = $this->getUserTransactionBalances($userId);
        
        $dailyClosingBalances = [];

        foreach ($balances as $transaction) {
            $date = $transaction['trans_plaid_date'];
            $balance = $transaction['transaction_after_balance'];

            $dailyClosingBalances[$date] = $balance;  
        }

        ksort($dailyClosingBalances);  

        $closingBalances = array_slice($dailyClosingBalances, -90, null, true);
        //daily_closing_balances
        $totalBalance = array_sum($closingBalances);
            //90_days_average_balance
        $averageBalance = count($closingBalances) > 0 ? $totalBalance / count($closingBalances) : 0;
        //first_30_days_average
        $first30DaysAverage = $this->calculateAverage(array_slice($closingBalances, 0, 30));
        //last_30_days_average
        $last30DaysAverage = $this->calculateAverage(array_slice($closingBalances, -30));
        return response()->json([
            'daily_closing_balances' => $closingBalances,
            '90_days_average_balance' => $averageBalance,
            'first_30_days_average' => $first30DaysAverage,
            'last_30_days_average' => $last30DaysAverage,
        ]);
    }

    private function calculateAverage($balances)
    {
        $total = array_sum($balances);
        $count = count($balances);
        return $count > 0 ? $total / $count : 0;
    }

    public function calculateTransaction($userId)
    {
        $latestTransactionDate = Transaction::where('trans_user_id', $userId)
            ->orderBy('trans_plaid_date', 'desc')
            ->value('trans_plaid_date');

        if (!$latestTransactionDate) {
            return response()->json([
                'message' => 'No transactions found for this user.'
            ], 404);
        }
        $latestDate = new \DateTime($latestTransactionDate);
        $startDate = (clone $latestDate)->modify('-30 days');

        //last 30 days income except 18020004 this category id
        $last30DaysIncome = Transaction::where('trans_user_id', $userId)
            ->where('trans_plaid_category_id', '!=', 18020004)
            ->whereBetween('trans_plaid_date', [$startDate->format('Y-m-d'), $latestDate->format('Y-m-d')])
            ->sum('trans_plaid_amount');

        // Debit Transaction Count in Last 30 Days
        $debitTransactionCount = Transaction::where('trans_user_id', $userId)
            ->where('trans_type', 'debit')
            ->whereBetween('trans_plaid_date', [$startDate->format('Y-m-d'), $latestDate->format('Y-m-d')])
            ->count();

        //  Sum of Debit Transactions Done on 1=Sunday, 6=Friday, 7=Saturday
        $weekendDebitSum = Transaction::where('trans_user_id', $userId)
            ->where('trans_type', 'debit')
            ->whereBetween('trans_plaid_date', [$startDate->format('Y-m-d'), $latestDate->format('Y-m-d')])
            ->whereIn(\DB::raw('DAYOFWEEK(trans_plaid_date)'), [1, 7, 6]) // 
            ->sum('trans_plaid_amount');

        //  Sum of Income for Transactions with trans_plaid_amount > 15
        $incomeAbove15Sum = Transaction::where('trans_user_id', $userId)
            ->where('trans_plaid_amount', '>', 15)
            ->whereBetween('trans_plaid_date', [$startDate->format('Y-m-d'), $latestDate->format('Y-m-d')])
            ->sum('trans_plaid_amount');
            
        return response()->json([
            'start_date'=>$latestDate,
            'last_30_days_income' => $last30DaysIncome,
            'debit_transaction_count' => $debitTransactionCount,
            'weekend_debit_sum' => $weekendDebitSum,
            'income_above_15_sum' => $incomeAbove15Sum,
        ]);
    }


}
