<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
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
}
