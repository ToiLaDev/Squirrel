<?php

namespace App\Services\Media;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    protected $disk;
    protected $file;
    protected $media;
    protected $name;
    protected $path;
    protected $folder_id;
    protected $collection_name;
    protected $mediaRepo;

    public function __construct($file)
    {
        if ($file instanceof Media) {
            $this->media = $file;
        }
        elseif (is_int($file)) {
            $this->media = Media::find($file);
        }
        elseif (is_string($file)) {
            $this->name = $file;
        }
        else {
            $this->file = new File($file);
        }
    }

    public function disk($disk) : self {
        $this->disk = $disk;
        $this->file->disk($disk);
        return $this;
    }

    public function folder($folder_id) : self {
        $this->folder_id = (int)$folder_id;
        if (!empty($this->media)) {
            $this->media->folder_id = $this->folder_id;
        }
        return $this;
    }

    public function path($path) : self {
        $this->path = $path;
        return $this;
    }

    public function collection($collection_name) : self {
        $this->collection_name = $collection_name;
        return $this;
    }

    public static function file($file) : self {
        return new static($file);
    }

    public static function media($media) : self {
        return new static($media);
    }

    public static function query($request): array {
        return Media::with('owner:id,first_name,last_name')
            ->where(function($query) use ($request) {
                if ($request->has('folder_id')) {
                    $query->where('folder_id', $request->get('folder_id'));
                }
            })
            ->get()
            ->groupBy('type')
            ->toArray();
    }

    public function store() : ?Media {
        $media = null;

        if (!empty($this->file)) {
            $path = $this->path??date(config('filesystems.date_path'), $_SERVER['REQUEST_TIME']);
            if (!empty($this->file->store($path))) {
                $media = new Media;
                $media->name = $this->file->getName();
                $media->file_name = $this->file->getFileName();
                $media->mime_type = $this->file->getMimeType();
                $media->size = $this->file->getSize();
                $media->md5 = $this->file->getMd5();
                $media->sha1 = $this->file->getSha1();
                $media->type = 'file';
                $media->disk = $this->file->getDisk();
                $media->owner_id = Auth::id();

                $media->properties = $this->file->getProperties();
                $media->conversions = $this->file->createConversions();

                if (!empty($this->collection_name)) {
                    $media->collection_name = $this->collection_name;
                }
                if (!empty($this->folder_id)) {
                    $media->folder_id = $this->folder_id;
                }

                $media->save();

                if (!empty($media->folder_id)) {
                    self::updateFolderSize($media->folder, $media->size);
                }
            }
        }
        else {
            $media = new Media;
            $media->name = $this->name;
            $media->type = 'folder';
            $media->size = 0;
            $media->owner_id = Auth::id();

            if (!empty($this->collection_name)) {
                $media->collection_name = $this->collection_name;
            }
            if (!empty($this->folder_id)) {
                $media->folder_id = $this->folder_id;
            }

            $media->save();
        }

        return $media;
    }

    public function rename($name): ?Media {
        if (!empty($this->media)) {
            $this->media->name = $name;
            $this->media->save();
        }
        return $this->media;
    }

    public static function delete(array $ids): bool {
        $info = Media::whereIn('id', $ids)
            ->select(['folder_id', DB::raw('sum(size) as size')])
            ->groupBy('folder_id')
            ->first()
        ;

        if ($info) {
            self::updateFolderSize(Media::find($info->folder_id), - $info->size);
        }
        return Media::whereIn('id', $ids)->delete();
    }

    protected static function updateFolderSize(Media $folder, $size) {
        $folder->increment('size', $size);
        if (!empty($folder->folder_id)) {
            self::updateFolderSize($folder->folder, $size);
        }
    }

    public function url(): ?string
    {
        if ($this->media->type == 'file') {
            return Storage::disk($this->media->disk)->url($this->media->file_name);
        } else {
            return  null;
        }
    }

    public function thumb(): ?string
    {
        if ($this->media->type == 'file') {
            return Storage::disk($this->media->disk)->url($this->media->file_name);
        } else {
            return  null;
        }
    }
}
