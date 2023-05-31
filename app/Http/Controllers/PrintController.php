<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function labeltemplate(Request $request)
    {
        // Retrieve the selected values from the request parameters
        $style = $request->input('style');
        $color = $request->input('color');
        $couleur = $request->input('couleur');
        $size = $request->input('size');
        $option = $request->input('option');
        $extra = $request->input('extra');
        $extra2 = $request->input('extra2');
        $photoID = $request->input('photoID');

        // Get the barcode data URL from the request parameters
        $barcodeValue = $request->input('barcode');

        return view('labeltemplate', [
            'style' => $request->style, // or $request->input('style')
            'selectedColor' => $color,
            'selectedCouleur' => $couleur,
            'selectedSize' => $size,
            'selectedOption' => $option,
            'selectedExtra' => $extra,
            'selectedExtra2' => $extra2,
            'selectedPhotoID' => $photoID,
            'barcodeValue' => $barcodeValue,
        ]);
    }
}
