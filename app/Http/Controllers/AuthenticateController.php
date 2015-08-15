<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class AuthenticateController extends Controller
{


    public function __construct()
    {
        //Apply the jwt.auth middleware to all methods in this controller
        //except for the authenticate method. We don't want to prevent
        //the user from receiving their token if they don't already have it

        //If we try making a get request to /api/authenticate without a JWT in
        // a header or url parameter, we get a 400 error that says no_token_provided

        $this->middleware('jwt.auth', ['except' => ['authenticate']]);

    }

    /**
     * Determine if user is authenticate by locating token
     */
    public function getAuthenticatedUser()
    {
        try {

            if( ! $user = JWTAuth::parseToken()->authenticate() ){

                return response()->json(['user_not_found'], 404);
            }
            
        } catch ( TokenExpiredException $e ) {

            return response()->json(['token_expired']. $e->getStatusCode());
            
        } catch ( TokenInvalidException $e ){

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch ( JWTException $e ) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        //The token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //Retrieve all the users in the database and return them
        $users = User::all();

        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    public function authenticate( Request $request )
    {
        $credentials = $request->only('email', 'password');

        try {
            //Verify credentials and create token for user
            if(! $token = JWTAuth::attempt( $credentials )){

                return response()->json(['error' => 'invalid credentials'], 401);
            }



        } catch (JWTException $e) {
            //something went wrong
            return response()->json(['error' => 'could not create token'], 500);
            
        }

        //If not errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }
}
