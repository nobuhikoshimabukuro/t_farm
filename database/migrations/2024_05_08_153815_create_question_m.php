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
    public function up(): void
    {
        if (Schema::hasTable('question_m')) {
            // テーブルが存在していればリターン
            return;
        }

        Schema::create('question_m', function (Blueprint $table) {

            $table
                ->increments('question_id')
                ->comment('商品ID:連番');

            $table
                ->text('question')
                ->nullable()
                ->comment('質問');

            $table
                ->text('answer')
                ->nullable()
                ->comment('答え');

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
        DB::statement("ALTER TABLE question_m COMMENT '質問マスタ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_m');
    }
};
