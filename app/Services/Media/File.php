<?php

namespace App\Services\Media;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;

class File
{
    public $file;
    protected $name;
    protected $fileName;
    protected $mimeType;
    protected $extension;
    protected $size;
    protected $content;
    protected $disk;
    protected $time;
    public function __construct($file, $disk = null)
    {
        $this->file = $file;
        $this->time = $_SERVER['REQUEST_TIME'];
        $this->disk = $disk??config('filesystems.default');
        if ($file instanceof UploadedFile) {
            $this->content = $file->getContent();
            $this->name = $file->getClientOriginalName();
            $this->mimeType = $file->getClientMimeType();
            $this->size = $file->getSize();
            $this->extension = $file->getClientOriginalExtension();
        } elseif($file instanceof SymfonyFile) {

        } else {

        }
    }

    public function disk($disk) {
        $this->disk = $disk;
    }

    public function getName(): string
    {
        return $this->getMd5().'.'.$this->extension;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getDisk(): string
    {
        return $this->disk;
    }

    public function getMd5(): string
    {
        return md5($this->content);
    }

    public function getSha1(): string
    {
        return sha1($this->content);
    }

    public function getProperties(): ?array
    {
        return null;
    }

    public function createConversions(): ?array
    {
        return null;
    }

    public function store($path): ?string
    {

        $path = trim($path, '/') . '/' . $this->getName();
        if (Storage::disk($this->disk)->put($path, $this->content)) {
            $this->fileName = $path;
            return $path;
        }
        return null;
    }
}
