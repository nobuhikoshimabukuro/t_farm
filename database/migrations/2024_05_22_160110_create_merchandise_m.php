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
        if (Schema::hasTable('merchandise_m')) {
            // テーブルが存在していればリターン
            return;
        }

        Schema::create('merchandise_m', function (Blueprint $table) {

            $table
                ->increments('merchandise_id')
                ->comment('商品ID:連番');

            $table
                ->string('merchandise_name')
                ->nullable()
                ->comment('商品名');

            $table
                ->text('merchandise_description')
                ->nullable()
                ->comment('商品説明');

            $table
                ->integer('price')
                ->nullable()
                ->default(0)
                ->comment('料金（販売サイトの金額で設定すること）');

            $table
                ->string('sales_url')
                ->nullable()
                ->comment('販売サイト商品別url');

            $table
                ->integer('used_flg')
                ->nullable()
                ->default(0)
                ->comment('使用フラグ:0=>表示しない 1=>表示する');

            $table
                ->integer('sales_flg')
                ->nullable()
                ->default(0)
                ->comment('販売フラグ:0=>完売 1=>販売中');

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
        DB::statement("ALTER TABLE merchandise_m COMMENT '商品マスタ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchandise_m');
    }
};
