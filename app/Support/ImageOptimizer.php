<?php

namespace App\Support;

class ImageOptimizer
{
    /**
     * Redimensionne et compresse une image déjà stockée sur le disque "public".
     * Utilise GD (inclus dans PHP/XAMPP), aucune dépendance externe requise.
     */
    public static function optimize(string $relativePath, int $maxWidth = 1600, int $quality = 75): void
    {
        $fullPath = storage_path('app/public/'.$relativePath);

        if (!file_exists($fullPath)) {
            return;
        }

        $info = @getimagesize($fullPath);
        if (!$info) {
            return;
        }

        [$width, $height, $type] = $info;

        if ($width <= $maxWidth) {
            return;
        }

        $ratio = $maxWidth / $width;
        $newWidth = $maxWidth;
        $newHeight = (int) round($height * $ratio);

        $source = match ($type) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($fullPath),
            IMAGETYPE_PNG => @imagecreatefrompng($fullPath),
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($fullPath) : null,
            default => null,
        };

        if (!$source) {
            return;
        }

        $resized = imagecreatetruecolor($newWidth, $newHeight);

        if ($type === IMAGETYPE_PNG) {
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
        }

        imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        match ($type) {
            IMAGETYPE_JPEG => imagejpeg($resized, $fullPath, $quality),
            IMAGETYPE_PNG => imagepng($resized, $fullPath, (int) round((100 - $quality) / 10)),
            IMAGETYPE_WEBP => function_exists('imagewebp') ? imagewebp($resized, $fullPath, $quality) : null,
            default => null,
        };

        imagedestroy($source);
        imagedestroy($resized);
    }
}
