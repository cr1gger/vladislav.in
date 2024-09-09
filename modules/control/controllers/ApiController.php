<?php

namespace app\modules\control\controllers;

use app\modules\control\base\AbstractApiController;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use Yii;
use yii\web\NotFoundHttpException;

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

        Yii::error('qweqweqwe');
        $this->log();

        return $module->runAction($route, $this->request->queryParams);
    }

    private function log() {

        Yii::info('Привет');
//        $this->logger->info('Логирую другую информацию!', [
//            'category' => 'api-request'
//        ]);
    }
}