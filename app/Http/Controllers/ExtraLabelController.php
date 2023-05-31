<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtraLabelController extends Controller
{
    public function index()
    {
        $extras = DB::table('extras')->get();
        return view('extralabel', ['extras' => $extras]);
    }

    public function search(Request $request)
    {
        $extraID = DB::table('extras')->where('extraID', $request->extraID)->first();
        return view('extralabel', ['extraID' => $extraID]);
    }

    public function getExtraID(Request $request)
    {
        $extraID = DB::table('extras')->where('extraID', $request->extraID)->first();
        return response()->json($extraID);
    }

    public function update(Request $request)
    {
        DB::table('extras')->where('extraID', $request->extraID)->update([
            'extraID' => $request->extraID,
            'extra' => $request->extra,
        ]);
        return redirect()->back()->with('success', 'Extra updated successfully.');
    }

    public function add(Request $request)
    {
        DB::table('extras')->insert([
            'extraID' => $request->extraID,
            'extra' => $request->extra,
        ]);
        return redirect()->back()->with('success', 'New Extra added successfully.');
    }

    public function delete(Request $request)
    {
        DB::table('extras')->where('extraID', $request->extraID)->delete();
        return redirect()->back()->with('success', 'Selected Extra deleted successfully.');
    }
}
