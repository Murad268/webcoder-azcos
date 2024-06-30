<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class CategoryService
{
    public function simple_create($main_model, $translate_model, $images_model, $request)
    {
        $data = [ 'video_link' => $request->video_link, 'seo_links' => $request->seo_links , 'seo_scripts' => $request->seo_scripts ];

        // Create the main model
        $translate = $main_model::create($data);

        $translate->product_types()->attach($request->product_types);
        $translate->colorSchemes()->attach($request->color_schemes);

        // Create translations
        foreach ($request->title as $key => $value) {
            $translate_model::create(['text_center'=> $request->text_center[$key],'slug' => Str::slug($request->title[$key]),'meta_keywords' => $request->meta_keywords[$key] ,'meta_description' => $request->meta_description[$key] , 'seo_title' => $request->seo_title[$key] ,'category_id' => $translate->id,'lang_key' => $key, 'title' => $value, 'subtitle' => $request->subtitle[$key], 'title_first' => $request->title_first[$key], 'title_second' => $request->title_second[$key], 'text_second' => $request->text_second[$key], 'text_first' => $request->text_first[$key]]);
        }

        // Handle multiple image uploads and resizing
        // $this->handleImages($request, $images_model, $translate->id);
    }

    public function simple_update($category, $translate_model, $images_model, $request, $id)
    {
        $data = ['video_link' => $request->video_link, 'seo_links' => $request->seo_links , 'seo_scripts' => $request->seo_scripts];

        // Update the main model
        $category->update($data);
        $category->product_types()->sync($request->product_types);
        $category->colorSchemes()->sync($request->color_schemes);
        // Update translations
        foreach ($request->title as $key => $value) {
            $translation = $translate_model::where('category_id', $id)->where('lang_key', $key)->first();
            if ($translation) {
                $translation->update(['text_center'=> $request->text_center[$key], 'slug' => Str::slug($request->title[$key]), 'meta_keywords' => $request->meta_keywords[$key] ,'meta_description' => $request->meta_description[$key] , 'seo_title' => $request->seo_title[$key] ,'category_id' => $id, 'lang_key' => $key, 'title' => $value, 'subtitle' => $request->subtitle[$key], 'title_first' => $request->title_first[$key], 'title_second' => $request->title_second[$key], 'text_second' => $request->text_second[$key], 'text_first' => $request->text_first[$key]]);
            } else {
                $translate_model::create(['text_center'=> $request->text_center[$key], 'slug' => Str::slug($request->title[$key]),'meta_keywords' => $request->meta_keywords[$key] ,'meta_description' => $request->meta_description[$key] , 'seo_title' => $request->seo_title[$key] ,'category_id' => $id, 'lang_key' => $key,'title' => $value, 'subtitle' => $request->subtitle[$key], 'title_first' => $request->title_first[$key], 'title_second' => $request->title_second[$key], 'text_second' => $request->text_second[$key], 'text_first' => $request->text_first[$key]]);
            }
        }

        // Handle multiple image uploads and resizing
        // $this->handleImages($request, $images_model, $id);
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

                $this->resizeImage(storage_path('app/public/' . $tempPath), storage_path('app/public/' . $imagePath));

                Storage::disk('public')->delete($tempPath);

                $images_model::create(['image_url' => $imagePath, 'category_id' => $category_id, 'model_type' => $type]);
            }
        }
    }



    private function resizeImage($sourcePath, $destinationPath)
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
        $resizedImage = $image;

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
            $model->product_types()->detach();
            $model->colorSchemes()->detach();
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


