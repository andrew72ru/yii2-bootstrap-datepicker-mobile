<?php
/**
 * Project: timeregistrering
 * File: DatepickerMobileAsset.php
 * User: andrew
 * Date: 11.02.16
 * Time: 11:57
 */

namespace andrew72ru\datepicker\assets;


use yii\web\AssetBundle;

class DatepickerMobileAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-datepicker-mobile';
    public $js = ['bootstrap-datepicker-mobile.js'];
    public $depends = [
        'andrew72ru\datepicker\assets\ModernizrAsset',
        'andrew72ru\datepicker\assets\DatepickerAsset',
        'andrew72ru\datepicker\assets\MomentAsset',
    ];
}
