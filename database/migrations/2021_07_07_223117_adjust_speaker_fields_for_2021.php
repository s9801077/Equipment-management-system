<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdjustSpeakerFieldsFor2021 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('speakers', function (Blueprint $table) {
            $table->string('summary', 480)->change();
            $table->boolean('will_forward_posts')->nullable()->after('promotion')->comment="願意轉發大會文章";
            $table->string('target_audience', 64)->nullable()->after('level')->comment="目標會眾";
            $table->string('prerequisites', 120)->nullable()->after('target_audience')->comment="先備知識";
            $table->string('contact_address')->nullable()->after('contact_phone')->comment="寄送地址";
            $table->string('link_pre_video')->nullable()->after('link_slide')->comment="預錄影片連結";
            $table->boolean('agree_act_change')->nullable()->after('has_companion')->comment="知悉活動可能變更";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('speakers', function (Blueprint $table) {
            $table->dropColumn('will_forward_posts');
            $table->dropColumn('target_audience');
            $table->dropColumn('prerequisites');
            $table->dropColumn('contact_address');
            $table->dropColumn('link_pre_video');
            $table->dropColumn('agree_act_change');
        });
    }
}
