<?php

namespace andrew72ru\datepicker;

use Yii;
use andrew72ru\datepicker\assets\DatepickerAsset;
use andrew72ru\datepicker\assets\DatepickerMobileAsset;
use andrew72ru\datepicker\assets\ModernizrAsset;
use andrew72ru\datepicker\assets\MomentAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Widget for yii2-bootstrap-datepicker-mobile
 * @link https://github.com/andrew72ru/yii2-bootstrap-datepicker-mobile
 */
class DatePicker extends InputWidget
{
    public $dateFormat = false;
    public $dateStart = false;
    public $pluginOptions = [];

    private $_data = [];

    public function init()
    {
        parent::init();
        DatepickerMobileAsset::register($this->getView());

        if(!$this->dateFormat)
            $this->dateFormat = 'MM/dd/yy';

        $this->_data['date-start-view'] = ArrayHelper::remove($this->pluginOptions, 'date-start-view', 'day');
        $this->_data['date-format'] = ArrayHelper::remove($this->pluginOptions, 'date-format', 'dd.mm.yy');
        $this->_data['date'] = ArrayHelper::remove($this->pluginOptions, 'date', $this->getNow());

        $attr = $this->attribute;
        if($this->model->$attr == null)
            $this->model->$attr = $this->getNow();
    }

    public function run()
    {
        $html[] = Html::beginTag('div', ['class' => 'input-group']);
        $html[] = Html::beginTag('div', ['class' => 'input-group-addon']);
        $html[] = Html::tag('span', '', ['class' => 'glyphicon glyphicon-calendar']);
        $html[] = Html::endTag('div');

        $html[] = Html::activeTextInput($this->model, $this->attribute, [
            'class' => ArrayHelper::remove($this->options, 'class', 'form-control') . ' date-picker',
            'data' => $this->_data,
            'placeholder' => $this->_data['date-format'],
            'style' => [
                '-webkit-appearance' => 'none',
                '-moz-appearance' => 'none',
            ]
        ]);
        $html[] = Html::endTag('div');

        return implode('', $html);
    }

    private function getNow()
    {
        return \Yii::$app->formatter->asDate(time(), 'MM/dd/yy');
    }
}
