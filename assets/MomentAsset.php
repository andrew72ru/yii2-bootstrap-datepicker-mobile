<?php
/**
 * Project: timeregistrering
 * File: MomentAsset.php
 * User: andrew
 * Date: 11.02.16
 * Time: 12:00
 */

namespace andrew72ru\datepicker\assets;


use yii\web\AssetBundle;

class MomentAsset extends AssetBundle
{
    public $sourcePath = '@bower/moment';
    public $js = ['min/moment-with-locales.min.js'];
    public $depends = ['yii\web\JqueryAsset'];

    public function init()
    {
        parent::init();
        $view = \Yii::$app->getView();
        $view->registerJs("moment.locale('" . \Yii::$app->formatter->locale . "');\n", $view::POS_END);
    }
}
