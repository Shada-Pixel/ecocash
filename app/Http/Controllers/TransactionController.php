<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( Transaction::query())->addIndexColumn()
            ->make(true);
        }
        return view('transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
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
            // Saving requested transaction
            $transaction = new Transaction([
                'particular' => $request->particular,
                'amount' => $request->amount,
                'type' => $request->type,
                'category_id' => $request->category_id,
            ]);
            $transaction->save();
            return redirect()->route('dashboard')->with('success', 'Transaction Added.');
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

            // Saving initial handcash transaction
            $todatHandCashTransactionCreate = new Transaction([
                'particular' => 'Initial',
                'amount' => $todayHandCash,
                'type' => 4,
                'category_id' => 1,
            ]);
            $todatHandCashTransactionCreate->save();


            // Saving requested transaction
            $transaction = new Transaction([
                'particular' => $request->particular,
                'amount' => $request->amount,
                'type' => $request->type,
                'category_id' => $request->category_id,
            ]);

            $transaction->save();
            return redirect()->route('dashboard')->with('success', 'Transaction Added.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }



    /**
     * Display a listing of the resource.
     */
    public function cashTransactionToday(Request $request)
    {
        // Calculate the date range for today
        $todayStart = Carbon::today()->startOfDay();
        $todayEnd = Carbon::today()->endOfDay();


        return Datatables::of( Transaction::whereBetween('created_at', [$todayStart, $todayEnd])
            ->whereHas('category', function ($query) {
                $query->where('mode', 1);
            })->get())->addIndexColumn()->make(true);
    }

    /**
     * Display a listing of the resource.
     */
    public function expenseTransactionToday(Request $request)
    {
        // Calculate the date range for today
        $todayStart = Carbon::today()->startOfDay();
        $todayEnd = Carbon::today()->endOfDay();


        return Datatables::of( Transaction::whereBetween('created_at', [$todayStart, $todayEnd])
            ->whereHas('category', function ($query) {
                $query->where('mode', 2);
            })->get())->addIndexColumn()->make(true);
    }
}
