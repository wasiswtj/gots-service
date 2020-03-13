<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParameterGotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameter_gots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key_parameter');
            $table->string('value_parameter');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });

        // Seeding the table
        DB::table('parameter_gots')->insert(
            ['key_parameter' => 'rate_sewa_modal', 'value_parameter' => '0.011'],
            ['key_parameter' => 'jangka_rate_sewa_modal', 'value_parameter' => '15'],
            ['key_parameter' => 'masa_gadai', 'value_parameter' => '120']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameter_gots');
    }
}
