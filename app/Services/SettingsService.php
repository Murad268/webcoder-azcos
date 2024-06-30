<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;

class SettingsService
{

    public function simple_update($brand, $translate_model, $images_model, $request, $id)
    {
         
        $data = ['product_image_width' => $request->product_image_width, 'product_image_height' => $request->product_image_height, 'map'=>$request->map];
        $brand->update($data);
        foreach ($request->copyright_text as $key => $value) {
            $translation = $translate_model::where('settings_id', $id)->where('lang_key', $key)->first();
            if ($translation) {
                $translation->update([
                    'settings_id' => $id,
                    'lang_key' => $key,
                    'copyright_text' => $request->copyright_text[$key]
                ]);
            } else {
                $translate_model::create([
                    'settings_id' => $id,
                    'lang_key' => $key,
                    'copyright_text' => $request->copyright_text[$key]
                ]);
            }
        }
    }

    public function handleImages($request, $images_model, $category_id, $directory, $type)
    {
        if ($request->hasFile($type)) {
            foreach ($request->file($type) as $image) {
                $extension = $image->getClientOriginalExtension();
                $uniqueName = uniqid();
                $imagePath = 'images/' . $directory . '/' . $uniqueName . '.' . $extension;

                $directoryPath = storage_path('app/public/images/' . $directory);
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                if ($extension == 'svg') {
                    // Directly move SVG files without resizing
                    $image->storeAs('public/images/' . $directory, $uniqueName . '.' . $extension);
                } else {
                    // Handle resizing for other image types
                    $tempPath = $image->storeAs('temp', $uniqueName . '.' . $extension, 'public');
                    $this->resizeImage(storage_path('app/public/' . $tempPath), storage_path('app/public/' . $imagePath));
                    Storage::disk('public')->delete($tempPath);
                }

                $images_model::create(['image_url' => $imagePath, 'settings_id' => $category_id, 'model_type' => $type]);
            }
        }
    }

    private function resizeImage($sourcePath, $destinationPath)
    {
        $info = getimagesize($sourcePath);
        $mime = $info['mime'];

        // Skip resizing for SVG files
        if ($mime == 'image/svg+xml') {
            Storage::copy($sourcePath, $destinationPath);
            return;
        }

        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
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

        // Preserve transparency
        if ($mime == 'image/png' || $mime == 'image/gif') {
            imagealphablending($resizedImage, false);
            imagesavealpha($resizedImage, true);
        }

        // Save the resized image
        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
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
        $model->update(['status' => true]);
    }

    public function changeStatusFalse($model)
    {
        $model->update(['status' => false]);
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
