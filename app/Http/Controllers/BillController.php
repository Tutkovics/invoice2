<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Tag;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function deleteBill(Request $request, Bill $bill)
    {
        if( BillController::validateBillId($bill->id) ){
            $bill->delete();

            $bills = Bill::where('user_id', Auth::user()->id)->get();

            //return "Sikeres törlés user_id: ". Auth::user()->id;

            return redirect()->route('myBills');
        } else
            return redirect()->route('home');
    }

    public function showGraphs(Request $request){
        /*/$url = env('APP_URL').'/public/js/data.tsv';
        $url = public_path('js/data.tsv');

        $myfile = fopen($url, "r") or die("Unable to open file!");
        $txt = "John Doe\n";
        fwrite($myfile, $txt);
        $txt = "Jane Doe\n";
        fwrite($myfile, $txt);
        fclose($myfile);*/
        return view('graphs',['bill' => Bill::where('id',$request->id)->first() ]);
    }

    public function getNewBill(){
        return view('newBill');
    }

    public function postNewBill(Request $request){
        $this->validate($request, [
            'name' => 'required|max:120',
            'description' =>'required|min:1|max:2000'
        ]);

        $user_id = Auth::user()->id;

        $bill = new Bill;

        $bill->name = $request->name;
        $bill->description = $request->description;
        $bill->user_id = $user_id;

        $bill->save();

        return redirect()->route('myBills');
    }

    public function getBillData(Request $request){

        if( BillController::validateBillId($request->id) ){
            $bill = Bill::where('id', $request->id )->first();
            return view('showBill', ['bill' => $bill]);
        } else
            return redirect()->route('home');
    }

    public function showMyBills(){
        $user_id = Auth::user()->id;
        $bills = Bill::all()->where('user_id', $user_id);
        return view('dashboard', ['bills'=> $bills]);
    }

    public function getNewIncome(Request $request){
        if( BillController::validateBillId($request->id) ){
            $bill = Bill::where('id', $request->id )->first();
            $tags = Tag::all();

            return view('newIncome', ['bill_id' => $bill->id, 'tags' => $tags]);
        } else
            return redirect()->route('home');
    }

    public function getNewSpend(Request $request){
        if( BillController::validateBillId($request->id) ){
            $bill = Bill::where('id', $request->id )->first();

            $tags = Tag::all();

            return view('newSpend', ['bill_id' => $bill->id, 'tags' => $tags]);
        } else
            return redirect()->route('home');
    }

    public function postNewIncome(Request $request){
        $this->validate($request, [
            'from' => 'required|max:120',
            'amount' => 'required|min:1|max:120',
            'description' =>'required|min:1|max:2000'
        ]);

        if( BillController::validateBillId($request->id) ){

            $trans = new Transaction;

            $trans->bill_id = $request->id;
            $trans->income = true;
            $trans->amount = $request->amount;
            $trans->description = $request->description;
            $trans->from = $request->from;

            $trans->save();

            return redirect()->route('getBill', ['id' => $request->id] );
        } else
            return redirect()->route('home');
    }

    public function postNewSpend(Request $request){
        $this->validate($request, [
            'from' => 'required|max:120',
            'amount' => 'required|min:1|max:120',
            'description' =>'required|min:1|max:2000'
        ]);

        if( BillController::validateBillId($request->id) ){
            $trans = new Transaction;

            $trans->bill_id = $request->id;
            $trans->income = false;
            $trans->amount = $request->amount;
            $trans->description = $request->description;
            $trans->from = $request->from;

            $trans->save();

            return redirect()->route('getBill', ['id' => $request->id] );
        } else
            return redirect()->route('home');
    }

    public function validateBillId(  $id ){
        $bill = Bill::where('id', $id)->first();

        if( $bill == null || $bill->user_id != Auth::user()->id ){
            abort(404, 'Faszfej vagy full kretén vagy?!');
        } else
            return true;
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
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
