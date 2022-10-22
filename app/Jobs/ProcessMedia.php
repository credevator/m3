<?php

namespace App\Jobs;

use App\Models\Asset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image;
use Spatie\PdfToImage\Exceptions\PdfDoesNotExist;
use Spatie\PdfToImage\Pdf;

class ProcessMedia implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Asset
     */
    public $asset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    /**
     * The unique ID of the job.
     *
     * @return string
     */
    public function uniqueId()
    {
        return $this->asset->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // @TODO: Generate Thumbnails.
//        Image::load($pathToImage)
//            ->width(100)
//            ->height(100)
//            ->save($pathToNewImage);
        //@TODO: If pdf, generate thumbnail from firstpage.
        try {
            //$pdf = new Pdf($this->asset->path);
            //$pdf->saveImage($pathToWhereImageShouldBeStored);
        } catch (PdfDoesNotExist $e) {
            // Something will happen here later.
        }
        // @TODO: Fetch metadata.

        // @TODO: Optimize image for web.

        // @TODO: trigger webhook if configured.
        echo "I'll process the media for asset." . $this->asset->asset_id;
        return;
    }
}
