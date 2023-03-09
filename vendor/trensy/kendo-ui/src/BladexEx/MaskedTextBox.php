<?php
/**
 * User: Peter Wang
 * Date: 17/1/9
 * Time: 上午10:05
 */

namespace Trensy\KendoUI\BladexEx;


class MaskedTextBox extends Base
{
    public function perform($param)
    {
        $str = $this->getPushStatic([
            '/static/lib/kendo-ui/styles/kendo.common.min.css',
            '/static/lib/kendo-ui/styles/kendo.silver.min.css',
            '/static/lib/kendo-ui/styles/kendo.default.mobile.min.css',
            '/static/lib/kendo-ui/js/jquery.min.js',
            '/static/lib/kendo-ui/js/kendo.core.min.js',
            '/static/lib/kendo-ui/js/kendo.maskedtextbox.min.js'
            ]);
        return $str.'<?php \Trensy\KendoUI\BladexEx\MaskedTextBox::deal('.$param.'); ?>';
    }


    public static function deal($data, $mask, $name='mtb')
    {
        $ui = new \Kendo\UI\MaskedTextBox($name);
        $ui->value($data)
            ->mask($mask);
        echo $ui->render();
    }

}