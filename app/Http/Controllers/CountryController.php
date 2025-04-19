<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\GeographicalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected GeographicalService $geographicalService;

    public function __construct(GeographicalService $geographicalService)
    {
        $this->geographicalService = $geographicalService;
    }

    /**
     * Get all countries with optional filters
     */
    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['region_id', 'subregion_id']);
        $countries = $this->geographicalService->getCountries($filters);
        return response()->json($countries);
    }

    /**
     * Get districts for a specific country
     */
    public function districts(Country $country): JsonResponse
    {
        $districts = $this->geographicalService->getDistrictsByCountry($country);
        return response()->json($districts);
    }
} 