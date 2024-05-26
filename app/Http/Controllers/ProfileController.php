<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function index()
    {
        return view('dashboard.profile.index', [
            'title' => 'My Profile'
        ]);
    }

    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'no_hp' => 'required|min:12|max:13',
            'address' => 'required',
            'tgl_lahir' => 'required',
            'img_profile' => 'image|file|max:2054'
        ]);

        if ($request->file('img_profile')) {
            $data['img_profile'] = $request->file('img_profile')->store('profile_users');
        }
        $data['user_id'] = auth()->user()->id;



        $profile = Profile::where('user_id', $id)->first();

        if (!$profile) {
            Profile::create($data);
        } else {
            if (!$profile) {
                return abort('404');
            }
            if ($request->file('img_profile')) {
                if ($profile->img_profile) {
                    Storage::delete($profile->img_profile);
                }
                $data['img_profile'] = $request->file('img_profile')->store('profile_users');
            }

            Profile::where('id', $profile->id)->update($data);
        }
        return redirect('/dashboard/profile')->with('message', 'Data profile berhasil diubah!');
    }

    public function updatepassword()
    {
        return view('dashboard.profile.updatepassword', [
            'title' => 'Change password'
        ]);
    }

    public function changepassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $currentPassword = $request->current_password;
        $newPassword = $request->new_password;


        if (!Hash::check($currentPassword, $user->password)) {
            return redirect('/dashboard/profile/changepassword')->with('alert-changepassword', '<div class="alert alert-light-danger alert-dismissible show fade">
            <i class="bi bi-exclamation-circle"></i>  Password tidak sama!
            <button type="button" class="btn-close border-0" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        } else {
            if ($newPassword == $currentPassword) {
                return redirect('/dashboard/profile/changepassword')->with('alert-changepassword', '<div class="alert alert-light-danger alert-dismissible show fade">
                <i class="bi bi-exclamation-circle"></i>  Password baru tidak boleh sama dengan password lama!
                <button type="button" class="btn-close border-0" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
            } else {
                $user->password = Hash::make($newPassword);
                $user->save();

                return redirect('/dashboard/profile/changepassword')->with('alert-changepassword', '<div class="alert alert-light-success alert-dismissible show fade">
                <i class="bi bi-exclamation-circle"></i> Password berhasil diubah!
                <button type="button" class="btn-close border-0" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
            }
        }
    }
}
