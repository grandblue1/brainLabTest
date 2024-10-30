<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserFormRequest;
use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->only('name', 'email', 'status');

        $users = User::query()->whereNot('email', Auth::user()->email)->filtered($query)->paginate(10);

        return view('admin.admin', compact('users', 'query'));
    }
    public function create() {

        return view('admin.create');
    }

    public function store(StoreUserFormRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('admin')->with('success', 'User Created Successfully! ');
    }

    public function edit(int $id) {
        $user = User::find($id);

        return view('admin.edit', compact('user'));
    }

    public function update(UpdateUserFormRequest $request, int $id) {

        $data = $request->validated();

        $user = User::find($id);

        $user->update($data);

        return redirect()->route('admin')->with('success', 'User: ' . $user->name . ' Updated Successfully! ');
    }
    public function delete($id)
    {
        $user = User::find($id);

        $user->delete();

        return back()->with('success', 'User Deleted Successfully! ');
    }

    public function filesystem()
    {
        return view('admin.filesystem');
    }
}
