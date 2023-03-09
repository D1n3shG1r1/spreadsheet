<?php
/**
 * User: Peter Wang
 * Date: 17/1/9
 * Time: 上午10:05
 */

namespace Trensy\KendoUI\BladexEx;


class NumericTextBox extends Base
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
            '/static/lib/kendo-ui/js/kendo.numerictextbox.min.js'
            ]);
        return $str.'<?php \Trensy\KendoUI\BladexEx\NumericTextBox::deal('.$param.'); ?>';
    }


    public static function deal($value, $name='ntb',$options=[])
    {
        $ui = new \Kendo\UI\NumericTextBox($name);
        $ui->value($value);
        if($options){
            foreach ($options as $k=>$v){
                $ui->$k($v);
            }
        }
        echo $ui->render();
    }

}