<?php

namespace App\Http\Controllers;

use App\Services\NumberClassifierService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class NumberController extends Controller
{
    protected $numberClassifier;

    public function __construct(NumberClassifierService $numberClassifier)
    {
        $this->numberClassifier = $numberClassifier;
    }

    public function classify(Request $request)
    {
        // Validate input
        if (!$request->has('number') || !is_numeric($request->number) || floor($request->number) != $request->number) {
            return response()->json([
                'number' => $request->number,
                'error' => true
            ], 400);
        }

        $number = (int) $request->number;

        try {
            $result = $this->numberClassifier->classify($number);
            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'number' => $number,
                'error' => true
            ], 400);
        }
    }
}