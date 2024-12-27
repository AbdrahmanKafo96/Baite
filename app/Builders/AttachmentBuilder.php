<?php

namespace App\Builders;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;

class AttachmentBuilder extends Builder
{
    public static function store($user, string $attachmentable_type, $attachments): void
    {

        foreach ($attachments as $key => $attachment) {
            if (is_null($attachment)) continue;

            $oldAttachment = $user
                ->attachments()
                ->where('key', $key)
                ->where('attachmentable_type', $attachmentable_type)
                ->first();

            if ($oldAttachment) {
                Storage::delete($oldAttachment->path);
                $oldAttachment->delete();
            }
            $path = storage_path('private/services/kyc_form_attachments/' . $attachment->hashName());
            $user->attachments()->create([
                'attachmentable_type' => $attachmentable_type,
                'key' => $key,
                'path' => preg_replace("/^.*private\\//", "", $path),
            ]);
            Storage::putFileAs('private/services/kyc_form_attachments/',  $attachment, $attachment->hashName());
        }
    }
    public static function storeOneFile($request, $key, $colName): string
    {

        $file = $request->file($colName);
        // $path=storage_path('private/'.$key);
        // return $request->file($colName)->storeAs($key,  date('YmdHi').$file->getClientOriginalName(), 'public');
        //  return $[request->file($colName)->storeAs($key, $file->getClientOriginalName());
        return  Storage::disk('public')->put($colName, $file);
        //  $path=  public_path('private/'.$key).'/'. $file->getClientOriginalName();

        // return $file->getClientOriginalName();
    }
}
