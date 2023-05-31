<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Picqer\Barcode\BarcodeGenerator;

class LabelsController extends Controller
{
    public function index()
    {
        $styles = DB::table('styles')->select('style', 'styleID', 'photoID')->get();
        $colors = DB::table('colors')->select('color', 'couleur', 'colorID')->get();
        $sizes = DB::table('sizes')->select('size', 'sizeID')->get();
        $Options = DB::table('options')->select('option', 'optionID')->get();
        $Extras = DB::table('extras')->select('extra', 'extraID')->get();

        return view('label', ['styles'=> $styles, 'colors' => $colors, 'sizes' => $sizes, 'Options'=> $Options, 'Extras'=> $Extras]);
    }

    public function stylesdetails($styles)
    {
        $decoded_styles = base64_decode($styles);
        $data = DB::table('styles')->where('style', $decoded_styles)->first();

        if ($data) {
            return response()->json([
                'style' => $data->style,
                'styleID' => $data->styleID,
                'photoID' => $data->photoID,
            ]);
        } else {
            return response()->json([
                'style' => '',
                'styleID' => '',
                'photoID' => '',
            ]);
        }
    }

    public function colordetails($color)
    {
        $decoded_color = base64_decode($color);
        $data = DB::table('color')->where('color', $decoded_color)->first();

        if ($data) {
            return response()->json([
                'color' => $data->color,
                'couleur' => $data->couleur,
                'colorID' => $data->colorID,
            ]);
        } else {
            return response()->json([
                'color' => '',
                'couleur' => '',
                'colorID' => '',
            ]);
        }
    }

    public function sizedetails($size)
    {
        $decoded_size = base64_decode($size);
        $data = DB::table('size')->where('size', $decoded_size)->first();

        if ($data) {
            return response()->json([
                'size' => $data->size,
                'sizeID' => $data->sizeID,
            ]);
        } else {
            return response()->json([
                'size' => '',
                'sizeID' => '',
            ]);
        }
    }

    public function Optiondetails($option)
    {
        $decoded_Options = base64_decode($option);
        $data = DB::table('options')->where('option', $decoded_Options)->first();

        if ($data) {
            return response()->json([
                'option' => $data->option,
                'optionID' => $data->optionID,
            ]);
        } else {
            return response()->json([
                'option' => '',
                'optionID' => '',
            ]);
        }
    }

    public function Extradetails($extra)
    {
        $decoded_Extra = base64_decode($extra);
        $data = DB::table('extra')->where('extra', $decoded_Extra)->first();

        if ($data) {
            return response()->json([
                'extra' => $data->extra,
                'extraID' => $data->extraID,
            ]);
        } else {
            return response()->json([
                'extra' => '',
                'extraID' => '',
            ]);
        }
    }

}
