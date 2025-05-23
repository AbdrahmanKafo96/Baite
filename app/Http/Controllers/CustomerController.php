<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Builders\AttachmentBuilder;
use App\Http\Requests\UsersFormRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;
class CustomerController extends BaseController
{
    public function index(Request $request)
    {
        $clients = Customer::paginate($request->limit);  // You can modify the number of items per page as needed

        // Prepare the response for DataTables
        return response()->json([
            'draw' => $request->input('draw'), // Required by DataTables
            'recordsTotal' => $clients->total(), // Total number of records
            'recordsFiltered' => $clients->total(), // Total filtered records
            'data' => $clients->items() // The actual employee data for the current page
        ]);
        // return response()->json(
        //     Customer::latest()->orderBy('is_trusted')->paginate($request->limit)
        // );
    }
    public function chnageSomeCustomerStatus(Request $request)
    {
        return response()->json(
            Customer::whereIn('id', $request->users)->update(['is_trusted' => $request->is_trusted])
        );
    }
    public function search($search_value)
    {
        $query =   Customer::where('name', 'like', '%' . $search_value . '%');
        return response()->json(
            $query->paginate(10),
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return response()->json(
            $customer,
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Customer $customer)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
    function chnageCustomerActiveStatus(Request $request)
    {
        //$this->authorize('chnageCustomerActiveStatus', Customer::class);
        $user = Customer::find($request->id);
        $user->update(['is_active' => $request->is_active]);
        return response()->json(['message' =>
        'status was chnaged successfully']);
    }

    function chnageCustomerTrustStatus(Request $request)
    {
       // $this->authorize('chnageCustomerTrustStatus', Customer::class);
        $user = Customer::find($request->id);
        $user->update(['is_trusted' => $request->is_trusted]);
        return response()->json(['message' =>
        'status was chnaged successfully']);
    }
    public function searchUser($search_value)
    {
        $query =   Customer::where('show', $search_value)->orderBy('created_at')->paginate(10);
        return response()->json(
            $query,
        );
    }
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
        $user = Customer::create($input);
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
}
