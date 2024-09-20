<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Imagick;
use Illuminate\Support\Facades\Log;

class PdfController extends Controller
{
    public function convertPdfToImage(Request $request)
    {
        Log::info('convert: ', [$request->all()]);
        // Validate the request
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:2048', // Limit the size to 2MB
        ]);

        // Get the uploaded PDF file
        $pdf = $request->file('pdf');

        // Set up the image path and Imagick
        $pdfPath = $pdf->getRealPath();
        $imagePath = public_path('images/pdf_image.jpg'); // You can generate a dynamic file name as needed

        try {
            // Initialize Imagick for PDF
            $imagick = new Imagick();
            $imagick->setResolution(300, 300); // Higher resolution for better quality
            $imagick->readImage($pdfPath . '[0]'); // Read the first page of the PDF
            $imagick->setImageFormat('jpg');
            $imagick->writeImage($imagePath);
            $imagick->clear();
            $imagick->destroy();

            return response()->json([
                'message' => 'Image created successfully',
                'image_path' => asset('images/pdf_image.jpg'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to convert PDF to image: ' . $e->getMessage()], 500);
        }
    }
}
