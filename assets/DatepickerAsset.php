<?php
/**
 * Project: timeregistrering
 * File: DatepickerAsset.php
 * User: andrew
 * Date: 11.02.16
 * Time: 11:46
 */

namespace andrew72ru\datepicker\assets;


use yii\helpers\Json;
use yii\web\AssetBundle;

class DatepickerAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-datepicker';
    public $css = [
        'css/datepicker3.css'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    private function getJs()
    {
        $view = \Yii::$app->getView();
        $defaults = [
            'calendarWeeks' => true,
//            'autoclose' => true,
        ];
        $view->registerJs("$.fn.datepicker.defaults.calendarWeeks = true;\n", $view::POS_READY);

        $js = ['js/bootstrap-datepicker.js'];
        if(\Yii::$app->formatter->locale == 'nn-NO')
        {
            $js[] = 'js/locales/bootstrap-datepicker.nb.js';
            $view->registerJs("$.fn.datepicker.defaults.language = 'nb';\n", $view::POS_READY);
        }

        if(\Yii::$app->formatter->locale == 'ru-RU')
        {
            $js[] = 'js/locales/bootstrap-datepicker.ru.js';
            $view->registerJs("$.fn.datepicker.defaults.language = 'ru';\n", $view::POS_READY);
        }

        return $js;
    }

    public function init()
    {
        parent::init();
        $this->js = $this->getJs();

    }
}
