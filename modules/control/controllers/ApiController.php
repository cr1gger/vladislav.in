<?php

namespace app\modules\control\controllers;

use app\modules\control\base\AbstractApiController;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Request;

class ApiController extends AbstractApiController
{
    public LoggerInterface $logger;

    public function __construct($id, $module, LoggerInterface $logger, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->logger = $logger;
    }

    public function actionIndex($controlApiModule, $controlApiEndpoint, $controlApiOperation = 'index')
    {
        // TODO: проверять наличие всех параметров
        $control = Yii::$app->getModule('control');

        $moduleExist = $control->hasModule($controlApiModule);

        if (!$moduleExist) {
            throw new NotFoundHttpException('Module not found');
        }

        $module = $control->getModule($controlApiModule);

        $route = sprintf('%s/%s', $controlApiEndpoint, $controlApiOperation);

        $reflect = new ReflectionClass($module);
        $moduleNamespace = $reflect->getNamespaceName();

        $module->controllerNamespace = sprintf('%s\\api\\controllers', $moduleNamespace);

        $this->log($controlApiModule, $controlApiEndpoint, $controlApiOperation);

        return $module->runAction($route, $this->request->queryParams);
    }

    private function log($controlApiModule, $controlApiEndpoint, $controlApiOperation)
    {
        $user = Yii::$app->user->identity ?? null;

        $request = $this->request ?? Yii::$app->request;
        $ip = $request instanceof Request ? $request->getUserIP() : '-';
        $logData = [
            'guest' => Yii::$app->user->isGuest,
            'datetime' => date('Y-m-d H:i:s'),
            'module' => $controlApiModule,
            'controller' => $controlApiEndpoint,
            'action' => $controlApiOperation,
            'ip' => $ip,
            'category' => 'app/api_access',
        ];

        if ($user) {
            $logData['user'] = $user->username;
            $logData['userId'] = $user->id;
        }

        $this->logger->info('Доступ к API', $logData);
    }
}