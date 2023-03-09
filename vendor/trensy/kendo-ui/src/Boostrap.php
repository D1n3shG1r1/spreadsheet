<?php
/**
 * Created by PhpStorm.
 * User: wangkaihui
 * Date: 2018/12/13
 * Time: 15:33
 */

namespace Trensy\KendoUI;


class Boostrap
{
    /**
     * @var array
     */
    protected $script = [
        '<link href="//kendo.cdn.telerik.com/2018.3.1017/styles/kendo.common.min.css" rel="stylesheet">',
        '<link href="//kendo.cdn.telerik.com/2018.3.1017/styles/kendo.silver.min.css" rel="stylesheet">',
        '<script src="//kendo.cdn.telerik.com/2018.3.1017/js/jquery.min.js"></script>',
        '<script src="//kendo.cdn.telerik.com/2018.3.1017/js/kendo.all.min.js"></script>',
    ];

    /**
     * 获取表单生成器所需js
     * @return array
     */
    public function getScript()
    {
        return $this->script;
    }

    public function getBladexExList()
    {
        return [
            //自动完成-预先数据
            "autoCompleteLocal"=>\Trensy\KendoUI\BladexEx\AutoCompleteLocal::class,
            "autoCompleteRemote"=>\Trensy\KendoUI\BladexEx\AutoCompleteRemote::class,
            "comboBoxLocal"=>\Trensy\KendoUI\BladexEx\ComboBoxLocal::class,
            "comboBoxRemote"=>\Trensy\KendoUI\BladexEx\ComboBoxRemote::class,
            "datePicker"=>\Trensy\KendoUI\BladexEx\DatePicker::class,
            "dateTimePicker"=>\Trensy\KendoUI\BladexEx\DateTimePicker::class,
            "dropDownListLocal"=>\Trensy\KendoUI\BladexEx\DropDownListLocal::class,
            "dropDownListRemote"=>\Trensy\KendoUI\BladexEx\DropDownListRemote::class,
            "dropDownTreeLocal"=>\Trensy\KendoUI\BladexEx\DropDownTreeLocal::class,
            "dropDownTreeRemote"=>\Trensy\KendoUI\BladexEx\DropDownTreeRemote::class,
            "editor"=>\Trensy\KendoUI\BladexEx\Editor::class,
            "maskedTextBox"=>\Trensy\KendoUI\BladexEx\MaskedTextBox::class,
            "multiSelectLocal"=>\Trensy\KendoUI\BladexEx\MultiSelectLocal::class,
            "multiSelectRemote"=>\Trensy\KendoUI\BladexEx\MultiSelectRemote::class,
            "numericTextBox"=>\Trensy\KendoUI\BladexEx\NumericTextBox::class,
            "timePicker"=>\Trensy\KendoUI\BladexEx\TimePicker::class,
            "upload"=>\Trensy\KendoUI\BladexEx\Upload::class,
        ];
    }

}