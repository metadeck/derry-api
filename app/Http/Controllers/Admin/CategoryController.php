<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CourseController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('userIsAdmin');
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => $this->categoryRepository->topLevelCategories()
        ]);
    }

    /**
     * Details of the specified category
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('admin.categories.show', [
            'category' => $this->categoryRepository->query()->findOrFail($id)
        ]);
    }

    /**
     * Show the create form for a category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Show the edit form for a category
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.categories.edit', [
            'category' => $this->categoryRepository->query()->findOrFail($id)
        ]);
    }
}
