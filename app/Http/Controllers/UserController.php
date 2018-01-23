<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function admin_credential_rules(array $data)
    {
      $messages = [
        'current-password.required' => 'Silahkan masukkan password anda yang sekarang',
        'password.required' => 'Please enter password',
      ];

      $validator = Validator::make($data, [
        'current-password' => 'required',
        'password' => 'required|same:password',
        'password_confirmation' => 'required|same:password',
      ], $messages);

      return $validator;
    }

    public function postCredentials(Request $request)
    {
      if(Auth::Check())
      {
        $request_data = $request->All();
        $validator = $this->admin_credential_rules($request_data);
        if($validator->fails())
        {
          return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
        }
        else
        {
          $current_password = Auth::User()->password;
          if(Hash::check($request_data['current-password'], $current_password))
          {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request_data['password']);;
            $obj_user->save();

            session()->flash('oke','Password berhasil diubah.');

            return redirect('/profile');
          }
          else
          {
            $error = array('current-password' => 'Silahkan masukkan password anda yang sekarang');
            return response()->json(array('error' => $error), 400);
          }
        }
      }
      else
      {
        return redirect()->to('/');
      }
    }

    public function gantipass(){
      return view('profile.ubahpass');
    }
}
