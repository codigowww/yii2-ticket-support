<?php
/**
 * @author akiraz@bk.ru
 * @link https://github.com/akiraz2/yii2-ticket-support
 * @copyright 2018 akiraz2
 * @license MIT
 */

namespace akiraz2\support;

use Yii;
use yii\queue\Queue;

/**
 * support module definition class
 */
class Module extends \yii\base\Module
{
    /** @var string DB type `sql` or `mongodb` */
    public $dbType = 'sql';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'akiraz2\support\controllers';

    /** @var linked user (for example, 'common\models\User::class' */
    public $userModel;

    /** @var string Primary Key for user table, by default 'id' */
    public $userPK = 'id';

    /** @var string username uses in view (may be field `username` or `email` or `login`) */
    public $userName = 'username';

    /** @var string email field in user table */
    public $userEmail = 'email';

    /** @var string url for viewing user model, use in views/ticket/manage */
    public $urlViewUser;

    /** @var array Mailer configuration */
    public $mailer = [];

    /** @var string The Administrator permission name. for future possible usage. */
    public $adminPermission;

    /** @var string need to create correct Url from backend when notify by email */
    public $urlManagerFrontend = 'urlManager';

    public $notifyByEmail = true;

    /** @var string config.php: `'id' => 'app-backend',` */
    public $appBackendId = 'app-backend';

    /** @var bool|function for accessRule matchCallback
     * for example,
     *      'adminMatchCallback' => function () {
     *          return \Yii::$app->user->identity->getIsAdmin();
     *      }
     */
    public $adminMatchCallback = true;

    /** @var string wysiwyg component for creating content of ticket */
    public $redactorModule = 'redactor';

    /** @var string|Queue component for queue  */
    public $queueComponent = 'queue';

    public $countDaysToClose = 7;

    /**
     * Translate message
     * @param $message
     * @param array $params
     * @param null $language
     * @return mixed
     *
     * public static function t($message, $params = [], $language = null)
     * {
     * return Yii::$app->getModule('support')->translate($message, $params, $language);
     * }*/

    /**
     * Translate message
     * @param $message
     * @param array $params
     * @param null $language
     * @return mixed
     */
    public static function translate($message, $params = [], $language = null)
    {
        return self::t('support', $message, $params, $language);
    }

    /**
     * Translates a message to the specified language.
     *
     * This is a shortcut method of [[\yii\i18n\I18N::translate()]].
     *
     * The translation will be conducted according to the message category and the target language will be used.
     *
     * You can add parameters to a translation message that will be substituted with the corresponding value after
     * translation. The format for this is to use curly brackets around the parameter name as you can see in the following example:
     *
     * ```php
     * $username = 'Alexander';
     * echo \Yii::t('app', 'Hello, {username}!', ['username' => $username]);
     * ```
     *
     * Further formatting of message parameters is supported using the [PHP intl extensions](http://www.php.net/manual/en/intro.intl.php)
     * message formatter. See [[\yii\i18n\I18N::translate()]] for more details.
     *
     * @param string $category the message category.
     * @param string $message the message to be translated.
     * @param array $params the parameters that will be used to replace the corresponding placeholders in the message.
     * @param string $language the language code (e.g. `en-US`, `en`). If this is null, the current
     * [[\yii\base\Application::language|application language]] will be used.
     *
     * @return string the translated message.
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('akiraz2/' . $category, $message, $params, $language);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    public function isMongoDb()
    {
        return $this->dbType === 'mongodb';
    }

    public function getIsBackend()
    {
        return Yii::$app->id === $this->appBackendId;
    }
}