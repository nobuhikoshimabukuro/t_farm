<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (Schema::hasTable('merchandise_image_t')) {
            // テーブルが存在していればリターン
            return;
        }

        Schema::create('merchandise_image_t', function (Blueprint $table) {


            $table
                ->increments('id')
                ->comment('連番');

            $table
                ->integer('merchandise_id')
                ->comment('商品ID');

            $table
                ->integer('branch_number')
                ->comment('枝番');

            $table
                ->string('title')
                ->nullable()
                ->comment('画像タイトル');

            $table
                ->string('folder_name')
                ->nullable()
                ->comment('フォルダ名');

            $table
                ->integer('used_flg')
                ->nullable()
                ->default(0)
                ->comment('使用フラグ:0=>表示しない 1=>表示する');

            $table
                ->integer('display_order')
                ->nullable()
                ->default(0)
                ->comment('並び順');

            $table
                ->dateTime('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->comment('作成日時:自動生成');

            $table
                ->integer('created_by')
                ->nullable()
                ->comment('作成者');

            $table
                ->dateTime('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))
                ->comment('更新日時:自動生成');

            $table
                ->integer('updated_by')
                ->nullable()
                ->comment('更新者');

            $table
                ->dateTime('deleted_at')
                ->nullable()
                ->comment('削除日時');

            $table
                ->integer('deleted_by')
                ->nullable()
                ->comment('削除者');

            
        });

        // ALTER 文を実行しテーブルにコメントを設定
        DB::statement("ALTER TABLE merchandise_image_t COMMENT '商品画像管理テーブル'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchandise_image_t');
    }
};
