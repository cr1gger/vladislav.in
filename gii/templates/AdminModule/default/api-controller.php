<?php
/**
 * This is the template for generating a controller class within a module.
 */

/** @var yii\web\View $this */
/** @var yii\gii\generators\module\Generator $generator */

echo "<?php\n";
?>

namespace <?= $generator->getApiControllerNamespace() ?>;

class ExampleController extends \app\modules\control\base\AuthApiController
{
    /**
     * @return void
     */
    public function actionIndex()
    {
        return ['message' => 'Hello'];
    }
}
