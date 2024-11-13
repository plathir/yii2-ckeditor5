<?php
namespace plathir\yii2\ckeditor5;

use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;

class CKEditor5Widget extends InputWidget
{
    public $clientOptions = []; // Options for CKEditor 5 initialization

    public function run()
    {
        // Register the CKEditor 5 asset bundle
        CKEditor5Asset::register($this->getView());

        // Render the textarea
        echo $this->renderTextarea();

        // Register the CKEditor 5 initialization script
        $this->registerClientScript();
    }

    protected function renderTextarea()
    {
        // Set a unique ID if not provided
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        // Render the textarea with model binding if a model is set
        if ($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            return Html::textarea($this->name, $this->value, $this->options);
        }
    }

    protected function registerClientScript()
    {
        $view = $this->getView();

        // Encode clientOptions array into a JSON string for JavaScript
        $clientOptions = empty($this->clientOptions) ? '{}' : Json::encode($this->clientOptions);
        $id = $this->options['id'];

        // Register JavaScript to initialize CKEditor 5 on the textarea
        $js = <<<JS
ClassicEditor
    .create(document.querySelector('#{$id}'), $clientOptions)
    .catch(error => {
        console.error(error);
    });
JS;
        $view->registerJs($js);
    }
}
