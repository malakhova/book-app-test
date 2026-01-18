<?php

namespace backend\controllers;

use backend\services\BookServiceInterface;
use common\models\Role;
use common\services\NotificationService;
use common\services\NotificationServiceInterface;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class BookController extends Controller
{
    public function __construct(
        $id,
        $module,
        protected BookServiceInterface $bookService,
        protected NotificationServiceInterface $notificationService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [Role::ADMIN]
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Book models.
     * @return string
     */
    public function actionIndex(): string
    {
        //todo dataProvider, searchModel
        return $this->render('index');
    }

    /**
     * View an existing Book model.
     * @param int $id
     * @return string
     */
    public function actionView(int $id): string
    {
        $book = $this->bookService->getOneByIdWithAuthors($id);
        return $this->render('view', [
            'book' => $book,
        ]);
    }

    /**
     * Creates a new Book model.
     * @return string|Response
     */
    public function actionCreate(): Response|string
    {
        $params = Yii::$app->request->post();
        $book = $this->bookService->createByParams($params);

        if (!empty($book->id)) {
            $this->notificationService->notifySubscribersByBookId($book->id);
            Yii::$app->session->addFlash('success', 'Book created');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $book
        ]);
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return Response|string
     */
    public function actionUpdate(int $id): Response|string
    {
        $params = Yii::$app->request->post();
        $book = $this->bookService->getOneById($id);
        if ($this->bookService->update($book, $params)) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $book
        ]);
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return Response
     */
    public function actionDelete(int $id): Response
    {
        if (false === $this->bookService->deleteById($id)) {
            Yii::$app->session->addFlash('error', 'Cannot delete book');
        }
        return $this->redirect(['index']);
    }
}
