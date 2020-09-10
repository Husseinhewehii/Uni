<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddImageRequest;
use App\Http\Services\UploaderService;
use App\Http\Services\UserServices;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\File;


class UserGalleryController extends Controller
{
    private $userServices;
    private $uploaderService;

    public function __construct(UserServices $userServices, UploaderService $uploaderService)
    {
        $this->userServices = $userServices;
        $this->uploaderService = $uploaderService;
    }

    public function index(User $user)
    {
        $gallery = $user->gallery;
        return view('users.gallery.index',['user'=>$user,'gallery'=>$gallery]);
    }

    public function create(User $user)
    {
        return view('users.gallery.create',['user'=>$user]);
    }

    public function store(AddImageRequest $request, User $user)
    {
        $this->userServices->addImage($request, $user);
        return redirect(route('user.gallery.index',['user'=>$user]))->with('success','An Image Has Just Been Added');
    }

    public function destroy(User $user, Gallery $gallery)
    {
        $this->uploaderService->deleteFile($gallery->image);
        $gallery->delete();

        return redirect()->back()->with('danger','The Image Has Just Been Deleted');
    }
}
