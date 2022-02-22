<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->integer('region_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('is_superadmin');
            $table->timestamps();
        });

        $admin = new Admin();
        $admin->first_name = Admin::DEFAULT_ADMIN['first_name'];
        $admin->last_name = Admin::DEFAULT_ADMIN['last_name'];
        $admin->email = Admin::DEFAULT_ADMIN['email'];
        $admin->password = Hash::make(Admin::DEFAULT_ADMIN['password']);
        $admin->is_superadmin = Admin::DEFAULT_ADMIN['is_superadmin'];
        $admin->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
