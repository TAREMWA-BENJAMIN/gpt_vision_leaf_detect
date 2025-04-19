<?php

namespace App\Http\Controllers;

use App\Models\Subregion;
use App\Services\GeographicalService;
use Illuminate\Http\JsonResponse;

class SubregionController extends Controller
{
    protected GeographicalService $geographicalService;

    public function __construct(GeographicalService $geographicalService)
    {
        $this->geographicalService = $geographicalService;
    }

    /**
     * Get countries for a specific subregion
     */
    public function countries(Subregion $subregion): JsonResponse
    {
        $countries = $this->geographicalService->getCountriesBySubregion($subregion);
        return response()->json($countries);
    }
} 