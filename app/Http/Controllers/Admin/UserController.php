<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\Admin\UserService;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    public function index()
    {
    	$users = $this->service->index();
        return view(getThemeView('user.list'))->with(compact('users'));
    }


    public function create()
    {
    	$result = $this->service->create();
        return view(getThemeView('user.create'))->with($result);
    }


    public function store(UserRequest $request)
    {
    	$this->service->store($request->all());
        return redirect()->route('user.index');
    }

    public function show($id)
    {
    	$result = $this->service->show($id);
        return view(getThemeView('user.show'))->with($result);
    }


    public function edit($id)
    {
    	$result = $this->service->edit($id);
        return view(getThemeView('user.edit'))->with($result);
    }


    public function update(UserRequest $request, $id)
    {
        $this->service->update($request->all(), $id);
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->route('user.index');
    }
}
