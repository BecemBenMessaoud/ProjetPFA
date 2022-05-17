<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->withCount('demands','givenArticles')->get();
        return view('admin.user.index', compact('users'));
    }

    public function delete($userId)
    {
        $user = User::query()->findOrFail($userId);

        $user->delete();

        return redirect()->to('/admin/users');
    }
}
