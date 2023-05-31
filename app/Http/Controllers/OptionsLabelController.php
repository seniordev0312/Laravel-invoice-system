<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionsLabelController extends Controller
{
    public function index()
    {
        $options = DB::table('options')->get();
        return view('optionslabel', ['options' => $options]);
    }

    public function search(Request $request)
    {
        $optionID = DB::table('options')->where('optionID', $request->optionID)->first();
        return view('optionslabel', ['optionID' => $optionID]);
    }

    public function getOptionID(Request $request)
    {
        $optionID = DB::table('options')->where('optionID', $request->optionID)->first();
        return response()->json($optionID);
    }

    public function update(Request $request)
    {
        DB::table('options')->where('optionID', $request->optionID)->update([
            'optionID' => $request->sizeID,
            'option' => $request->size,
        ]);
        return redirect()->back()->with('success', 'Option updated successfully.');
    }

    public function add(Request $request)
    {
        DB::table('options')->insert([
            'optionID' => $request->sizeID,
            'option' => $request->size,
        ]);
        return redirect()->back()->with('success', 'New Option added successfully.');
    }

    public function delete(Request $request)
    {
        DB::table('options')->where('optionID', $request->optionID)->delete();
        return redirect()->back()->with('success', 'Selected Option deleted successfully.');
    }
}
