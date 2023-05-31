<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SizeLabelController extends Controller
{
    public function index()
    {
        $sizes = DB::table('sizes')->get();
        return view('sizelabel', ['sizes' => $sizes]);
    }

    public function search(Request $request)
    {
        $sizeID = DB::table('sizes')->where('sizeID', $request->sizeID)->first();
        return view('sizelabel', ['sizeID' => $sizeID]);
    }

    public function getSizeID(Request $request)
    {
        $sizeID = DB::table('sizes')->where('sizeID', $request->sizeID)->first();
        return response()->json($sizeID);
    }

    public function update(Request $request)
    {
        DB::table('sizes')->where('sizeID', $request->sizeID)->update([
            'sizeID' => $request->sizeID,
            'size' => $request->size,
        ]);
        return redirect()->back()->with('success', 'Size updated successfully.');
    }

    public function add(Request $request)
    {
        DB::table('sizes')->insert([
            'sizeID' => $request->sizeID,
            'size' => $request->size,
        ]);
        return redirect()->back()->with('success', 'New Size added successfully.');
    }

    public function delete(Request $request)
    {
        DB::table('sizes')->where('sizeID', $request->sizeID)->delete();
        return redirect()->back()->with('success', 'Selected Size deleted successfully.');
    }
}
