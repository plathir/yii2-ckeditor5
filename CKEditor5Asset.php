<?php
namespace plathir\yii2\ckeditor5;

use yii\web\AssetBundle;

class CKEditor5Asset extends AssetBundle
{
    public $js = [
        'https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js', // CKEditor 5 from CDN
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
    ];
}
