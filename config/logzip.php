<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Filename
    |--------------------------------------------------------------------------
    |
    | This option defines what should be the compressed logs output filename.
    |
    */
    'log_zip_filename' => 'laravel',

    /*
    |--------------------------------------------------------------------------
    | Compression Enable
    |--------------------------------------------------------------------------
    |
    | This option defines if the logs must be compressed.
    | set value to false to disable
    */
    'log_compress_files' => true,

    /*
    |--------------------------------------------------------------------------
    | Delete Enable
    |--------------------------------------------------------------------------
    |
    | This option defines if the logs should be deleted after being compressed.
    | set value to true to enable
    */
    'log_delete' => false,
];
