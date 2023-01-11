<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('file')->nullable();
            $table->string('mime_type')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('seller_documents');
    }
};
