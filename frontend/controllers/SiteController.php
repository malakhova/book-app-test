<?php

namespace frontend\controllers;

use frontend\forms\SubscribeForm;
use frontend\services\SubscriptionService;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function __construct(
        $id,
        $module,
        protected SubscriptionService $subscriptionService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }


    /**
     * Subscribe form
     * @return string|Response
     */
    public function actionSubscribe(): Response|string
    {
        $form = new SubscribeForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $subscription = $this->subscriptionService->createSubscription($form->phone, $form->authorId);
            if (!empty($subscription->id)) {
                Yii::$app->session->setFlash('success', 'Вы подписались на уведомления');
                return $this->redirect(['index']);
            }
        }

        return $this->render('subscribe', [
            'model' => $form,
            //todo можно сюда список авторов для рендера
        ]);
    }

    /**
     * Displays homepage.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
