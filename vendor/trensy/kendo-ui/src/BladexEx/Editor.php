<?php
/**
 * User: Peter Wang
 * Date: 17/1/9
 * Time: 上午10:05
 */

namespace Trensy\KendoUI\BladexEx;


class Editor extends Base
{

    public function perform($param)
    {
        $str = $this->getPushStatic([
            '/static/lib/kendo-ui/styles/kendo.common.min.css',
            '/static/lib/kendo-ui/styles/kendo.silver.min.css',
            '/static/lib/kendo-ui/styles/kendo.default.mobile.min.css',
            '/static/lib/kendo-ui/js/jquery.min.js',
            '/static/lib/kendo-ui/js/kendo.core.min.js',
            '/static/lib/kendo-ui/js/kendo.data.min.js',
            '/static/lib/kendo-ui/js/kendo.popup.min.js',
            '/static/lib/kendo-ui/js/kendo.list.min.js',
            '/static/lib/kendo-ui/js/kendo.combobox.min.js',
            '/static/lib/kendo-ui/js/kendo.dropdownlist.min.js',
            '/static/lib/kendo-ui/js/kendo.userevents.min.js',
            '/static/lib/kendo-ui/js/kendo.draganddrop.min.js',
            '/static/lib/kendo-ui/js/kendo.window.min.js',
            '/static/lib/kendo-ui/js/kendo.color.min.js',
            '/static/lib/kendo-ui/js/kendo.slider.min.js',
            '/static/lib/kendo-ui/js/kendo.button.min.js',
            '/static/lib/kendo-ui/js/kendo.colorpicker.min.js',
            '/static/lib/kendo-ui/js/kendo.selectable.min.js',
            '/static/lib/kendo-ui/js/kendo.listview.min.js',
            '/static/lib/kendo-ui/js/kendo.upload.min.js',
            '/static/lib/kendo-ui/js/kendo.filebrowser.min.js',
            '/static/lib/kendo-ui/js/kendo.imagebrowser.min.js',
            '/static/lib/kendo-ui/js/kendo.resizable.min.js',
            '/static/lib/kendo-ui/js/kendo.tabstrip.min.js',
            '/static/lib/kendo-ui/js/kendo.numerictextbox.min.js',
            '/static/lib/kendo-ui/js/kendo.drawing.min.js',
            '/static/lib/kendo-ui/js/kendo.pdf.min.js',
            '/static/lib/kendo-ui/js/kendo.editor.min.js',
            ]);
        return $str.'<?php \Trensy\KendoUI\BladexEx\Editor::deal('.$param.'); ?>';
    }


    public static function deal($str, $name='edt',$attrs=[],$imageBrowserUrl=null,$fileBrowserUrl=null)
    {
        $editor = new \Kendo\UI\Editor($name);
        $editor->attr('style', 'height:200px')
            ->attr('aria-label', 'editor')
            ->resizable(true)
            ->startContent();
        if($attrs){
            foreach ($attrs as $k=>$v){
                $editor->attr($k,$v);
            }
        }

        if($imageBrowserUrl){
            // configure image browser
            $imageBrowser = new \Kendo\UI\EditorImageBrowser();

            $imageBrowser_transport = new \Kendo\UI\EditorImageBrowserTransport();
            $imageBrowser_transport->thumbnailUrl($imageBrowserUrl.'?action=thumbnail');
            $imageBrowser_transport->uploadUrl($imageBrowserUrl.'?action=upload');
            $imageBrowser_transport->imageUrl($imageBrowserUrl.'?action=image&path={0}');

            $imageBrowser_transport->read($imageBrowserUrl.'?action=read');
            $imageBrowser_destroy = new \Kendo\UI\EditorImageBrowserTransportDestroy();
            $imageBrowser_destroy
                ->url($imageBrowserUrl.'?action=destroy')
                ->type('POST');
            $imageBrowser_transport->destroy($imageBrowser_destroy);
            $imageBrowser_create = new \Kendo\UI\EditorImageBrowserTransportCreate();
            $imageBrowser_create
                ->url($imageBrowserUrl.'?action=create')
                ->type('POST');
            $imageBrowser_transport->create($imageBrowser_create);
            $imageBrowser->transport($imageBrowser_transport);
            $editor->imageBrowser($imageBrowser);
        }

        if($fileBrowserUrl){
            // configure file browser
            $fileBrowser = new \Kendo\UI\EditorFileBrowser();
            $fileBrowser_transport = new \Kendo\UI\EditorFileBrowserTransport();
            $fileBrowser_transport->uploadUrl($fileBrowserUrl.'?action=upload');
            $fileBrowser_transport->fileUrl($fileBrowserUrl.'?action=file&path={0}');

            $fileBrowser_transport->read($fileBrowserUrl.'?action=read');
            $fileBrowser_destroy = new \Kendo\UI\EditorFileBrowserTransportDestroy();
            $fileBrowser_destroy
                ->url($fileBrowserUrl.'?action=destroy')
                ->type('POST');
            $fileBrowser_transport->destroy($fileBrowser_destroy);
            $fileBrowser_create = new \Kendo\UI\EditorFileBrowserTransportCreate();
            $fileBrowser_create
                ->url($fileBrowserUrl.'?action=create')
                ->type('POST');
            $fileBrowser_transport->create($fileBrowser_create);
            $fileBrowser->transport($fileBrowser_transport);
            $editor->fileBrowser($fileBrowser);
        }

        echo $str;
        $editor->endContent();
        echo $editor->render();
    }

}