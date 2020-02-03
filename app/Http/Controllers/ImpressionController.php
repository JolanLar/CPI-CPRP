<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;
use PDF;


class ImpressionController extends Controller
{
    public function init() {
        return view('myPDF');
    }

    public function testPdf() {

        $pdf = PDF::loadView('myPDF')->setPaper('a4', 'portrait');
        $filename = 'tutoderuru';
        return $pdf->stream($filename. '.pdf');
    }
}
