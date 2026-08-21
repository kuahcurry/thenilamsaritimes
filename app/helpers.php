<?php

if (!function_exists('format_gdrive_url')) {
    /**
     * Converts any Google Drive shareable/export/uc URL into a direct CDN URL
     * (https://lh3.googleusercontent.com/d/FILE_ID) that avoids 403 / CORS errors on web pages.
     */
    function format_gdrive_url(?string $url): ?string
    {
        if (empty($url)) {
            return $url;
        }

        // Match Google Drive or Google Docs URLs
        if (str_contains($url, 'drive.google.com') || str_contains($url, 'docs.google.com')) {
            // Extract File ID from various Google Drive URL patterns:
            // 1. id=FILE_ID
            // 2. /file/d/FILE_ID/view
            // 3. /d/FILE_ID
            if (preg_match('/(?:id=|\/d\/|\/file\/d\/)([a-zA-Z0-9_-]{25,})/', $url, $matches)) {
                $fileId = $matches[1];
                return "https://lh3.googleusercontent.com/d/{$fileId}";
            }
        }

        return $url;
    }
}
