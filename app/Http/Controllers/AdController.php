<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Http\Requests\UpdateAdRequest;
use App\Builders\AttachmentBuilder;
use App\Http\Requests\AdsFormRequest;
use App\Http\Requests\StoreAdRequest;
use App\Models\Notification;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AdController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(  Ad::all() );
    }

    public function show(Ad $ad)
    {
        return response()->json($ad);
    }


    public function store(StoreAdRequest $request)
    {

         Ad::create([
            'name' => $request->name,
            'show' => json_decode($request->show),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            // 'user_id' =>  Auth::user()->id,
         //   'url'=> env('APP_URL').'/' .$request->file('url')->store('public/ads'),
            //     $imagePath = $image->store('public/uploads');
            'url' => env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
                $request,
                'ads',
                'url'
            ),
        ]);
        // if( $request->show ===1)
            // Notification::sendNotification('تم إضافة اعلان جديد' , 'تصفح التطبيق من فضلك.');

        return response()->json(['message' => 'insert success']);
    }

    public function update(UpdateAdRequest $request, Ad $ad)
    {

        $ad->update(
            [
                'name' => $request->input('name'),
                'show' =>  json_decode($request->show),
                'start_date' => $request->input('start_date'),
                'end_date' =>  $request->input('end_date'),
            ]
        );

        return response()->json( ['message' => 'update success']);
    }

    public function destroy(Ad $ad)
    {

        File::delete(public_path($ad->image_path));
        $ad->delete();
        return response()->json(['message' => 'delete success']);
    }

    public function searchAd($search_value)
    {
        $query =   Ad::where('show', $search_value)->orderBy('created_at')->paginate(10);
        return response()->json(
            $query,
        );
    }
}
