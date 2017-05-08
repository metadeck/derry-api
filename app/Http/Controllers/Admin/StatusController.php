<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\StatusRepository;

class StatusController extends Controller
{
    /**
     * @var StatusRepository
     */
    private $statusRepository;

    /**
     * CourseController constructor.
     * @param StatusRepository $statusRepository
     */
    public function __construct(StatusRepository $statusRepository)
    {
        $this->middleware('userIsAdmin');
        $this->statusRepository = $statusRepository;
    }

    /**
     * Display a listing of the statuses.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.statuses.index', [
            'statuses' => $this->statusRepository->query()->orderBy('name')->paginate(20)
        ]);
    }

    /**
     * Show the create form for a status
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.statuses.create');
    }

    /**
     * Show the edit form for a status
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.statuses.edit', [
            'status' => $this->statusRepository->query()->findOrFail($id)
        ]);
    }
}
