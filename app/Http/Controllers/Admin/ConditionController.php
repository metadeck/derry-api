<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ConditionRepository;

class ConditionController extends Controller
{
    /**
     * @var ConditionRepository
     */
    private $conditionRepository;

    /**
     * CourseController constructor.
     * @param ConditionRepository $conditionRepository
     */
    public function __construct(ConditionRepository $conditionRepository)
    {
        $this->middleware('userIsAdmin');
        $this->conditionRepository = $conditionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.conditions.index', [
            'conditions' => $this->conditionRepository->query()->orderBy('name')->paginate(20)
        ]);
    }

    /**
     * Show the create form for a condition
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.conditions.create');
    }

    /**
     * Show the edit form for a condition
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.conditions.edit', [
            'condition' => $this->conditionRepository->query()->findOrFail($id)
        ]);
    }
}
