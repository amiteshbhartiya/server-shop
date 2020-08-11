<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\ServerDetail;

class AddCapacityToServerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('server_details', function (Blueprint $table) {
            $table->big('capacityMB')->nullable();
            
            ServerDetail::chunk(100, function ($computers) {
                foreach ($computers as $computer) {
                    if (preg_match('/(\d+)x(\d+)(M|G|T)B/', $computer->hardisk, $m)) {
                        $capacity = $m[1];
                        $capacity *= $m[3] === 'M' ? 1 : ($m[3] === 'G' ? 1000 : 1000000 );
                        $computer->capacityMB = $capacity * $m[2];
                        $computer->save();
                    }
                }
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('server_details', function (Blueprint $table) {
            //
        });
    }
}
