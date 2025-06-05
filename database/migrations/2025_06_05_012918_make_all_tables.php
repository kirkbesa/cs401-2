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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name', 1)->comment('A - Admin, C - Contributor, S - Subscriber');
            $table->string('description')->comment('Description of the role');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Title of a post');
            $table->text('content')->comment('Content of a post');
            $table->string('slug')->comment('URL Identifier of a post');
            $table->timestamp('publication_date')->nullable()->comment('Publication date of a post');
            $table->timestamp('last_modified_date')->nullable()->comment('Last modified date of a post');
            $table->string('status', 1)->comment('D - Draft, P - Published, I - Inactive');
            $table->text('featured_image_url')->comment('Featured image URL of a post');
            $table->integer('views_count')->default(0)->comment('Number of views for a post');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name', 30)->comment('Name of the category');
            $table->string('slug')->comment('URL Identifier of the category');
            $table->string('description')->comment('Description of the category');
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag_name', 45)->comment('Name of the tag');
            $table->string('slug')->comment('URL Identifier of the tag');
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment_content')->comment('Content of the comment');
            $table->timestamp('comment_date')->comment('Date when the comment was made');
            $table->string('reviewer_name')->nullable()->comment('Name of the reviewer');
            $table->string('reviewer_email')->nullable()->comment('Email of the reviewer');
            $table->boolean('is_hidden')->default(false)->comment('Indicates if the comment is hidden');
        });

        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->comment('Name of the media file');
            $table->string('file_type', 10)->comment('Type of the media file (e.g., image, video, audio)');
            $table->integer('file_size')->default(0)->comment('Size of the media file in bytes');
            $table->string('url')->comment('URL of the media file');
            $table->timestamp('upload_date')->comment('Date when the media file was uploaded');
            $table->string('description')->nullable()->comment('Description of the media file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
};
