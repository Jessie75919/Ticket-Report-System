<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Requests\Bug\BugCreateRequest;
use App\Http\Requests\Bug\BugStatusRequest;
use App\Http\Requests\Bug\BugUpdateRequest;
use App\Http\Resources\BugResource;
use App\Models\Bug;
use App\Providers\RouteServiceProvider;
use App\Repos\Bug\BugRepo;
use App\Services\Bug\BugService;
use Illuminate\Support\Facades\Auth;

class BugController extends ApiController
{
    public function get(BugStatusRequest $request)
    {
        $repo = BugRepo::getRepo(Auth::user());
        return BugResource::collection($repo->search($request->status));
    }

    public function update(Bug $bug, BugUpdateRequest $request)
    {
        $bug = BugRepo::update($bug, $request->all());
        return new BugResource($bug);
    }

    public function delete(Bug $bug)
    {
        $bug->delete();
        return $this->respondSuccess();
    }

    public function mark(Bug $bug, BugStatusRequest $request, BugService $service)
    {
        $status = $request->status;

        if ($bug->status === $status ) {
            return $this->respondForbiddenError("this bug was in {$status} status");
        }

        $bug = $service->mark($bug, $status, Auth::id());

        return new BugResource($bug);
    }

    public function create(BugCreateRequest $request)
    {
        BugRepo::create($request->all(), Auth::id());
        return redirect(RouteServiceProvider::HOME);
    }
}
