<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StyleLabelController extends Controller
{

    public function index()
    {
        $styles = DB::table('styles')->get();
        $categories = [];

        return view('stylelabel', ['styles' => $styles]);
    }


    public function search(Request $request)
    {
        $style = DB::table('styles')->where('style', $request->style)->first();
        return view('stylelabel', ['style' => $style]);
    }

    public function getStyle(Request $request)
    {
        $style = DB::table('styles')->where('style', $request->style)->first();


        return response()->json($style);
    }

    public function update(Request $request)
    {
        DB::table('styles')->where('style', $request->style)->update([
            'style' => $request->style,
            'description_fr' => $request->description_fr,
            'description_en' => $request->description_en,
            'price' => $request->price,
            'photoID' => $request->photo_id,
        ]);
        return redirect()->back()->with('success', 'Style updated successfully.');
    }

    public function add(Request $request)
    {
        $id = DB::table('styles')->insertGetId([
            'style' => $request->style,
            'description_fr' => $request->description_fr,
            'description_en' => $request->description_en,
            'price' => $request->price,
            'photoID' => $request->photo_id,
        ]);

        $styleID = sprintf('%05d',  $id);
        DB::table('styles')->where('id', $id)->update(['styleID' => $styleID]);

        return redirect()->back()->with('success', 'Style added successfully.');
    }



    public function delete(Request $request)
    {
        DB::table('styles')->where('style', $request->style)->delete();
        return redirect()->back()->with('success', 'Style deleted successfully.');
    }


    public function updatePrice(Request $request)
    {
        $style = $request->input('style');
        $price = $request->input('price');
        $styleID = $request->input('styleID');

        DB::table('styles')->where('style', $style)->update(['price' => $price]);
        DB::table('sc_shop_product')->where('upc', $styleID)->update(['price' => $price]);

        return response()->json(['success' => 'Price updated successfully.']);
    }
}
