<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return response()->json($products);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'EnglishName' =>'required',
            'EnglishDescription' =>'required',
            'ArabicName' =>'required',
            'ArabicDescription' =>'required',
            'TurkishName' =>'required',
            'TurkishDescription' =>'required',
            'image'=>'nullable|image|mimes:jpeg,png,gif,svg',
            'pdf'=>'nullable|mimes:pdf'
        ]);
        $requestData = $request->all();
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $pathImage = $request->file('image')->storeAs('products/images', $imageName, 'public');
            $requestData['image'] = $imageName;
        }
        if ($request->hasFile('pdf')) {
            $pdfName = $request->file('pdf')->getClientOriginalName();
            $pathPdf = $request->file('pdf')->storeAs('products/pdfs', $pdfName, 'public');
            $requestData['pdf'] =  $pdfName;
        }
        $product = Product::create($requestData);
        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }
    public function search($nameProduct){
        $product = Product::where('EnglishName','LIKE','%'.Str::lower($nameProduct).'%')
                ->orWhere('ArabicName','LIKE','%'.Str::lower($nameProduct).'%')
                ->orWhere('TurkishName','%'.'LIKE',Str::lower($nameProduct).'%')
                ->orWhere('EnglishName','%'.'LIKE',Str::upper($nameProduct).'%')
                ->orWhere('ArabicName','%'.'LIKE',Str::upper($nameProduct).'%')
                ->orWhere('TurkishName','%'.'LIKE',Str::upper($nameProduct).'%')
                ->get();
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
    public function update($id, Request $request){
    }
    public function delete($id){
    }
    public function show($id){
    }
    public function loginAsAdminstrator(Request $request){
    }



}
