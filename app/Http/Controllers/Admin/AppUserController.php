<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppUserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * CourseController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('userIsAdmin');
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.appusers.index', [
            'app_users' => $this->userRepository->appUsers()->paginate(20)
        ]);
    }

    /**
     * Details of the specified user
     *
     * @param $user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($user_id)
    {
        return view('admin.appusers.show', [
            'app_user' => $this->userRepository->query()->findOrFail($user_id)
        ]);
    }
}
