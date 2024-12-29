<?php

namespace App\Http\Controllers;

use App\Models\myService;
use App\Http\Requests\StoremyServiceRequest;
use App\Http\Requests\UpdatemyServiceRequest;
use App\Builders\AttachmentBuilder;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MyServiceController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(

            data: MyService::orderBy('created_at')->paginate($request->limit)
        );
    }

    public function show(MyService $service)
    {
        return response()->json($service);
    }


    public function store(StoremyServiceRequest $request)
    {

        $service = MyService::create([
            'service_name' => $request->service_name,
            'description' => $request->description,
            'show' => $request->show,
            // 'user_id' =>  Auth::user()->id,
            'icon' => env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
                $request,
                'MyServices',
                'icon'
            ),
        ]);
        // if( $request->show ===1)
            // Notification::sendNotification('تم إضافة اعلان جديد' , 'تصفح التطبيق من فضلك.');

        return response()->json(['message' => 'insert success']);
    }

    public function update(UpdatemyServiceRequest $request, MyService $service)
    {

        $service->service_name = $request->service_name;
        $service->show = $request->show;
        $service->description = $request->description;

        $service->icon = env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
            $request,
            'myServices',
            'icon'
        );

        $service->save();

        return response()->json($service);
    }

    public function destroy(MyService $service)
    {

        File::delete(public_path($service->icon));
        $service->delete();
        return response()->json(['message' => 'delete success']);
    }

    public function search($search_value)
    {
        $query =   MyService::where('service_name', $search_value)->orderBy('created_at')->paginate(10);
        return response()->json(
            $query,
        );
    }
    function enableService(Request $request)
    {
        //$this->authorize('chnageCustomerActiveStatus', Customer::class);
        $user = MyService::find($request->id);
        $user->update(['show' => $request->is_active]);
        return response()->json(['message' =>
        'status was chnaged successfully']);
    }

}
