<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => '主菜单', 'options' => ['class' => 'header']],

                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => '产品管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => '产品列表', 'icon' => 'fa fa-file-code-o', 'url' => ['/product/product/index'],],
                            ['label' => '产品分类', 'icon' => 'fa fa-dashboard', 'url' => ['/product/product-category/index'],],
                        ],
                    ],
                    [
                        'label' => '用户管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => '用户列表', 'icon' => 'fa fa-file-code-o', 'url' => ['/users/users/index'],],
                            ['label' => '用户劳保产品', 'icon' => 'fa fa-dashboard', 'url' => ['/guarantee/guarantee/index'],],
                        ],
                    ],
                    ['label' => '轮播图管理', 'icon' => 'fa fa-file-code-o', 'url' => ['/ad/ad/index']],
                    ['label' => '网站配置', 'icon' => 'fa fa-file-code-o', 'url' => ['/cfg/cfg/index']],
                    ['label' => '页面管理', 'icon' => 'fa fa-dashboard', 'url' => ['/pages/pages/index']],
                ],
            ]
        ) ?>

    </section>

</aside>
