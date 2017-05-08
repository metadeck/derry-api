<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Storage;
use App\Repositories\MediaRepository;

class MediaService
{
    /**
     * MediaService constructor.
     * @param MediaRepository $mediaRepository
     */
    public function __construct(MediaRepository $mediaRepository)
    {
        $this->repo = $mediaRepository;
    }

    /**
     * Find media item by id
     *
     * @param $id
     * @return Media
     */
    public function find($id)
    {
        return $this->repo->find($id);
    }

    /**
     * Create a media item
     *
     * @param  UploadedFile|array $uploadedFile
     *              - The file object to create this item OR
     *              - The filename && mime_type as a array (If file has been uploaded through another service)
     * @param $directory
     * @param $relationship
     * @return Media - A media item
     */
    public function create($uploadedFile, $disk, $relationship, $directory){

        //check if we're dealing with a file or file data array
        if($uploadedFile instanceof \SplFileInfo){
            $filename = time() . '_' . $this->sanitize_file_name($uploadedFile->getClientOriginalName());
            $mime_type = $uploadedFile->getClientMimeType();
            Storage::disk($disk)->put("$directory/$filename", fopen($uploadedFile, 'r+'), 'public');
        } else {
            $filename = $uploadedFile['filename'];
            $mime_type = $uploadedFile['mime_type'];
        }

        $media = $this->repo->create([
            'filename' => "$directory/$filename",
            'mime_type' => $mime_type,
            'attachable_relationship' => $relationship,
        ]);

        return $media;
    }

    /**
     * Update an existing media item
     *
     * @param  UploadedFile|array $uploadedFile
     *              - The file object to create this item OR
     *              - The filename && mime_type as a array (If file has been uploaded through another service)
     * @return Media - A media item
     */
    public function update($id, $uploadedFile, $disk, $directory){

        //check if we're dealing with a file or file data array
        if($uploadedFile instanceof \SplFileInfo) {
            $filename = time() . '_' . $this->sanitize_file_name($uploadedFile->getClientOriginalName());
            $mime_type = $uploadedFile->getClientMimeType();
            Storage::disk($disk)->put("$directory/$filename", fopen($uploadedFile, 'public'));
        } else {
            $filename = $uploadedFile['filename'];
            $mime_type = $uploadedFile['mime_type'];
        }

        $media = $this->repo->update($id, [
            'filename' => "$directory/$filename",
            'mime_type' => $mime_type,
        ]);

        return $media;
    }

    public function destroy($id, $directory = 's3-images'){
        $media = $this->repo->find($id);
        if($media){
            Storage::disk($directory)->delete($media->filename);
            return $media->delete();
        } else {
            return false;
        }
    }

    private function sanitize_file_name($filename) {
        $special_chars = array("?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&", "$", "#", "*", "(", ")", "|", "~", "`", "!", "{", "}");
        $filename = str_replace($special_chars, '', $filename);
        $filename = preg_replace('/[\s-]+/', '-', $filename);
        $filename = trim($filename, '.-_');
        return $filename;
    }
}