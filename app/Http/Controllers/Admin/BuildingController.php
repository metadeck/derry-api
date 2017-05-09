<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\BuildingRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ConditionRepository;
use App\Repositories\StatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuildingController extends Controller
{
    /**
     * @var BuildingRepository
     */
    private $buildingRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var ConditionRepository
     */
    private $conditionRepository;

    /**
     * CourseController constructor.
     * @param BuildingRepository $buildingRepository
     * @param CategoryRepository $categoryRepository
     * @param StatusRepository $statusRepository
     * @param ConditionRepository $conditionRepository
     */
    public function __construct(
        BuildingRepository $buildingRepository,
        CategoryRepository $categoryRepository,
        ConditionRepository $conditionRepository)
    {
        $this->middleware('userIsAdmin');
        $this->buildingRepository = $buildingRepository;
        $this->categoryRepository = $categoryRepository;
        $this->conditionRepository = $conditionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.buildings.index', [
            'buildings' => $this->buildingRepository->query()->orderBy('created_at', 'DESC')->paginate(20),
            'categories' => $this->categoryRepository->formatSelectList(),
            'conditions' => $this->conditionRepository->formatSelectList(),
        ]);
    }

    public function search(Request $request)
    {
        return view('admin.buildings.index', [
            'buildings' => $this->buildingRepository->search($request->search),
            'categories' => $this->categoryRepository->formatSelectList(),
            'conditions' => $this->conditionRepository->formatSelectList(),
        ]);
    }

    /**
     * Details of the specified building
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('admin.buildings.show', [
            'building' => $this->buildingRepository->query()->findOrFail($id)
        ]);
    }

    /**
     * Show the create form for a building
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.buildings.create', [
            'categories' => $this->categoryRepository->formatSelect2List()
        ]);
    }

    /**
     * Show the edit form for a building
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.buildings.edit', [
            'building' => $this->buildingRepository->query()->findOrFail($id),
            'categories' => $this->categoryRepository->formatSelectList()
        ]);
    }
}
