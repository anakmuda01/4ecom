<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
      $profile = Profile::where('user_id', Auth::user()->id)->first();

      return view('profile.show',['profile'=>$profile]);
    }


    public function show($id)
    {
         return redirect('/profile');
    }

    public function create()
    {
        return view('profile.input');
    }

    public function edit($id)
    {
      $profile = Profile::findOrFail($id);
      if($profile->isOwner())
        return view('profile.input',compact('profile'));
      abort(404);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'nama' => 'required|min:4|max:100',
        'no_telpon' => 'required|min:7',
        'alamat' => 'required|max:1000',
      ]);

      $profile = Profile::findOrFail($id);
      if($profile->isOwner())
        $profile->update([
          'nama_user' => $request->nama,
          'no_telpon' => $request->no_telpon,
          'alamat_user' => $request->alamat,
        ]);
      else abort(403);

      return redirect('/profile')->with('msg','Berhasil disimpan');
    }
}
