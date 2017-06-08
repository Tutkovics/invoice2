<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function test(Request $request)
    {
        return view('test');
    }
    public function deleteTransaction(Request $request, Transaction $transaction){
        if( $transaction->bill()->first()->user->id == Auth::user()->id){
            $bill_id = $transaction->bill->id;

            $transaction->delete();

            return redirect()->route('getBill', [
                'id' => $bill_id
            ]);
        } else
            abort(403, 'Ne faszkodj!');
    }

    public function showTransaction(Request $request, Transaction $transaction)
    {
        if( $transaction->bill()->first()->user->id == Auth::user()->id){
            $tags = Tag::all();

            return view('showTransaction', [
                'transaction' => $transaction,
                'tags' => $tags
            ]);
        } else
            abort(403, 'Ne faszkodj!');
    }

    public function editTransaction(Request $request, Transaction $transaction)
    {
        $this->validate($request, [
            'from' => 'required|max:120',
            'amount' => 'required|min:1|max:120',
            'description' => 'required|min:1|max:2000',
            'income' => 'boolean'
        ]);

        if( $transaction->bill()->first()->user->id == Auth::user()->id){
            Transaction::where('id', $transaction->id)
                        ->update([
                            'from' => $request->from,
                            'amount' => $request->amount,
                            'description' => $request->description,
                            'income' => $request->income
                        ]);

            return redirect()->route('getBill', [
                'id' => $transaction->bill->id
            ]);
        } else
            abort(403, 'Ne faszkodj!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
