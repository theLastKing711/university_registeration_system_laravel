<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('department_id')
                ->constrained();
            $table->string('name');
            $table->string('code');
            $table->boolean('is_active')->default(true);
            $table->integer('credits'); // https://www.google.com/search?q=what+is+course+credits&sca_esv=7255129cf57cea14&rlz=1C1MMCH_enSY1151SY1151&sxsrf=AHTn8zq0Y-wFMYoVCKxsxAgQdweaUFBe7Q%3A1747955570994&ei=cq8vaMTBPKqGxc8P2bSK-A0&ved=0ahUKEwjEwpH3mbiNAxUqQ_EDHVmaAt8Q4dUDCBA&uact=5&oq=what+is+course+credits&gs_lp=Egxnd3Mtd2l6LXNlcnAiFndoYXQgaXMgY291cnNlIGNyZWRpdHMyCxAAGIAEGJECGIoFMgsQABiABBiRAhiKBTILEAAYgAQYkQIYigUyBRAAGIAEMgoQABiABBgUGIcCMgUQABiABDIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeSJ4YULUHWKoXcAN4AZABAJgB9AGgAfcKqgEDMi02uAEDyAEA-AEBmAIJoAKhC8ICChAAGLADGNYEGEfCAgcQABiABBgKmAMAiAYBkAYIkgcFMy4wLjagB6ImsgcDMi02uAeTCw&sclient=gws-wiz-serp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
