<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificates;
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
}
