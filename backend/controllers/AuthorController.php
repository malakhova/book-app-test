<?php

namespace backend\controllers;

use backend\services\AuthorServiceInterface;
use common\models\Role;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class AuthorController extends Controller
{
    public function __construct(
        $id,
        $module,
        protected AuthorServiceInterface $authorService,
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
     * Lists all Authors models.
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * View an existing Author model.
     * @param int $id
     * @return string
     */
    public function actionView(int $id): string
    {
        $author = $this->authorService->getOneById($id);
        return $this->render('view', [
            'author' => $author,
        ]);
    }

    /**
     * Creates a new Author model.
     * @param int $id
     * @return string|Response
     */
    public function actionCreate(int $id): Response|string
    {
        $params = Yii::$app->request->post();
        $author = $this->authorService->createByParams($params);

        if (!empty($author->id)) {
            Yii::$app->session->addFlash('success', 'Author created');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $author,
        ]);
    }

    /**
     * Updates an existing Author model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return Response|string
     */
    public function actionUpdate(int $id): Response|string
    {
        $params = Yii::$app->request->post();
        $author = $this->authorService->getOneById($id);
        if ($this->authorService->update($author, $params)) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $author
        ]);
    }

    /**
     * Deletes an existing Author model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return Response
     */
    public function actionDelete(int $id): Response
    {
        if (false === $this->authorService->deleteById($id)) {
            Yii::$app->session->addFlash('error', 'Cannot delete author');
        }
        return $this->redirect(['index']);
    }

}
