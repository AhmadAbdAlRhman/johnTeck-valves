<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return response()->json($products);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'EnglishName' =>'required|string',
            'EnglishDescription' =>'required|string',
            'ArabicDescription' =>'nullable|string',
            'TurkishDescription' =>'nullable|string',
            'standard'=>'nullable|string',
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
                ->orWhere('EnglishName','%'.'LIKE',Str::upper($nameProduct).'%')
                ->get();
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
    public function update($id, Request $request){
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $validated = $request->validate([
            'EnglishName' =>'required|string',
            'EnglishDescription' =>'required|string',
            'ArabicDescription' =>'nullable|string',
            'TurkishDescription' =>'nullable|string',
            'standard'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpeg,png,gif,svg',
            'pdf'=>'nullable|mimes:pdf'
        ]);
        $requestData = $request->all();
        try{
            if ($request->hasFile('image')) {
                $oldImage = "products/images/{$product->image}";
                if(Storage::disk('public')->exists($oldImage))
                {
                    Storage::disk('public')->delete($oldImage);
                }
                $imageName = $request->file('image')->getClientOriginalName();
                $pathImage = $request->file('image')->storeAs('products/images', $imageName, 'public');
                $requestData['image'] = $imageName;
            }
            if ($request->hasFile('pdf')) {
                $oldPdf = Storage::disk('public')->path("products/pdfs/{$product->pdf}");
                if(Storage::disk('public')->exists($oldImage))
                {
                    Storage::disk('public')->delete($oldPdf);
                }
                $pdfName = $request->file('pdf')->getClientOriginalName();
                $pathPdf = $request->file('pdf')->storeAs('products/pdfs', $pdfName, 'public');
                $requestData['pdf'] =  $pdfName;
            }
            $product->fill($requestData);
            $product->save();
            return response()->json(['message' => 'Product updated successfully'], 204);
        }catch(Exception $e){
            return response()->json(['message' => 'Error updating product${}' . $e->getMessage()], 500);
         }

    }
    public function delete(Request $request){
        $id = $request->input('id');
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $imagePath = Storage::disk('public')->path("products/images/{$product->image}");
        $pdfPath = Storage::disk('public')->path("products/pdfs/{$product->pdf}");
        File::delete($imagePath);
        File::delete($pdfPath);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 204);
    }
    public function ShowById(Request $request){
        $validated = $request->validate([
            'id'=>'required'
        ]);
        $product = Product::where('id' , $request->id)->first();
        if (!$product){
            return response()->json(['message'=>'This product is not found']);
        }
        return response()->json($product);
    }
    public function loginAsAdminstrator(Request $request){
        $adminPassword = env('ADMIN_PASSWORD');
        $validated = $request->validate
        ([
            'password'=>'required'
        ]);;
        $inputPassword = $request->password;
        if(!Hash::check($inputPassword, $adminPassword)){
            return response()->json(['message'=>'Invalid password'],401);
        }
        $token = base64_encode(uniqid());
        return response()->json(['token'=>$token],200);
    }

}
