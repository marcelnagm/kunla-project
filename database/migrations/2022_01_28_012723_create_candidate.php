<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate', function (Blueprint $table) {
            $table->id();
            $table->string('gid')->nullable(false)->unique();            
            $table->unsignedBigInteger('role_id')->nullable(false);
            $table->string('title')->nullable(false);            
            $table->float('payment')->nullable(false)->defaul(0);
            $table->string('CID')->nullable(false); 
            $table->unsignedBigInteger('state_id')->nullable(false);
            $table->string('city')->nullable(false);             
            $table->boolean('remote')->defaul(0)->nullable(false);            
            $table->boolean('move_out')->defaul(0)->nullable(false);                        
            $table->string('description')->nullable(false);             
            $table->string('tecnical_degree')->nullable(true);             
            $table->string('superior_degree')->nullable(true);             
            $table->string('spec_degree')->nullable(true);             
            $table->string('mba_degree')->nullable(true);             
            $table->string('master_degree')->nullable(true);             
            $table->string('doctor_degree')->nullable(true);             
            $table->unsignedBigInteger('english_level')->nullable(false);
            $table->string('full_name')->nullable(false);             
            $table->string('cellphone')->nullable(false);             
            $table->string('email')->nullable(false);             
            $table->string('cv_url')->nullable(false);             
            $table->timestamp('published_at')->nullable(true);
            $table->unsignedBigInteger('status_id')->nullable(false);            
            $table->foreign('role_id')->references('id')->on('candidate_role');
            $table->foreign('english_level')->references('id')->on('candidate_english_level');
            $table->foreign('status_id')->references('id')->on('candidate_status');
            $table->foreign('state_id')->references('id')->on('state');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate');
    }
}
