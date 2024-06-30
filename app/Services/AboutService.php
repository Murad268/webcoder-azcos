<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class AboutService
{
    public function simple_create($main_model, $translate_model, $images_model, $request)
    {
        $data = ['about_id' => $request->category_id];

        // Create the main model
        $translate = $main_model::create($data);

        // Create translations
        foreach ($request->title as $key => $value) {
            $translate_model::create(['brand_id' => $translate->id, 'lang_key' => $key, 'title' => $value, 'subtitle' => $request->subtitle[$key]]);
        }

        // Handle multiple image uploads and resizing
    }

    public function simple_update($brand, $translate_model, $images_model, $request, $id)
    {

        $data = ['video_link' => $request->video_link];
        $brand->update($data);
        foreach ($request->title_first as $key => $value) {
            $translation = $translate_model::where('about_id', $id)->where('lang_key', $key)->first();
            if ($translation) {
                $translation->update([
                    'about_id' => $id,
                    'lang_key' => $key,
                    'title_first' => $request->title_first[$key],
                    'title_second' => $request->title_second[$key],
                    'title_third' => $request->title_third[$key],
                    'text_first' => $request->text_first[$key],
                    'text_second' => $request->text_second[$key],
                    'text_third' => $request->text_third[$key]
                ]);
            } else {

                $translate_model::create([
                    'about_id' => $id,
                    'lang_key' => $key,
                    'title_first' => $request->title_first[$key],
                    'title_second' => $request->title_second[$key],
                    'title_third' => $request->title_third[$key],
                    'text_first' => $request->text_first[$key],
                    'text_second' => $request->text_second[$key],
                    'text_third' => $request->text_third[$key]
                ]);
            }
        }




        // Handle multiple image uploads and resizing
    }


    public function handleImages($request, $images_model, $category_id, $directory, $type)
    {
        if ($request->hasFile($type)) {
            foreach ($request->file($type) as $image) {
                $imagePath = 'images/' . $directory . '/' . uniqid() . '.' . $image->getClientOriginalExtension();

                $directoryPath = storage_path('app/public/images/' . $directory);
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $tempPath = $image->storeAs('temp', uniqid() . '.' . $image->getClientOriginalExtension(), 'public');

                $this->resizeImage(storage_path('app/public/' . $tempPath), storage_path('app/public/' . $imagePath), $type);

                Storage::disk('public')->delete($tempPath);

                $images_model::create(['image_url' => $imagePath, 'about_id' => $category_id, 'model_type' => $type]);
            }
        }
    }

    private function resizeImage($sourcePath, $destinationPath, $type=null)
    {
        // Get the image info
        $info = getimagesize($sourcePath);
        $mime = $info['mime'];

        // Create a new image from file
        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg': // Add support for JPG
                $image = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($sourcePath);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($sourcePath);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($sourcePath);
                break;
            default:
                throw new \Exception('Unsupported image format.');
        }

        // Resize the image
        // $resizedImage = imagescale($image, 300, 200);
        if($type == 'certificate') {
            $resizedImage = imagescale($image, 800, 1200);
        } else {
            $resizedImage  = $image;
        }
      
        // Save the resized image
        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg': // Add support for JPG
                imagejpeg($resizedImage, $destinationPath);
                break;
            case 'image/png':
                imagepng($resizedImage, $destinationPath);
                break;
            case 'image/gif':
                imagegif($resizedImage, $destinationPath);
                break;
            case 'image/webp':
                imagewebp($resizedImage, $destinationPath);
                break;
        }

        // Free memory
        imagedestroy($image);
        imagedestroy($resizedImage);
    }

    public function deleteWhereIn($models)
    {
        foreach ($models as $model) {
            $this->deleteImages($model);
            $model->delete();
        }
    }

    private function deleteImages($model)
    {
        $images = $model->images;
        foreach ($images as $image) {
            Storage::disk('public')->delete($image->image_url);
            $image->delete();
        }
    }

    public function changeStatusTrue($model)
    {
        $model->update(['status' =>  true]);
    }

    public function changeStatusFalse($model)
    {
        $model->update(['status' =>  false]);
    }

    public function changeOrder($datas, $repo)
    {
        foreach ($datas as $data) {
            $lang = $repo->find($data['id']);
            $lang->update(['order' => $data['order']]);
        }
    }


    public function deleteImage($id, $model)
    {

        $images_model = $model;

        // Find the image by ID
        $image = $images_model::findOrFail($id);

        // Delete the image file from storage
        Storage::disk('public')->delete($image->image_url);

        // Delete the image record from the database
        $image->delete();

        return ['success' => true];
    }
}
