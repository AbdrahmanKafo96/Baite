<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;
class UserController extends BaseController
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $service)
    {
        //
    }
    public function logout()
    {
        if (auth()->user()) {
            $user = auth()->user();
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
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
        $success['is_active'] = 1;
        $success['is_trusted'] = 0;
        $success['email'] =  $user->email;
        $success['phone_number'] =  $user->phone_number;
        $success['id'] =  $user->id;
        $success['location'] =  $user->location;


        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        if (Auth::guard('client_api')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('client_api')->user();

            if ($user->is_active === 0)
                return response()->json(['message' => 'حساب المستخدم مغلق يرجاء التواصل مع الدعم!'], 401);

            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['is_active'] =  $user->is_active;
            $success['is_trusted'] =  $user->is_trusted;
            $success['email'] =  $user->email;
            $success['phone_number'] =  $user->phone_number;
            $success['location'] =  $user->location;
            $success['id'] =  $user->id;


            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return response()->json(['message' =>  'تحقق من البريد الالكتروني او كلمة المرور'], 401);
        }
    }
}
