<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\NewContact;


class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data,[
            'name' => 'required',
            'address' => 'required|email',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()], 401);
        }
        $lead = new Lead();
        $lead->fill($data);
        $lead->save();
        Mail::to('admin@admi.com')->send(new NewContact($lead));
        return response()->json([
            'status' => 'success',
            'message' => 'ok'
        ], 200);
    }
}
