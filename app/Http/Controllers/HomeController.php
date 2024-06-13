<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Dashboard to entry and show todays all entry.
     */
    public function dashboard(Request $request)
    {
        $cashCat = Category::where('mode', 1)->get();
        $expCat = Category::where('mode', 2)->get();
        // Calculate the date range for yesterday
        $yesterdayStart = Carbon::yesterday()->startOfDay();
        $yesterdayEnd = Carbon::yesterday()->endOfDay();
        // Calculate the date range for today
        $todayStart = Carbon::today()->startOfDay();
        $todayEnd = Carbon::today()->endOfDay();

        // Query the transactions table
        $todayHandCashTransaction = Transaction::whereBetween('created_at', [$todayStart, $todayEnd])
        ->where('type', 4)
        ->first();

        if ($todayHandCashTransaction) {
            $todayHandCash = $todayHandCashTransaction->amount;
        }else {
            // Yesterday initial handcash transaction
            $yesterdayHandCashTransaction = Transaction::whereBetween('created_at', [$yesterdayStart, $yesterdayEnd])
            ->where('type', 4)
            ->first();

            // Yesterday initial handcash
            if ($yesterdayHandCashTransaction) {
                $yesterdayHandCash = $yesterdayHandCashTransaction->amount;
            } else {
                $yesterdayHandCash = 0.00;
            }

            // Yesterday cash recived
            $yesterdayCashTotal = Transaction::whereBetween('created_at', [$yesterdayStart, $yesterdayEnd])
            ->whereHas('category', function ($query) {
                $query->where('mode', 1);
            })->sum('amount');

            // Yesterday expensed
            $yesterdayExpenseTotal = Transaction::whereBetween('created_at', [$yesterdayStart, $yesterdayEnd])
            ->whereHas('category', function ($query) {
                $query->where('mode', 2);
            })->sum('amount');

            // Today initial handcash
            $todayHandCash= $yesterdayCashTotal-$yesterdayExpenseTotal;
        }

        $todayCashTotal = Transaction::whereBetween('created_at', [$todayStart, $todayEnd])
        ->whereHas('category', function ($query) {
            $query->where('mode', 1);
        })->sum('amount');

        $todayExpenseTotal = Transaction::whereBetween('created_at', [$todayStart, $todayEnd])
        ->whereHas('category', function ($query) {
            $query->where('mode', 2);
        })->sum('amount');

        return view('dashboard',[
            'cashCat' => $cashCat,
            'expCat'=>$expCat,
            'todayHandCash' =>$todayHandCash,
            'todayCashTotal'=>$todayCashTotal,
            'todayExpenseTotal'=>$todayExpenseTotal
        ]);
    }
}
