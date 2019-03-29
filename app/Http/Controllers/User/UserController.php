<?php

namespace App\Http\Controllers\User;

use App\Models\Cv;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin_login_form');
        }
        else {
            $users = User::paginate(User::PAGINATION);
            $admins = Admin::paginate(Admin::PAGINATION);
            return view('admin.user', compact('users','admins'));
        }
    }

    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->type = $request->type;
        $user->save();
        return redirect()->route('users.index')->with('message','You changed type of '.$user->name.' successful!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->cvs()->delete();
        $user->delete();
        return redirect()->route('users.index');
    }

    public function getChangePassword($id)
    {
        $user = User::findOrFail($id);
        if (Auth::guard('user')->check()) {
            return view('user.change_password', compact('user'));
        }
        else {
            return redirect()->route('user_login_form');
        }
    }

    public function patchChangePassword(ChangePasswordRequest $request,$id)
    {
        $user = User::findOrFail($id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->route('home')->with('message','You have successfully changed the password!');
        }
        else {

            return redirect()->route('user.change_password', $id)->with('message','You entered the wrong password!');

        }
    }
}
