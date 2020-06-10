<?php

/* return [
    'secret' => env('NOCAPTCHA_SECRET'),
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
    'options' => [
        'timeout' => 30,
    ],
]; */

return [
    'default'   => [
        'length'    => 5,
        'width'     => 85,
        'height'    => 25,
        'quality'   => 90,
        'math'      => true, //Enable Math Captcha
    ],
    // ...
];
