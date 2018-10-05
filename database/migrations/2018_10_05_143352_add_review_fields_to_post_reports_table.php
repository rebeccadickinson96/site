<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewFieldsToPostReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_reports', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('action')->nullable();
            $table->text('reviewer_comment')->nullable();
            $table->string('review_date');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_reports', function (Blueprint $table) {
            $table->dropForeign('post_reports_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('action');
            $table->dropColumn('reviewer_comment');
            $table->dropColumn('review_date');
            $table->dropSoftDeletes();
        });
    }
}
