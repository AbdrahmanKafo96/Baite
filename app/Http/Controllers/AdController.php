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


    public function store( Request $request)
    {

        $ad = Ad::create([
            'name' => $request->name,
            'show' => $request->show===true?1:0 ,
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

        $ad->name = $request->name;
        $ad->show = $request->show;
        $ad->start_date = $request->start_date;
        $ad->end_date = $request->end_date;
        $ad->url = $request->url;
        // $ad->url = env('APP_URL') . '/storage/' . AttachmentBuilder::storeOneFile(
        //     $request,
        //     'ads',
        //     'url'
        // );

        $ad->save();

        return response()->json($ad);
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
