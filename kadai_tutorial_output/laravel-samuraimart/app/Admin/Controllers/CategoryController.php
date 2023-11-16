<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\MajorCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());
        
        /*　↓ソート機能＝ソートできるようにしたいカラム(↓ 'id','created_at','updated_at')に、sortable()を付与
              　　　　　 カテゴリーの一覧画面を表示すると、カラムの横にソート用のボタンが表示される　*/        
        $grid->column('id', __('Id'))->sortable();  
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('major_category_id', __('Major category name'))->editable('select', MajorCategory::all()->pluck('name', 'id'));
        $grid->column('created_at', __('Created at'))->sortable();  
        $grid->column('updated_at', __('Updated at'))->sortable(); 

        // フィルタ機能　↓「grid->filter(function($filter) {　　}」＝｛　｝の中にフィルタ条件を追加
        $grid->filter(function($filter) {
            //$filter->like() = 部分一致のフィルタを追加する関数 第1引数にカラム名、第2引数に画面に表示する文字列を指定
            $filter->like('name', 'カテゴリー名');   
            $filter->in('major_category_id', '親カテゴリー名')->multipleSelect(MajorCategory::all()->pluck('name', 'id')); 
            // $filter->between()= 範囲指定のフィルタを追加する関数 datetime()を付与することで、カレンダーを表示して指定できるようになる
            $filter->between('created_at', '登録日')->datetime();  
        });                                                      
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('major_category.name', __('Major category name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->select('major_category_id', __('Major Category Name'))->options(MajorCategory::all()->pluck('name', 'id'));

        return $form;
    }
}
