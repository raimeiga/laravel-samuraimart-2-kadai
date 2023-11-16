<?php

namespace App\Admin\Controllers;

use App\Models\ShoppingCart;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShoppingCartController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ShoppingCart';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShoppingCart());

        $grid->column('identifier', __('ID'))->sortable();
        $grid->column('instance', __('User ID'))->sortable();
        $grid->column('price_total', __('Price total'))->totalRow();  //totalRow()を付与すると、合計を表示できる
        $grid->column('qty', __('Qty'))->totalRow();                  //totalRow()を付与すると、合計を表示できる
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->disableIdFilter();    //IDでのフィルターを使えなくしている
            $filter->equal('identifier', 'ID');  //identifierでIDフィルターを追加
            $filter->equal('instance', 'User ID');
            $filter->between('created_at', '登録日')->datetime();
        });

        $grid->disableCreateButton();    //新規作成は不要なので、disableCreateButton()を使って操作できないようにしてい
        $grid->actions(function ($actions) {  //表示・編集・削除は不要なので、actions()を使って操作できないようにしている
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        });


        return $grid;
    }

}
