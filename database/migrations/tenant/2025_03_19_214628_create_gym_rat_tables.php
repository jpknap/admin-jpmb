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
        // Tabla: gym_rat_users
        Schema::create('gym_rat_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });

        // Tabla: routines
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('gym_rat_user_id')->constrained('gym_rat_users')->onDelete('cascade');
            // Se omiten timestamps según el diagrama
        });

        // Tabla: workouts
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_rat_user_id')->constrained('gym_rat_users')->onDelete('cascade');
            // Columna para la fecha del workout; se puede ajustar a timestamp o date según se requiera
            $table->date('date');
            $table->timestamps();
        });

        // Tabla: exercises
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique('exercises_code_unique');
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        // Tabla: workout_routines
        Schema::create('workout_routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_id')->constrained('workouts')->onDelete('cascade');
            $table->foreignId('routine_id')->constrained('routines')->onDelete('cascade');
        });

        // Tabla: workout_routine_exercises
        Schema::create('workout_routine_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_routine_id')->constrained('workout_routines')->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained('exercises')->onDelete('cascade');
            $table->integer('reps');
            $table->float('weight'); // Considera usar decimal('weight', 8, 2) si requieres mayor precisión
            $table->timestamps();
        });

        // Tabla pivot: routine_exercises
        Schema::create('routine_exercises', function (Blueprint $table) {
            $table->foreignId('routine_id')->constrained('routines')->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained('exercises')->onDelete('cascade');
            $table->primary(['routine_id', 'exercise_id']);
        });

        // Tabla: muscle_groups
        Schema::create('muscle_groups', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique('unicode_muscle_group');
            $table->string('title');
            $table->timestamps();
        });

        // Tabla: muscle_sectors
        Schema::create('muscle_sectors', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique('unicode_muscle_sectors');
            $table->string('title');
            $table->timestamps();
        });

        // Tabla pivot: exercise_muscle_groups
        Schema::create('exercise_muscle_groups', function (Blueprint $table) {
            $table->foreignId('exercise_id')->constrained('exercises')->onDelete('cascade');
            $table->foreignId('muscle_group_id')->constrained('muscle_groups')->onDelete('cascade');
            $table->enum('stimulation', ['high', 'medium', 'low']);
            $table->primary(['exercise_id', 'muscle_group_id']);
        });

        // Tabla pivot: sector_muscle_groups
        Schema::create('sector_muscle_groups', function (Blueprint $table) {
            $table->foreignId('muscle_sector_id')->constrained('muscle_sectors')->onDelete('cascade');
            $table->foreignId('muscle_group_id')->constrained('muscle_groups')->onDelete('cascade');
            $table->primary(['muscle_sector_id', 'muscle_group_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sector_muscle_groups');
        Schema::dropIfExists('exercise_muscle_groups');
        Schema::dropIfExists('muscle_sectors');
        Schema::dropIfExists('muscle_groups');
        Schema::dropIfExists('routine_exercises');
        Schema::dropIfExists('workout_routine_exercises');
        Schema::dropIfExists('workout_routines');
        Schema::dropIfExists('exercises');
        Schema::dropIfExists('workouts');
        Schema::dropIfExists('routines');
        Schema::dropIfExists('gym_rat_users');
    }
};
