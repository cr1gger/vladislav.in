<?php

namespace app\modules\control\modules\users\controllers;

use app\modules\control\modules\users\models\forms\UserCreateForm;
use app\modules\control\modules\users\models\forms\UserUpdateForm;
use app\modules\control\modules\users\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `users` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $usersQuery = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $usersQuery
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    public function actionCreate()
    {
        $model = new UserCreateForm();
        $data = \Yii::$app->request->post();

        if ($model->load($data) && $model->create()) {
            return $this->redirect(['index']); // TODO: redirect update
        }

        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id)
    {
        $user = User::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException('Пользователь не найден');
        }

        $model = UserUpdateForm::create($user);
        $data = \Yii::$app->request->post();

        if ($model->load($data) && $model->update()) {
            return $this->redirect(['index']); // TODO: success
        }

        return $this->render('update', compact('model'));
    }
}
