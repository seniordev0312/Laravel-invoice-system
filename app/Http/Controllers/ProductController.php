<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
        public function showSearchView()
        {
            return view('search');
        }

        public function showAddProductsView()
        {
            return view('addproducts');
        }

        public function updateStockView()
        {
            $searchResults = session()->get('searchResults');

            return view('updatestock', ['searchResults' => $searchResults]);
        }

        public function removeStockView()
        {
            $searchResults = session()->get('searchResults');

            return view('removestock', ['searchResults' => $searchResults]);
        }

        public function show(Request $request)
        {
            $prodCode = $request->input('prodCode');
            $product = Product::where('ProdCode', $prodCode)->first();

            session()->flash('searchResults', [
                'product' => $product,
            ]);

            return view('search', ['product' => $product]);
        }

        public function showAddProductsSearch(Request $request)
        {
            // Get the product code and quantity from the request
            $prodCode = $request->input('prodCode');
            $qty = $request->input('qty');

            // Get the products from both databases
            $product = Product::where('ProdCode', $prodCode)->first();

            if ($product) {
                $qty = (int) $request->input('qty');
                $product->InStock += $qty;

                // save changes to database
                $product->save();

            }
        }

        public function updateStock(Request $request)
        {
            $prodCode = $request->input('prodCode');
            $qty = $request->input('qty');

            // Search in Database 1
            $product = DB::connection('mysql')
                ->table('product')
                ->where('ProdCode', $prodCode)
                ->first();

            if ($product) {
                // Update the InStock column in Database 1
                DB::connection('mysql')
                    ->table('product')
                    ->where('ProdCode', $prodCode)
                    ->increment('InStock', $qty);

                // Fetch the updated data from the database
                $product = Product::where('ProdCode', $prodCode)->first();

                // Pass the data to the view
                return view('updatestock', ['product' => $product]);
            }

            return redirect()->back();
        }

        public function removeStock(Request $request)
        {
            $prodCode = $request->input('prodCode');
            $qty = $request->input('qty');

            // Search in Database 1
            $product = DB::connection('mysql')
                ->table('product')
                ->where('ProdCode', $prodCode)
                ->first();

            if ($product) {
                // Remove the InStock column in Database 1
                DB::connection('mysql')
                    ->table('product')
                    ->where('ProdCode', $prodCode)
                    ->decrement('InStock', $qty);

                // Fetch the updated data from the database
                $product = Product::where('ProdCode', $prodCode)->first();

                // Pass the data to the view
                return view('removestock', ['product' => $product]);
            }

            return redirect()->back();
        }

        public function index()
        {
            $products = Product::all();
            return view('product-index', compact('products'));
        }

}

?>
