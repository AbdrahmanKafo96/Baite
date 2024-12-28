<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;


use App\Http\Requests\UpdateUserRequest;
use App\Builders\AttachmentBuilder;
use App\Http\Requests\UsersFormRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;
class EmployeeController extends BaseController
{
    public function index(Request $request)
    {
        return response()->json(

            Employee::orderBy('created_at')->paginate($request->limit)
        );
    }

    public function show(Employee $User)
    {
        return response()->json($User);
    }


    public function store(StoreUserRequest $request)
    {
        $User = Employee::create([
            'name' => $request->name,
            'show' => $request->show,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' =>  Auth::user()->id,
            'url' => env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
                $request,
                'Users',
                'url'
            ),
        ]);
        // if( $request->show ===1)
            // Notification::sendNotification('تم إضافة اعلان جديد' , 'تصفح التطبيق من فضلك.');

        return response()->json(['message' => 'insert success']);
    }

    public function update(UpdateUserRequest $request, Employee $User)
    {

        $User->name = $request->name;
        $User->show = $request->show;
        $User->start_date = $request->start_date;
        $User->end_date = $request->end_date;
        $User->user_id =  Auth::user()->id;
        $User->url = $request->url;
        // $User->url = env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
        //     $request,
        //     'Users',
        //     'url'
        // );

        $User->save();

        return response()->json($User);
    }

    public function destroy(Employee $User)
    {

        // File::delete(public_path($User->image_path));
        $User->delete();
        return response()->json(['message' => 'delete success']);
    }

    public function searchUser($search_value)
    {
        $query =   Employee::where('show', $search_value)->orderBy('created_at')->paginate(10);
        return response()->json(
            $query,
        );
    }
    public function login(Request $request)
    {

        if (Auth::guard('emp_api')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('emp_api')->user();

            if ($user->is_active === 0)
                return response()->json(['message' => 'حساب المستخدم مغلق يرجاء التواصل مع الدعم!'], 401);

            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['is_active'] =  $user->is_active;
            $success['is_trusted'] =  $user->is_trusted;
            $success['email'] =  $user->email;
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
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = Employee::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
        $success['is_active'] = 1;
        $success['is_trusted'] = 0;
        $success['email'] =  $user->email;
        $success['id'] =  $user->id;


        return $this->sendResponse($success, 'User register successfully.');
    }
}
