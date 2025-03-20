# ER Model for Gym Workout Application

This document describes the Entity-Relationship (ER) model for a gym workout management application built with Laravel 6. The model defines the relationships between users, routines, workouts, exercises, muscle groups, and sectors.

## Entities and Relationships

- **GYM_RAT_USER:** Represents the user who creates routines and registers workouts.
- **ROUTINE:** Defines the exercise plan or routine created by the user.
- **WORKOUT:** Logs the workout session (a day of training) performed by the user.
- **WORKOUT_ROUTINE:** Associates a workout session with the routine executed on that day.
- **WORKOUT_ROUTINE_EXERCISE:** Stores the execution details of an exercise during a workout, including repetitions and weight.
- **EXERCISE:** Defines each exercise, which can be part of a pre-defined routine or added ad hoc during the workout.
- **ROUTINE_EXERCISE:** Intermediate table linking the exercises that make up a routine.
- **MUSCLE_GROUP:** Represents specific muscle groups (e.g., anterior, medial, or posterior parts).
- **MUSCLE_SECTOR:** Groups muscle groups into broader categories (e.g., back, shoulders).
- **EXERCISE_MUSCLE_GROUP:** Links an exercise with a muscle group and defines the intensity of stimulation (values: high, medium, low).
- **SECTOR_MUSCLE_GROUP:** Associates muscle groups with their corresponding muscle sectors.

## Mermaid ER Diagram

```mermaid
erDiagram
    USER {
      int id
      string firstnam
      string email
      timestamp email_verified_at
      string password
    }
    
    GYM_RAT_USER {
      int id
      int user_id
      timestamps created_at
      timestamps updated_at
    }
    
    ROUTINE {
      int id
      string title
      int gym_rat_user_id
    }
    
    WORKOUT {
      int id
      int gym_rat_user_id
      timestamps date
      timestamps created_at
      timestamps updated_at
    }
    
    WORKOUT_ROUTINE {
      int id
      int workout_id
      int routine_id
    }
    
    WORKOUT_ROUTINE_EXERCISE {
      int id
      int workout_routine_id
      int exercise_id
      int reps
      float weight
      timestamps created_at
      timestamps updated_at
    }
    
    EXERCISE {
      int id
      string title
      string code
      text description
      timestamps created_at
      timestamps updated_at
    }
    
    ROUTINE_EXERCISE {
      int routine_id
      int exercise_id
    }
    
    MUSCLE_GROUP {
      int id
      string code
      string title
      timestamps created_at
      timestamps updated_at
    }
    
    MUSCLE_SECTOR {
      int id
      string code
      string title
      timestamps created_at
      timestamps updated_at
    }
    
    EXERCISE_MUSCLE_GROUP {
      int exercise_id
      int muscle_group_id
      string stimulation 
    }
    
    SECTOR_MUSCLE_GROUP {
      int muscle_sector_id
      int muscle_group_id
    }

    %% Relaciones
    USER ||--o{ GYM_RAT_USER : "is linked to"
    GYM_RAT_USER ||--o{ ROUTINE : "creates"
    GYM_RAT_USER ||--o{ WORKOUT : "performs"
    
    ROUTINE ||--o{ ROUTINE_EXERCISE : "includes"
    EXERCISE ||--o{ ROUTINE_EXERCISE : "belongs to"
    
    WORKOUT ||--o{ WORKOUT_ROUTINE : "associates"
    ROUTINE ||--o{ WORKOUT_ROUTINE : "executed as"
    
    WORKOUT_ROUTINE ||--o{ WORKOUT_ROUTINE_EXERCISE : "records"
    EXERCISE ||--o{ WORKOUT_ROUTINE_EXERCISE : "performed"
    
    EXERCISE ||--o{ EXERCISE_MUSCLE_GROUP : "targets"
    MUSCLE_GROUP ||--o{ EXERCISE_MUSCLE_GROUP : "associated with"
    
    MUSCLE_SECTOR ||--o{ SECTOR_MUSCLE_GROUP : "includes"
    MUSCLE_GROUP ||--o{ SECTOR_MUSCLE_GROUP : "belongs to"

