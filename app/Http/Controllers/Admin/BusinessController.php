<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\BusinessRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessController extends Controller
{
    /**
     * @var BusinessRepository
     */
    private $businessRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CourseController constructor.
     * @param BusinessRepository $businessRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        BusinessRepository $businessRepository,
        CategoryRepository $categoryRepository)
    {
        $this->middleware('userIsAdmin');
        $this->businessRepository = $businessRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.businesses.index', [
            'businesses' => $this->businessRepository->query()->orderBy('created_at', 'DESC')->paginate(20),
            'categories' => $this->categoryRepository->formatSelectList(),
        ]);
    }

    public function search(Request $request)
    {
        return view('admin.businesses.index', [
            'businesses' => $this->businessRepository->search($request->search),
            'categories' => $this->categoryRepository->formatSelectList(),
        ]);
    }

    /**
     * Details of the specified business
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('admin.businesses.show', [
            'business' => $this->businessRepository->query()->findOrFail($id)
        ]);
    }

    /**
     * Show the create form for a business
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.businesses.create', [
            'categories' => $this->categoryRepository->formatSelect2List()
        ]);
    }

    /**
     * Show the edit form for a business
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.businesses.edit', [
            'business' => $this->businessRepository->query()->findOrFail($id),
            'categories' => $this->categoryRepository->formatSelectList()
        ]);
    }
}
