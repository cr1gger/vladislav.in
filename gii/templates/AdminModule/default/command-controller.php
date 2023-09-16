<?php
/**
 * This is the template for generating a controller class within a module.
 */

/** @var yii\web\View $this */
/** @var yii\gii\generators\module\Generator $generator */

echo "<?php\n";
?>

namespace <?= $generator->getCommandsNamespace() ?>;

class DefaultController extends \yii\console\Controller
{
    /**
     * @return void
     */
    public function actionIndex()
    {
        echo "Hello world!\n";
    }
}
