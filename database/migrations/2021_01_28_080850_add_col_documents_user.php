<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColDocumentsUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users','driving_licence')) {
              $table->string('driving_licence')->after('is_approved')->nullable();
              $table->string('vehicle_insurance')->after('driving_licence')->nullable();
              $table->string('backgroud_check')->after('vehicle_insurance')->nullable();
              $table->string('fill_out_w9')->after('backgroud_check')->nullable();
              $table->string('agree_contractor_terms')->after('fill_out_w9')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('driving_licence');
            $table->dropColumndropColumn('vehicle_insurance');
            $table->dropColumn('backgroud_check');
            $table->dropColumn('fill_out_w9');
            $table->dropColumn('agree_contractor_terms');
        });
    }
}
