<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LabelsController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\StyleLabelController;
use App\Http\Controllers\ColorLabelController;
use App\Http\Controllers\SizeLabelController;
use App\Http\Controllers\OptionsLabelController;
use App\Http\Controllers\ExtraLabelController;
use App\Http\Controllers\ProductsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Home
Route::group(['middleware' => ['admin']], function () {

// Inventory route

Route::get('/search', [ProductController::class, 'show'])->name('product.search.view');
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/updatestock', [ProductController::class, 'updateStockView'])->name('product.update.stock.view');
Route::post('/updatestock', [ProductController::class, 'updateStock'])->name('product.update.stock');
Route::get('/removestock', [ProductController::class, 'removeStockView'])->name('product.remove.stock.view');
Route::post('/removestock', [ProductController::class, 'removeStock'])->name('product.remove.stock');

// Label route

Route::get('/label', [LabelsController::class, 'index'])->name('label');
Route::get('/label/stylesdetails/{styles}', [LabelsController::class, 'stylesdetails'])->name('labels.stylesdetails');
Route::get('/label/colordetails/{color}', [LabelsController::class, 'colordetails'])->name('labels.colordetails');
Route::get('/label/sizedetails/{size}', [LabelsController::class, 'sizedetails'])->name('labels.sizedetails');
Route::get('/label/Optiondetails/{option}', [LabelsController::class, 'Optiondetails'])->name('labels.Optiondetails');
Route::get('/label/Extradetails/{extra}', [LabelsController::class, 'Extradetails'])->name('labels.Extradetails');

// Label print route

Route::get('/print', [PrintController::class, 'labeltemplate'])->name('print');

// Style route

Route::get('/stylelabel', [StyleLabelController::class, 'index'])->name('stylelabel.index');
Route::get('/stylelabel/search', [StyleLabelController::class, 'search'])->name('stylelabel.search');
Route::post('/stylelabel/update', [StyleLabelController::class, 'update'])->name('stylelabel.update');
Route::post('/stylelabel/add', [StyleLabelController::class, 'add'])->name('stylelabel.add');
Route::post('/stylelabel/delete', [StyleLabelController::class, 'delete'])->name('stylelabel.delete');
Route::post('/stylelabel/getstyle', [StyleLabelController::class, 'getStyle'])->name('stylelabel.getstyle');
Route::post('/stylelabel/updateprice', [StyleLabelController::class, 'updatePrice'])->name('stylelabel.updateprice');



// Color route

Route::get('/colorlabel', [ColorLabelController::class, 'index'])->name('colorlabel.index');
Route::get('/colorlabel/search', [ColorLabelController::class, 'search'])->name('colorlabel.search');
Route::post('/colorlabel/update', [ColorLabelController::class, 'update'])->name('colorlabel.update');
Route::post('/colorlabel/add', [ColorLabelController::class, 'add'])->name('colorlabel.add');
Route::post('/colorlabel/delete', [ColorLabelController::class, 'delete'])->name('colorlabel.delete');
Route::post('/colorlabel/getcolorID', [ColorLabelController::class, 'getcolorID'])->name('colorlabel.getcolorID');

// Sizes route

Route::get('/sizelabel', [SizeLabelController::class, 'index'])->name('sizelabel.index');
Route::get('/sizelabel/search', [SizeLabelController::class, 'search'])->name('sizelabel.search');
Route::post('/sizelabel/update', [SizeLabelController::class, 'update'])->name('sizelabel.update');
Route::post('/sizelabel/add', [SizeLabelController::class, 'add'])->name('sizelabel.add');
Route::post('/sizelabel/delete', [SizeLabelController::class, 'delete'])->name('sizelabel.delete');
Route::post('/sizelabel/getsizeID', [SizeLabelController::class, 'getsizeID'])->name('sizelabel.getsizeID');

// Options route
Route::get('/optionslabel', [OptionsLabelController::class, 'index'])->name('optionslabel.index');
Route::get('/optionslabel/search', [OptionsLabelController::class, 'search'])->name('optionslabel.search');
Route::post('/optionslabel/update', [OptionsLabelController::class, 'update'])->name('optionslabel.update');
Route::post('/optionslabel/add', [OptionsLabelController::class, 'add'])->name('optionslabel.add');
Route::post('/optionslabel/delete', [OptionsLabelController::class, 'delete'])->name('optionslabel.delete');
Route::post('/optionslabel/getoptionID', [OptionsLabelController::class, 'getoptionID'])->name('optionslabel.getoptionID');


// Extra route
Route::get('/extralabel', [ExtraLabelController::class, 'index'])->name('extralabel.index');
Route::get('/extralabel/search', [ExtraLabelController::class, 'search'])->name('extralabel.search');
Route::post('/extralabel/update', [ExtraLabelController::class, 'update'])->name('extralabel.update');
Route::post('/extralabel/add', [ExtraLabelController::class, 'add'])->name('extralabel.add');
Route::post('/extralabel/delete', [ExtraLabelController::class, 'delete'])->name('extralabel.delete');
Route::post('/extralabel/getextraID', [ExtraLabelController::class, 'getextraID'])->name('extralabel.getextraID');

});