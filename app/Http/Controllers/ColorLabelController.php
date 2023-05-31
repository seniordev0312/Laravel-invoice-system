<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorLabelController extends Controller
{
    public function index()
    {
        $colors = DB::table('colors')->get();
        return view('colorlabel', ['colors' => $colors]);
    }

    public function search(Request $request)
    {
        $colorID = DB::table('colors')->where('colorID', $request->colorID)->first();
        return view('colorlabel', ['colorID' => $colorID]);
    }

    public function getColorID(Request $request)
    {
        $colorID = DB::table('colors')->where('colorID', $request->colorID)->first();
        return response()->json($colorID);
    }

    public function update(Request $request)
    {
        DB::table('colors')->where('colorID', $request->colorID)->update([
            'colorID' => $request->colorID,
            'color' => $request->color,
            'couleur' => $request->couleur
        ]);
        return redirect()->back()->with('success', 'Color updated successfully.');
    }

    public function add(Request $request)
    {
        DB::table('colors')->insert([
            'colorID' => $request->colorID,
            'color' => $request->color,
            'couleur' => $request->couleur
        ]);
        return redirect()->back()->with('success', 'New Color added successfully.');
    }

    public function delete(Request $request)
    {
        DB::table('colors')->where('colorID', $request->colorID)->delete();
        return redirect()->back()->with('success', 'Selected Color deleted successfully.');
    }
}
