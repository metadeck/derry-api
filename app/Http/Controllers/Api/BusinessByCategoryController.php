<?php

namespace App\Http\Controllers\Api;

use App\Repositories\CategoryRepository;
use App\Traits\SendsApiResponse;
use Illuminate\Http\Request;

class BusinessByCategoryController extends BaseController {

    use SendsApiResponse;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
    * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show a listing of businesses by category ids
     * URL should have the form of ?category_ids[]=6&category_ids[]=4
     *
     * @param Request $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function index(Request $request)
    {
        $category_ids = $request['category_ids'];

        $businesss = $this->categoryRepository->businessesByCategoryIds($category_ids);
        return $this->sendResponse($businesss, 'Businesses retrieved successfully');
    }

}