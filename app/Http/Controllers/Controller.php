<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function prepareTranslations(array $translations, array $columns): array
    {
        $preparedTranslations = [];

        foreach ($translations as $translation) {
            foreach ($translation as $lang => $value) {
                // Initialize the language key if not already present
                if (!isset($preparedTranslations[$lang])) {
                    $preparedTranslations[$lang] = [];
                }

                // Merge translation columns for the same language
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

    protected function success($data = [], string $message = 'Operation successful', int $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
