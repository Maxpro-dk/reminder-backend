<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Http\Resources\StatusResource;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return StatusResource::collection($statuses);
    }

    public function show(Status $status)
    {
        return new StatusResource($status);
    }
}