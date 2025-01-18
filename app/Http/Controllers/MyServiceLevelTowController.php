<?php

namespace App\Http\Controllers;

use App\Models\myServiceLevelTow;
use App\Http\Requests\StoremyServiceLevelTowRequest;
use App\Http\Requests\UpdatemyServiceLevelTowRequest;
use App\Builders\AttachmentBuilder;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MyServiceLevelTowController extends Controller
{

    public function index(Request $request)
    {
        return response()->json(data: myServiceLevelTow::all());
    }

    public function show(myServiceLevelTow $service_level_tow)
    {
        return response()->json($service_level_tow);
    }


    public function store(StoremyServiceLevelTowRequest $request)
    {

         myServiceLevelTow::create([
            'service_name' => $request->service_name,
            'description' => $request->description,
            'show' => $request->show,
            'service_id' => $request->service_id,
            'cost' => $request->cost,
            'icon' => env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
                $request,
                'myServiceLevelTows',
                'icon'
            ),
            'image1_path' => env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
                $request,
                'myServiceLevelTow',
                "image1_path"
            ),
        ]);
        // if( $request->show ===1)
            // Notification::sendNotification('تم إضافة اعلان جديد' , 'تصفح التطبيق من فضلك.');

        return response()->json(['message' => 'insert success']);
    }

    public function update(UpdatemyServiceLevelTowRequest $request, myServiceLevelTow $service_level_tow)
    {

        $service_level_tow->service_name = $request->service_name;
        $service_level_tow->show = $request->show;
        $service_level_tow->description = $request->description;
        $service_level_tow->cost = $request->cost;
        $service_level_tow->show = $request->show;
        $service_level_tow->icon = env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
            $request,
            'myServiceLevelTows',
            'icon'
        );

        $service_level_tow->save();

        return response()->json($service_level_tow);
    }

    public function destroy(myServiceLevelTow $service_level_tow)
    {

        File::delete(public_path($service_level_tow->icon));
        $service_level_tow->delete();
        return response()->json(['message' => 'delete success']);
    }

    public function search($search_value)
    {

        $query =   myServiceLevelTow::where('service_name', $search_value)->orderBy('created_at')->paginate(10);
        return response()->json(
            $query,
        );
    }
    // function enableService(myServiceLevelTow $service_level_tow)
    // {
    //     //$this->authorize('chnageCustomerActiveStatus', Customer::class);
    //     $user = myServiceLevelTow::find($service_level_tow->id);
    //     $user->update(['show' => $service_level_tow->is_active]);
    //     return response()->json(['message' =>
    //     'status was chnaged successfully']);
    // }
}
