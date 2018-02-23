<?php

namespace worstinme\widgets;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use worstinme\widgets\models\Widgets;
use worstinme\widgets\models\WidgetsSearch;
use worstinme\widgets\helpers\ShortcodeHelper;
use yii\i18n\PhpMessageSource;
use yii\web\Response;
use yii\web\View;

class Component extends \yii\base\Component implements BootstrapInterface
{
    /** @var boolean load backend module? */
    public $backend = false;

    /** @var boolean load frontend callbacks? */
    public $frontend = false;

    /** @var array application content languages * */
    public $languages = [];

    /**
     * @var string The prefix for user module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'widgets';

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        '' => 'default/index',
        '<action:(\w|-)+>' => 'default/<action>',
        '<controller:\w+>/<action:(\w|-)+>' => '<controller>/<action>',
    ];

    /** @var array List of roles with access to admin'a part of application. */
    public $accessRoles = ['admin'];

    public $callbacks = [];

    public $customWidgetsPath;
    public $customWidgetsNamespace;
    public $attachWidget = [];

    private $widgets;
    private $widgetModels;

    public function init()
    {
        $this->callbacks = array_merge([
            'widget'=>['worstinme\widgets\callbacks\Widget','widget'],
            'position'=>['worstinme\widgets\callbacks\Position','widget'],
            //'anothershortcode'=>function($attrs, $content, $tag){},
        ],$this->callbacks);

        parent::init();
    }

    public function callWidget($widget)
    {

        if ($this->widgets === null)
            $this->getWidgets();

        if (!empty($this->widgets[$widget['callback']])) {
            if (!isset($widget['bounds']) || $this->checkBounds($widget['bounds'])) {
                return call_user_func([$this->widgets[$widget['callback']], 'widget'], $widget['params']);
            }
        }

    }

    public function getWidgetsModels()
    {

        if ($this->widgetModels === null) {

            $widgets = [];

            $paths = ['worstinme\widgets\widgets\models' => '@worstinme/widgets/widgets/models'];

            if (Yii::$app->has('zoo')) {
                $paths['worstinme\widgets\zoo\models'] = '@worstinme/widgets/zoo/models';
            }

            if ($this->customWidgetsPath !== null && $this->customWidgetsNamespace !== null) {
                $paths[$this->customWidgetsNamespace . '\\models'] = rtrim($this->customWidgetsPath, '/') . '/models';
            }

            foreach ($paths as $namespace => $path) {

                $path = rtrim(Yii::getAlias($path), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

                $widgetModels = \yii\helpers\FileHelper::findFiles($path);

                foreach ($widgetModels as $key => $model) {
                    $model = str_replace([$path, '.php'], '', $model);
                    $widgets[$model] = rtrim($namespace, "\\") . "\\" . $model;
                }

            }

            $this->widgetModels = $widgets;

        }

        return $this->widgetModels;
    }

    public function getWidgets()
    {

        if ($this->widgets === null) {

            $widgets = [];

            $paths = ['worstinme\widgets\widgets' => '@worstinme/widgets/widgets'];

            if (Yii::$app->has('zoo')) {
                $paths['worstinme\widgets\zoo'] = '@worstinme/widgets/zoo';
            }

            if ($this->customWidgetsPath !== null && $this->customWidgetsNamespace !== null) {
                $paths[$this->customWidgetsNamespace] = $this->customWidgetsPath;
            }


            foreach ($paths as $namespace => $path) {

                $path = rtrim(Yii::getAlias($path), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

                $widgetModels = \yii\helpers\FileHelper::findFiles($path);

                foreach ($widgetModels as $key => $model) {
                    $model = str_replace([$path, ".php"], '', $model);
                    $widgets[$model] = rtrim($namespace, "\\") . "\\" . $model;
                }

            }

            $this->widgets = $widgets;

        }

        return $this->widgets;
    }

    public function checkBounds($bounds)
    {

        $m = Yii::$app->controller->module->id;
        $c = Yii::$app->controller->id;
        $a = Yii::$app->controller->action->id;

        $except = $bounds['except'];
        $only = $bounds['only'];

        if (in_array('//' . $a, $except) || in_array('/' . $c . '/' . $a, $except) || in_array($m . '/' . $c . '/' . $a, $except)) {
            return false;
        }

        if (count($only)) {

            if (in_array('//' . $a, $only) || in_array('/' . $c . '/' . $a, $only) || in_array($m . '/' . $c . '/' . $a, $only)) {
                return true;
            }

            return false;

        }

        return true;

    }

    /** @inheritdoc */
    public function bootstrap($app)
    {
        /* @var $module Module */

        if ($app instanceof \yii\web\Application) {


            if ($this->frontend) {

                //Render widgets
                $app->response->on(\yii\web\Response::EVENT_BEFORE_SEND, function (\yii\base\Event $event) use ($app) {
                    /**
                     * @var $view View
                     */
                    $response = $event->sender;

                    if ($response->format == \yii\web\Response::FORMAT_HTML) {
                        \Yii::beginProfile('Rendering widgets');

                        if (!empty($response->data)) {
                            $response->data = $this->processing($response->data);
                        }

                        if (!empty($response->content)) {
                            $response->content = $this->processing($response->content);
                        }

                        \Yii::endProfile('Rendering widgets');
                    }

                });
            }

            if ($this->backend) {

                if (!$app->hasModule('widgets')) {

                    $configUrlRule = [
                        'class' => 'yii\web\GroupUrlRule',
                        'prefix' => $this->urlPrefix,
                        'rules' => $this->urlRules,
                    ];

                    if ($this->urlPrefix != 'widgets') {
                        $configUrlRule['routePrefix'] = 'widgets';
                    }

                    $rule = Yii::createObject($configUrlRule);

                    $app->urlManager->addRules([$rule], false);

                    $app->setModule('widgets', [
                        'class' => Module::className(),
                    ]);

                    if (!isset($app->get('i18n')->translations['widgets*'])) {
                        $app->get('i18n')->translations['widgets*'] = [
                            'class' => PhpMessageSource::className(),
                            'basePath' => '@worstinme/widgets/messages',
                            'sourceLanguage' => 'en-US'
                        ];
                    }

                }
            }

        }

    }

    /**
     * @param View $view
     */
    protected function processing($html)
    {
        $shortcode = new ShortcodeHelper();
        $shortcode->callbacks = $this->callbacks;
        return $shortcode->parse($html);
    }

}