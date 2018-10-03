<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users as UsersModel;
use Compolomus\Compomage\Image;

class Users extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show user's profile page
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        // fetching the user model
        $user = \Auth::user();
        return view('profile', ['user' => $user]);
    }

    /**
     * Update user's profile
     *
     * @param   Request $request
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $id = \Auth::user()->id;
        // fetching the user model
        $user = UsersModel::find($id);

        if (null === $user) {
            return back();
        }

        // Validate request/input
        $this->validate($request, [
            'name' => 'required|max:255|unique:users,name,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);

        // storing the input fields name & email in variable $input, type array
        $input = $request->only('name', 'email', 'avatar');

        // Accessing the update method and passing in $input array of data
        $user->name = $input['name'];
        $user->email = $input['email'];

        // Save file to local public storage
        $file = $request->file('avatar');
        if (null !== $file) {
            // Set path of avatar
            $user->avatar = $file->store('public');
        }

        $user->save();

        // after everything is done return them pack to /profile/ uri
        return back();
    }
}
