<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Models\DepositSetting;
use App\Http\Controllers\Controller;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deposits = Transactions::where('remark','=','deposit')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.deposit.index', compact('deposits'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $status = $request->input('status');
        $depositData = Transactions::findOrFail($id);

        if($status == 'completed'){
            $user = User::findOrFail($depositData->user_id);

            $user->wallet += $depositData->amount;

            $bonusSetting = DepositSetting::where('status', 1)->first();
            if($bonusSetting){
                $bonusAmount = ($depositData->amount * $bonusSetting->bonus_percentage) / 100;
                $user->wallet += $bonusAmount;

                Transactions::create([
                    'user_id' => $user->id,
                    'amount' => $bonusAmount,
                    'remark' => 'deposit',
                    'type' => '+',
                    'details' => 'Deposit Bonus for TXN: '.$depositData->details,
                    'transaction_id' => 'BONUS-'.$depositData->transaction_id,
                    'status' => 'Completed'
                ]);
            }

            $user->save();

            $depositData->status = 'Completed';
            $depositData->save();

            cache()->flush();
            return back()->with('success', 'Deposit approved successfully');
        }

        $depositData->status = $status;
        $depositData->save();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
