<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $imageFiles = glob(public_path('/storage/images/*'));
        $cssFiles = glob(public_path('/storage/css/*'));
        $jsFiles = glob(public_path('/storage/js/*'));
        $array_pastas = [$imageFiles, $cssFiles, $jsFiles];
        $urlsToCache = [];
        foreach ($array_pastas as $pasta) {
            foreach ($pasta as $file) {
                $relativePath = str_replace(public_path(), '', $file);
                $urlsToCache[] = $relativePath;
            }
        }
        return view('welcome', compact('urlsToCache'));
    }
}
