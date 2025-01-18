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


    public function store(StoremyServiceLevelOneRequest $request)
    {

        $service_level_one = myServiceLevelOne::create([
            'service_name' => $request->service_name,
            'description' => $request->description,
            'show' => $request->show,
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

    public function update(UpdatemyServiceLevelOneRequest $request, myServiceLevelOne $service_level_one)
    {

        $service_level_one->service_name = $request->service_name;
        $service_level_one->show = $request->show;
        $service_level_one->description = $request->description;
        $service_level_one->service_id = $request->service_id;
        $service_level_one->icon = env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
            $request,
            'myServiceLevelOnes',
            'icon'
        );

        $service_level_one->save();

        return response()->json($service_level_one);
    }

    public function destroy(myServiceLevelOne $service_level_one)
    {

        File::delete(public_path($service_level_one->icon));
        $service_level_one->delete();
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
