<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Auth;
use  App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

/**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
         return response()->json(['users' =>  User::all()], 200);
    }



    public function editUser(Request $request, $id){

        try{

           // echo '<pre>'; print_r('teste' + $request->name); exit;

            $user = User::findOrFail($id);
            $user->name = $request->name;
        


            if($user->save()){

                return response()->json(['status' => 'success', 'message'=> 'user edited success'],  201);

            }


          }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message'=> $e->getMessage()]);
          }

    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }

    }


}


