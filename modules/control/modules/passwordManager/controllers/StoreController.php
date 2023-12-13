<?php

namespace app\modules\control\modules\passwordManager\controllers;

use app\modules\control\modules\passwordManager\models\forms\CreatePmStoreForm;
use app\modules\control\modules\passwordManager\models\PmCategory;
use app\modules\control\modules\passwordManager\models\PmStore;
use app\modules\control\modules\passwordManager\services\CategoryService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreController implements the CRUD actions for PmStore model.
 */
class StoreController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PmStore models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $categoryList = CategoryService::instance()->getCategoryByUser(Yii::$app->user->identity->id);

        return $this->render('index', [
            'categoryList' => $categoryList
        ]);
    }

    /**
     * Displays a single PmStore model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PmStore model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CreatePmStoreForm();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->create()) {
                return $this->redirect(['view', 'id' => $model->model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PmStore model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelForm = CreatePmStoreForm::initByModel($model);

        if ($this->request->isPost && $modelForm->load($this->request->post()) && $modelForm->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'modelForm' => $modelForm,
        ]);
    }

    /**
     * Deletes an existing PmStore model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionFolder($id)
    {
        $category = PmCategory::findOne(['id' => $id, 'owner' => Yii::$app->user->getId()]);

        if (!$category) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => PmStore::find()->where(['category_id' => $id]),
        ]);

        return $this->render('folder', [
            'dataProvider' => $dataProvider,
            'category' => $category,
        ]);
    }

    public function actionRemoveFolder($id)
    {
        $category = PmCategory::findOne($id);

        if (!$category) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($category->passwordCount) {
            throw new NotFoundHttpException('Невозможно удалить папку с паролями');
        }

        $category->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PmStore model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PmStore the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PmStore::findOne(['id' => $id, 'owner' => Yii::$app->user->getId()])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
