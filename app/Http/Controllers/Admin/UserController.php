<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'pembeli');

        // Fitur search (nama atau email)
        if (!empty($request->search)) {
            $query->where('username', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%");
        }

        $users = $query->latest()->get();
        $totalUsers = User::where('role', 'pembeli')->count();
        $newUsers = User::where('role', 'pembeli')->whereDate('created_at', today())->count();

        return view('admin.users.index', compact('users', 'totalUsers', 'newUsers'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data pembeli berhasil dihapus.');
    }
}
