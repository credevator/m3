<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Tags\HasTags;

class Asset extends Model
{
    use HasFactory;
    use HasTags;

    protected $fillable = [
        'asset_id',
        'filename',
        'mime_type',
        'file_ext',
        'path',
        'storage'
    ];

    protected $guarded = [
      'file_ext',
      'mime_type'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Load Asset by asset_id
     *
     * @param $asset_id
     * @return Model|mixed|null
     */
    public static function loadByAssetId($asset_id)
    {
        $asset = Asset::all()->firstWhere('asset_id', $asset_id);
        return $asset;
    }

    public static function download($asset_id)
    {
        $asset = self::loadByAssetId($asset_id);
        return asset($asset->path);
    }

    /**
     * Delete associated file when asset is deleted.
     *
     * @return bool|null
     */
    public function delete()
    {
        // @TODO: Delete file. check if used, don't delete.
        Storage::delete(public_path($this->path));
        return parent::delete();
    }
}
