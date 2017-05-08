<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Traits\SendsApiResponse;

class CategoryController extends BaseController {

    use SendsApiResponse;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * ApiCardController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Create a new category instance
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->only([
            'name'
        ]));

        return $this->sendResponse($category, "Category Successfully Created");
    }

    /**
     * Update a category
     *
     * @param UpdateCategoryRequest $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->update($request->only([
            'name'
        ]), $id);

        return $this->sendResponse($category, "Category Successfully Updated");
    }

}
