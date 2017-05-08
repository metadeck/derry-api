<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected $paginationCount;
    protected $relations;

    public function __construct(Request $request){

        if($request->has('per_page')){
            $this->paginationCount = $request->input('per_page');
        }

        if($request->has('relations')){
            $relationString = $request->input('relations');
            $this->relations = explode(',', $relationString);
        }
    }
}