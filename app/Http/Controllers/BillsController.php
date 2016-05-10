<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
	
use App\Bill;
use Response;

class BillsController extends Controller
{
	public function index(){
	    $bills = Bill::all(); //Not a good idea

	    return Response::json([
        'message' => $bills
        ], 200);
	}

	public function show($id){
	    $bill = Bill::find($id);

        if(!$bill){
            return Response::json([
                'error' => [
                    'message' => 'bill does not exist'
                ]
            ], 404);
        }
 
        return Response::json([
                'data' => $bill
        ], 200);
	}

	public function store(Request $request)
    {
        if(! $request->bill_type or ! $request->month){
            return Response::json([
                'error' => [
                    'message' => 'Insert error: Please Provide bill_type and month'
                ]
            ], 422);
        }

        $bill = Bill::create($request->all());
 
        return Response::json([
                'message' => 'bill Created Succesfully',
                'data' => $bill
        ]); 
    }

	public function update(Request $request, $id)
	{    
        if(! $request->bill_type or ! $request->month){
            return Response::json([
                'error' => [
                    'message' => 'Update error: Please Provide bill_type and month'
                ]
            ], 422);
         }
	        
	    $bill = Bill::find($id);
	    $bill->bill_type = $request->bill_type;
	    $bill->month = $request->month;
	    $bill->amount = $request->amount;
	    $bill->save(); 
	 
	    return Response::json([
	        'message' => 'Bill Updated Succesfully'
	    ]);
	}

    public function destroy($id)
    {
	    $bill = Bill::find($id);

        if(!$bill)
        {
        	 return Response::json([
                'error' => [
                    'message' => 'Cannot find bill with id '.$id 
                ]
            ], 422);

        }

        Bill::destroy($id);
    
        return Response::json([
	        'message' => 'Bill Deleted Succesfully'
	    ]);
    }
}
