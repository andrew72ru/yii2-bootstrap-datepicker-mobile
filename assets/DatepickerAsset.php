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
        'andrew72ru\datepicker\assets\ModernizrAsset',
        'andrew72ru\datepicker\assets\MomentAsset'
    ];

    private function getJs()
    {
        $view = \Yii::$app->getView();

        $view->registerJs("$.fn.datepicker.defaults.calendarWeeks = true;\n", $view::POS_READY);
        $view->registerJs("$.fn.datepicker.defaults.autoclose = true;\n", $view::POS_READY);
        $view->registerJs("$.fn.datepicker.defaults.todayBtn = true;\n", $view::POS_READY);
        $view->registerJs("$.fn.datepicker.defaults.todayHighlight = true;\n", $view::POS_READY);

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

        $jsMobile = <<<JS
(function($, Modernizr, window) {

  // Set the default datepicker format
  $.fn.datepicker.defaults.format = "mm/dd/yy";

  // Add support for datepickers globally to use input[type=date]
  var nativeDateFormat = /^\d{4}-\d{2}-\d{2}$/;
  var datepickerDateFormat = /^\d{2}\/\d{2}\/\d{2}$/;

  /*globals moment*/
  function bootstrapDatepickerMobile(ev) {

    var \$inputs = $('input.date-picker');
    var isMobile = $(window).width() <= 480 || Modernizr.touch;


    \$inputs.each(function() {


      var \$input = $(this);
      var val = \$input.val();
      var valMoment;

      if(isMobile) { \$input.css('line-height', '20px'); }

      if (nativeDateFormat.test(val)) {
        valMoment = moment(val, 'YYYY-MM-DD');
      } else if (datepickerDateFormat.test(val)) {
        valMoment = moment(val, 'MM/DD/YY');
      }

      var isMoment = moment.isMoment(valMoment);

      if (isMobile && Modernizr.inputtypes.date) {
        if (isMoment) val = valMoment.format('YYYY-MM-DD');
        \$input.datepicker('remove');
        \$input.val(val);
        \$input.attr('type', 'date');
      } else {
        if (isMoment) val = valMoment.format('MM/DD/YY');
        \$input.attr('type', 'text');
        \$input.val(val);
        if (isMobile) {
          \$input.datepicker('remove');
        } else {
          if (isMoment)
            \$input.datepicker('update', valMoment.toDate());
          else
            \$input.datepicker();
          if (\$input.is(':focus'))
            \$input.datepicker('show');
        }
      }

    });

  }

  $(window).on('resize.bootstrapDatepickerMobile', bootstrapDatepickerMobile);

  bootstrapDatepickerMobile();

}(jQuery, Modernizr, window));
JS;

        $view->registerJs($jsMobile);

        return $js;
    }

    public function init()
    {
        parent::init();
        $this->js = $this->getJs();

    }
}
