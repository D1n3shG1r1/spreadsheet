<?php
/**
 * User: Peter Wang
 * Date: 17/1/9
 * Time: 上午10:05
 */

namespace Trensy\KendoUI\BladexEx;


class TimePicker extends Base
{

    public function perform($param)
    {
        $str = $this->getPushStatic([
            '/static/lib/kendo-ui/styles/kendo.common.min.css',
            '/static/lib/kendo-ui/styles/kendo.silver.min.css',
            '/static/lib/kendo-ui/styles/kendo.default.mobile.min.css',
            '/static/lib/kendo-ui/js/jquery.min.js',
            '/static/lib/kendo-ui/js/kendo.core.min.js',
            '/static/lib/kendo-ui/js/kendo.userevents.min.js',
            '/static/lib/kendo-ui/js/kendo.selectable.min.js',
            '/static/lib/kendo-ui/js/kendo.calendar.min.js',
            '/static/lib/kendo-ui/js/kendo.popup.min.js',
            '/static/lib/kendo-ui/js/kendo.datepicker.min.js',
            '/static/lib/kendo-ui/js/kendo.timepicker.min.js',
            '/static/lib/kendo-ui/js/kendo.datetimepicker.min.js'
            ]);
        return $str.'<?php \Trensy\KendoUI\BladexEx\TimePicker::deal('.$param.'); ?>';
    }


    public static function deal($name='tp',$value='',$options=[])
    {
        $ui = new \Kendo\UI\TimePicker($name);
        $ui->value($value);
        $ui->format('HH:mm');
        if($options){
            foreach ($options as $k=>$v){
                $ui->$k($v);
            }
        }
        echo $ui->render();
    }

}