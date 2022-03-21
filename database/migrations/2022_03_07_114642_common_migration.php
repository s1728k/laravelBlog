<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CommonMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $this->users_table();
        // $this->password_reset_table();
        $this->countries_table();
        $this->timezones_table();
        $this->translations_table();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = ['countries','timezones','translations'];
        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }

    public function users_table()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function password_reset_table()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function failed_jobs_table()
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    public function personal_access_tokens_table()
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
        });
    }

    public function countries_table()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('iso3',3)->nullable();
            $table->string('iso2',2)->nullable();
            $table->string('numeric_code',4)->nullable();
            $table->string('phone_code')->nullable();
            $table->string('capital')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_name')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('tld')->nullable();
            $table->string('native')->nullable();
            $table->string('region')->nullable();
            $table->string('subregion')->nullable();
            $table->double('latitude',10,2)->nullable();
            $table->double('longitude',10,2)->nullable();
            $table->string('emoji')->nullable();
            $table->string('emojiU')->nullable();
            $table->timestamps();
        });
    }

    public function timezones_table()
    {
        Schema::create('timezones', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('country_id');
            $table->string('zoneName')->nullable();
            $table->integer('gmtOffset')->nullable();
            $table->string('gmtOffsetName')->nullable();
            $table->string('abbreviation')->nullable();
            $table->string('tzName')->nullable();
            $table->timestamps();
        });
    }

    public function translations_table()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('country_id');
            $table->string('kr')->nullable();
            $table->string('br')->nullable();
            $table->string('pt')->nullable();
            $table->string('nl')->nullable();
            $table->string('hr')->nullable();
            $table->string('fa')->nullable();
            $table->string('de')->nullable();
            $table->string('es')->nullable();
            $table->string('fr')->nullable();
            $table->string('ja')->nullable();
            $table->string('it')->nullable();
            $table->string('cn')->nullable();
            $table->timestamps();
        });
    }
}
