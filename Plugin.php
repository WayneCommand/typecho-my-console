<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * my world, my tenet. my console, my life.
 *
 * @package MyConsole
 * @author shenlan
 * @version 1.0.0
 * @link https://github.com/shenlanAZ
 */
class MyConsole_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->footer = array(__CLASS__, 'render');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        /** text */
        $text = new Typecho_Widget_Helper_Form_Element_Text('text', NULL, '', _t('say something'));
        $form->addInput($text);

        /** link */
        $title = new Typecho_Widget_Helper_Form_Element_Text('title', NULL, 'Blog', _t('title'));
        $form->addInput($title);

        /** link */
        $yourLink = new Typecho_Widget_Helper_Form_Element_Text('yourLink', NULL, 'https://blog.inmind.ltd/', _t('your link'));
        $form->addInput($yourLink);
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 插件实现方法
     *
     * @access public
     * @return void
     */
    public static function render()
    {

    $text = Typecho_Widget::widget('Widget_Options')->plugin('MyConsole')->text;
    $yourLink = Typecho_Widget::widget('Widget_Options')->plugin('MyConsole')->yourLink;
    $title = Typecho_Widget::widget('Widget_Options')->plugin('MyConsole')->title;

    echo <<<HTML
<script type="text/javascript">

if (window.console && window.console.log) {
console.log("{$text}");
console.log("%c {$title} %c {$yourLink} ","color: #fff; margin: 1em 0; padding: 5px 0; background: #4682B4;","margin: 1em 0; padding: 5px 0; background: #efefef;");
}
</script>
HTML;
    }
}