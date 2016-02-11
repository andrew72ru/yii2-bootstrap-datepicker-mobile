Mobile-first datepicker for Yii2
================================
Mobile-first datepicker for Yii2 based on https://github.com/niftylettuce/bootstrap-datepicker-mobile

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist andrew72ru/yii2-bootstrap-datepicker-mobile "*"
```

or add

```
"andrew72ru/yii2-bootstrap-datepicker-mobile": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= $form->field($model, 'date')->widget(\andrew72ru\datepicker\DatePicker::className(), [
    'options' => [], // Html tag options
    'pluginOptions' => [
        'date-start-view' => 'day',
        'date-format' => 'dd.mm.yy',
        'date' => \Yii::$app->formatter->asDate(time(), 'MM/dd/yy'),
    ],
]); ?>
```
