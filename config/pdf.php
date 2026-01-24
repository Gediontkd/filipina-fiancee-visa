<?php
// config/pdf.php

return [

    /*
    |--------------------------------------------------------------------------
    | PDF Generation Settings
    |--------------------------------------------------------------------------
    |
    | Configure PDF generation and merging functionality for the application.
    |
    */

    /**
     * Enable or disable PDF generation globally
     * Set to false to temporarily disable PDF generation for maintenance
     */
    'generation_enabled' => env('PDF_GENERATION_ENABLED', true),

    /**
     * Base path for user PDF folders
     */
    'base_path' => resource_path('views/pdf'),

    /**
     * Folder naming pattern for users
     * {id} will be replaced with user ID
     */
    'folder_pattern' => 'user_{id}',

    /**
     * Temporary files settings
     */
    'temp' => [
        /**
         * Path for temporary merged PDF files
         */
        'path' => storage_path('app/temp'),

        /**
         * Automatic cleanup age in hours
         * Files older than this will be deleted automatically
         */
        'cleanup_age_hours' => 24,

        /**
         * Enable automatic cleanup via scheduled task
         */
        'auto_cleanup' => env('PDF_AUTO_CLEANUP', true),
    ],

    /**
     * PDF Merging settings
     */
    'merge' => [
        /**
         * Preferred merge method
         * Options: 'pdftk', 'php', 'auto'
         * 'auto' will use pdftk if available, otherwise fall back to PHP
         */
        'method' => env('PDF_MERGE_METHOD', 'auto'),

        /**
         * Maximum number of PDFs to merge in one operation
         */
        'max_files' => env('PDF_MAX_MERGE_FILES', 50),
    ],

    /**
     * Email notification settings for submissions
     */
    'notifications' => [
        /**
         * Admin email address to receive submission notifications
         */
        'admin_email' => env('ADMIN_EMAIL', 'gediondaniel454@gmail.com'),

        /**
         * Enable email notifications for new submissions
         */
        'enabled' => env('PDF_NOTIFICATIONS_ENABLED', true),

        /**
         * Attach JSON data to notification emails
         */
        'attach_json' => env('PDF_NOTIFICATIONS_ATTACH_JSON', true),
    ],

    /**
     * Security and validation
     */
    'security' => [
        /**
         * Maximum PDF file size in MB
         */
        'max_file_size_mb' => env('PDF_MAX_FILE_SIZE', 10),

        /**
         * Allowed PDF MIME types
         */
        'allowed_mime_types' => [
            'application/pdf',
        ],

        /**
         * Validate PDF files before merging
         */
        'validate_files' => env('PDF_VALIDATE_FILES', true),
    ],

];