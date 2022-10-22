<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessMedia;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Tags\Tag;

class UploadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param mixed|string $profile
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, mixed $profile = NULL)
    {
        $request->validate([
            'asset' => 'required|mimes:png,jpg,jpeg|max:4096'
        ]);

        $asset = new Asset;

        $asset->filename = $request->filename ?? time() .'.'. $request->asset->extension();
        $asset->asset_id = Str::uuid();
        $asset->file_ext = $request->asset->extension();
        $asset->storage = "public";
        $asset->path = 'public';
        $asset->user()->associate(Auth::user());
        $asset->mime_type = $request->asset->getMimeType();
        $asset->filesize = $request->asset->getSize();
        $path = $request->asset->storePubliclyAs($asset->path, $asset->filename);
        $asset->path = Storage::url($path);
        //$asset->url = Storage::url($path);
        // Public Folder
        //$request->asset->move(public_path('public'), $path);
        $asset->save();
        if(isset($request->tags)) {
            $tags = explode(',', $request->tags);
            $tags = Tag::findOrCreate($tags);
            $asset->attachTags($tags)->save();

        }
        // //Store in Storage Folder
        //$request->asset->storeAs('images', $imageName);

        // // Store in S3
        // $request->asset->storeAs('images', $imageName, 's3');
        ProcessMedia::dispatch($asset);
        if($request->wantsJson()) {
            return $asset;
        }
        return back()->with('success', 'Image uploaded Successfully!')
            ->with('asset', $asset->withoutRelations());
    }
}
