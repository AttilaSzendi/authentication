<?php

namespace App\Http\Controllers;

use App\Http\Resources\RealEstateResource;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RealEstateIndexController extends Controller
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        return RealEstateResource::collection(RealEstate::all());
    }
}
