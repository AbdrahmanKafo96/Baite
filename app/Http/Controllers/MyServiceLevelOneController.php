<?php

namespace App\Http\Controllers;

use App\Models\myServiceLevelOne;
use App\Http\Requests\StoremyServiceLevelOneRequest;
use App\Http\Requests\UpdatemyServiceLevelOneRequest;
use App\Builders\AttachmentBuilder;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyServiceLevelOneController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(

            data: myServiceLevelOne::all()
        );
    }

    public function show(myServiceLevelOne $service_level_one)
    {
        return response()->json($service_level_one);
    }


    public function store(Request $request)
    {

        $service_level_one = myServiceLevelOne::create([
            'service_name' => $request->service_name,
            'description' => $request->description,
            'show' => json_decode($request->show),
            'service_id' => $request->service_id,
            'icon' => env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
                $request,
                'myServiceLevelOnes',
                'icon'
            ),
        ]);
        // if( $request->show ===1)
        // Notification::sendNotification('تم إضافة اعلان جديد' , 'تصفح التطبيق من فضلك.');

        return response()->json(['message' => 'insert success']);
    }

    public function update(Request $request, myServiceLevelOne $services_level_one)
    {

        $services_level_one->service_name = $request->service_name;
        $services_level_one->show = json_decode($request->show);
        $services_level_one->description = $request->description;
        $services_level_one->service_id = $request->service_id;
        $services_level_one->icon = $request->icon;
        // $service_level_one->icon = env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
        //     $request,
        //     'myServiceLevelOnes',
        //     'icon'
        // );

        $services_level_one->save();

        return response()->json(['message' => 'update success']);
    }

    public function destroy(myServiceLevelOne $services_level_one)
    {
        File::delete(public_path($services_level_one->icon));
        $services_level_one->delete();
        return response()->json(['message' => 'delete success']);
    }

    public function search($search_value)
    {
        $query =   myServiceLevelOne::where('service_name', $search_value)->orderBy('created_at')->paginate(10);
        return response()->json(
            $query,
        );
    }

    function enableService(Request $request)
    {
        //$this->authorize('chnageCustomerActiveStatus', Customer::class);
        $user = myServiceLevelOne::find($request->id);
        $user->update(['show' => $request->is_active]);
        return response()->json(['message' =>
        'status was chnaged successfully']);
    }
}
