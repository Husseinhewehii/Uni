<?php

namespace App\Http\Controllers;

use App\repository\LogRepository;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    private $logRepository;

    /**
     * LogsController constructor.
     * @param LogRepository $logRepository
     */
    public function __construct(LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $list = $this->logRepository->search(request())->paginate(10);
        return view('logs.index', ['list' => $list]);
    }
}
