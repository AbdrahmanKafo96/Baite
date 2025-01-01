<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;
use App\Http\Requests\StoreSuperAdminRequest;
use App\Http\Requests\UpdateSuperAdminRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;
class SuperAdminController extends BaseController
{
    // public function __construct()
    // {
    //     $this->middleware('guest:admins')->except('logout');
    // }
    protected function guard()
    {
        return Auth::guard('admins');
    }
    public function logout()
    {
        if (auth()->user()) {
            $user = Auth:: user();
            $user->currentAccessToken()->delete();
            $user->save();
            return response()->json(['message' => 'Thank you for using our application']);
        }
        return response()->json([
            'error' => 'Unable to logout user',
            'code' => 401,
        ], 401);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function getUser()
    {
        if (auth()->check()) {
            $user = auth()->user();

            return response()->json($user);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = SuperAdmin::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        if (Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('admins')->user();
            $result['token'] =  $user->createToken('MyApp')->plainTextToken;
            $result['name'] =  $user->name;
            $result['success'] =  true;

            return $this->sendResponse( $result, 'User login successfully.');
        } else {
            $result['success'] =  false;
            return    $this->sendResponse($result , 'User login unsuccessfully.');
        }
    }
}
