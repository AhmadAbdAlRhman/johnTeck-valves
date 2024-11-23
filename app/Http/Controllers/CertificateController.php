<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificates;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index(){
        $certificates = Certificates::all();
        return response()->json($certificates);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'image'=>'required|image|mimes:jpeg,png,gif,svg',
            'pdf'=>'required|mimes:pdf'
        ]);
        $requestData = $request->all();
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $pathImage = $request->file('image')->storeAs('Certificates/image', $imageName, 'public');
            $requestData['image'] = $imageName;
        }
        if ($request->hasFile('pdf')) {
            $pdfName = $request->file('pdf')->getClientOriginalName();
            $pathPdf = $request->file('pdf')->storeAs('Certificates/pdf', $pdfName, 'public');
            $requestData['pdf'] =  $pdfName;
        }
        $certificates = Certificates::create($requestData);
        return response()->json(['message' => 'Certificate created successfully', 'certificate' => $certificates], 201);
    }
    public function delete(Request $request){
        $id = $request->input('id');
        $certificates = Certificates::find($id);
        if (!$certificates) {
            return response()->json(['message' => 'Certificates not found'], 404);
        }
        $imagePath = Storage::disk('public')->path("Certificates/image/{$certificates->image}");
        $pdfPath = Storage::disk('public')->path("Certificates/pdf/{$certificates->pdf}");
        File::delete($imagePath);
        File::delete($pdfPath);
        $certificates->delete();
        return response()->json(['message' => 'Certificate deleted successfully'], 204);
    }

}
