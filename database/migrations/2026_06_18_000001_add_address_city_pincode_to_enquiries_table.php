<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressCityPincodeToEnquiriesTable extends Migration
{
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->longText('address')->nullable()->after('phone');
            $table->string('city')->nullable()->after('address');
            $table->string('pincode', 20)->nullable()->after('city');
        });
    }

    public function down()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn(['address', 'city', 'pincode']);
        });
    }
}
