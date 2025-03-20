<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Region\RegionResource;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index():JsonResponse
    {
        $data = Region::all();
        return response()->json(RegionResource::collection($data),200);
    }
}
