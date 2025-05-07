<?php

namespace App\Services;

class BaseService
{
    /**
     * Create a new class instance.
     */
    protected function prepareTranslations(array $translations, array $columns): array
    {
        $preparedTranslations = [];

        foreach ($translations as $translation) {
            foreach ($translation as $lang => $value) {
                if (!isset($preparedTranslations[$lang])) {
                    $preparedTranslations[$lang] = [];
                }

                foreach ($columns as $column) {
                    if (isset($value[$column])) {
                        $preparedTranslations[$lang][$column] = $value[$column];
                    } else {
                        info("{$column} not set for language: $lang");
                    }
                }
            }
        }

        return $preparedTranslations;
    }
    public function uploadPhoto($file, $path='uploads')
    {
       $photoName = md5(time().$file->getFilename()).'.'.$file->getClientOriginalExtension();
       return $file->storeAs($path, $photoName, 'public');
    }
    public function deletePhoto($path)
    {
        $fullPath = storage_path('app/public/' . $path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
