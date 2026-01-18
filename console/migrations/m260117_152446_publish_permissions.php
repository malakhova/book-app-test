<?php

use common\models\Role;
use common\models\Permission;
use yii\db\Migration;

class m260117_152446_publish_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->createRole(Role::ADMIN);
        $admin->description = 'Admin';
        $auth->add($admin);


        $manageAuthor = $auth->createPermission(Permission::MANAGE_AUTHOR);
        $manageAuthor->description = 'Manage author';
        $auth->add($manageAuthor);
        $auth->addChild($admin, $manageAuthor);

        $manageBook = $auth->createPermission(Permission::MANAGE_BOOK);
        $manageBook->description = 'Manage book';
        $auth->add($manageBook);
        $auth->addChild($admin, $manageBook);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->remove($auth->getRole(Role::ADMIN));
        $auth->remove($auth->getPermission(Permission::MANAGE_AUTHOR));
        $auth->remove($auth->getPermission(Permission::MANAGE_BOOK));
    }
}
