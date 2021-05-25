<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BerandaController extends Controller
{
    /**
     * Show index view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.beranda');
    }

    /**
     * Edit admin password.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function edit_password(Request $request)
    {
        if ($request->post()) {
            $fields = $request->validate([
                'password' => ['required', 'string', 'min:4', 'confirmed']
            ]);

            $fields['password'] = Hash::make($fields['password']);
            $user = User::find(auth()->id());
            if ($user->update($fields)) {
                return redirect()->back()->with('flash_messages', [
                    'type' => 'success',
                    'message' => trans('passwords.success.update'),
                ]);
            }

            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('passwords.errors.update'),
            ]);
        }

        return view('admin.edit-password');
    }
}
