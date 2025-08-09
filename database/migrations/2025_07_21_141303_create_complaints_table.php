<?php

use App\Enum\PriorityEnum;
use App\Enum\StatusEnum;
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
        Schema::create('complaint_types', function (Blueprint $table){
            $table->id();
            $table->string('name')->default('');
            $table->string('slug')->nullable()->unique();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('subject')->nullable();
            $table->string('complainant')->nullable(); // Pengadu Bisa Null Jika Anonim
            $table->boolean('anonim')->default(false);
            $table->text('description')->nullable();
            $table->text('location');
            $table->foreignId('complaint_type_id')->index();
            $table->enum('complaint_status', [StatusEnum::class])->default(StatusEnum::NEW);
            $table->enum('complaint_prorities',[PriorityEnum::class])->default(PriorityEnum::LOW);
            $table->foreignId('assigned_to')->nullable()->index()->constrained(
                table: 'users', indexName: 'complaints_assigned_to'
            );
            $table->text('proof_of_complaint')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('complaint_notes', function(Blueprint $table){
            $table->id();
            $table->foreignId('complaint_id')->index();
            $table->foreignId('created_by')->nullable()->index()->constrained(
                table: 'users', indexName: 'complaint_notes_created_by'
            );
            $table->text('note');
            $table->text('file')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_types');
        Schema::dropIfExists('complaints');
        Schema::dropIfExists('complaint_files');
        Schema::dropIfExists('complaint_notes');
        Schema::dropIfExists('complaint_note_files');
        Schema::dropIfExists('complaint_rejections');
    }
};
