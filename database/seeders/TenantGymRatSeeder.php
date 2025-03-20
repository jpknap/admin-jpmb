<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantGymRatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            tenancy()->initialize($tenant);

            $this->populateMuscularsGroups();
            $this->populateExercises();
            tenancy()->end();
        }

    }

    protected function populateMuscularsGroups(): void
    {
        // Insertar muscularSector musculares con código en inglés
        $muscularSector = [
            ['title' => 'Pecho', 'code' => 'SEC_CHEST'],
            ['title' => 'Hombros', 'code' => 'SEC_SHOULDERS'],
            ['title' => 'Brazos', 'code' => 'SEC_ARMS'],
            ['title' => 'Espalda', 'code' => 'SEC_BACK'],
            ['title' => 'Abdomen', 'code' => 'SEC_CORE'],
            ['title' => 'Piernas', 'code' => 'SEC_LEGS'],
        ];

        $sectorId = [];
        foreach ($muscularSector as $sector) {
            $id = DB::table('muscle_sectors')->insertGetId([
                'title' => $sector['title'],
                'code' => $sector['code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $sectorId[$sector['title']] = $id;
        }

        // Definir grupos musculares con sus respectivos muscularSector y código en inglés
        $muscularGroups = [
            // Grupos del pecho
            ['title' => 'Pectoral Superior', 'sector' => 'Pecho', 'code' => 'GRU_UPPER_PEC'],
            ['title' => 'Pectoral Medio', 'sector' => 'Pecho', 'code' => 'GRU_MIDDLE_PEC'],
            ['title' => 'Pectoral Inferior', 'sector' => 'Pecho', 'code' => 'GRU_LOWER_PEC'],

            // Grupos de los hombros
            ['title' => 'Deltoide Frontal', 'sector' => 'Hombros', 'code' => 'GRU_FRONT_DELTOID'],
            ['title' => 'Deltoide Medio', 'sector' => 'Hombros', 'code' => 'GRU_MIDDLE_DELTOID'],
            ['title' => 'Deltoide Posterior', 'sector' => 'Hombros', 'code' => 'GRU_REAR_DELTOID'],

            // Grupos de los brazos (cabezas de bíceps y tríceps)
            ['title' => 'Cabeza Larga del Bíceps', 'sector' => 'Brazos', 'code' => 'GRU_LONG_BICEPS'],
            ['title' => 'Cabeza Corta del Bíceps', 'sector' => 'Brazos', 'code' => 'GRU_SHORT_BICEPS'],
            ['title' => 'Cabeza Larga del Tríceps', 'sector' => 'Brazos', 'code' => 'GRU_LONG_TRICEPS'],
            ['title' => 'Cabeza Lateral del Tríceps', 'sector' => 'Brazos', 'code' => 'GRU_LATERAL_TRICEPS'],
            ['title' => 'Cabeza Medial del Tríceps', 'sector' => 'Brazos', 'code' => 'GRU_MEDIAL_TRICEPS'],

            // Grupos de la espalda
            ['title' => 'Dorsal Ancho', 'sector' => 'Espalda', 'code' => 'GRU_LATS'],
            ['title' => 'Trapecio', 'sector' => 'Espalda', 'code' => 'GRU_TRAPEZIUS'],
            ['title' => 'Erectores de la Columna', 'sector' => 'Espalda', 'code' => 'GRU_SPINAL_ERECTORS'],

            // Grupos del abdomen (recto abdominal separado en dos porciones)
            ['title' => 'Recto Abdominal Superior', 'sector' => 'Abdomen', 'code' => 'GRU_UPPER_ABS'],
            ['title' => 'Recto Abdominal Inferior', 'sector' => 'Abdomen', 'code' => 'GRU_LOWER_ABS'],
            ['title' => 'Oblicuo Externo', 'sector' => 'Abdomen', 'code' => 'GRU_EXTERNAL_OBLIQUE'],
            ['title' => 'Oblicuo Interno', 'sector' => 'Abdomen', 'code' => 'GRU_INTERNAL_OBLIQUE'],

            // Grupos de las piernas
            ['title' => 'Cuádriceps', 'sector' => 'Piernas', 'code' => 'GRU_QUADRICEPS'],
            ['title' => 'Isquiotibiales', 'sector' => 'Piernas', 'code' => 'GRU_HAMSTRINGS'],
            ['title' => 'Glúteos', 'sector' => 'Piernas', 'code' => 'GRU_GLUTES'],
            ['title' => 'Gemelos', 'sector' => 'Piernas', 'code' => 'GRU_CALVES'],
            ['title' => 'Aductores', 'sector' => 'Piernas', 'code' => 'GRU_ADDUCTORS'],
            ['title' => 'Abductores', 'sector' => 'Piernas', 'code' => 'GRU_ABDUCTORS'],
        ];

        // Insertar cada grupo muscular y establecer la relación en la tabla pivote sector_muscle_groups
        foreach ($muscularGroups as $group) {
            $idGrupo = DB::table('muscle_groups')->insertGetId([
                'title' => $group['title'],
                'code' => $group['code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('sector_muscle_groups')->insert([
                'muscle_sector_id' => $sectorId[$group['sector']],
                'muscle_group_id' => $idGrupo,
            ]);
        }
    }

    protected function populateExercises(): void
    {
        $exercises = [
            [
                'code'        => 'EX_SIMPLE_SQUAT',
                'title'       => 'Sentadilla Simple',
                'description' => 'Ejercicio fundamental para cuádriceps, glúteos e isquiotibiales.',
                'muscles'     => [
                    ['code' => 'GRU_QUADRICEPS',  'stimulation' => 'high'],
                    ['code' => 'GRU_GLUTES',      'stimulation' => 'medium'],
                    ['code' => 'GRU_HAMSTRINGS',  'stimulation' => 'medium'],
                ],
            ],
            [
                'code'        => 'EX_SUMO_SQUAT',
                'title'       => 'Sentadilla Sumo',
                'description' => 'Variación de sentadilla con mayor activación de glúteos y aductores.',
                'muscles'     => [
                    ['code' => 'GRU_QUADRICEPS',  'stimulation' => 'medium'],
                    ['code' => 'GRU_GLUTES',      'stimulation' => 'high'],
                    ['code' => 'GRU_HAMSTRINGS',  'stimulation' => 'medium'],
                    ['code' => 'GRU_ADDUCTORS',   'stimulation' => 'medium'],
                ],
            ],
            [
                'code'        => 'EX_BENCH_PRESS',
                'title'       => 'Press de Banca',
                'description' => 'Ejercicio para el pecho, deltoides y tríceps.',
                'muscles'     => [
                    ['code' => 'GRU_MIDDLE_PEC',     'stimulation' => 'high'],
                    ['code' => 'GRU_LONG_TRICEPS',   'stimulation' => 'medium'],
                    ['code' => 'GRU_FRONT_DELTOID',  'stimulation' => 'medium'],
                ],
            ],
            [
                'code'        => 'EX_INCLINE_PRESS',
                'title'       => 'Press Inclinado',
                'description' => 'Variación del press de banca que enfoca el pectoral superior.',
                'muscles'     => [
                    ['code' => 'GRU_UPPER_PEC',      'stimulation' => 'high'],
                    ['code' => 'GRU_FRONT_DELTOID',  'stimulation' => 'medium'],
                    ['code' => 'GRU_MEDIAL_TRICEPS', 'stimulation' => 'low'],
                ],
            ],
            [
                'code'        => 'EX_DECLINE_PRESS',
                'title'       => 'Press Declinado',
                'description' => 'Enfoca el pectoral inferior para mayor definición.',
                'muscles'     => [
                    ['code' => 'GRU_LOWER_PEC',      'stimulation' => 'high'],
                    ['code' => 'GRU_LONG_TRICEPS',   'stimulation' => 'medium'],
                    ['code' => 'GRU_FRONT_DELTOID',  'stimulation' => 'low'],
                ],
            ],
            [
                'code'        => 'EX_DEADLIFT',
                'title'       => 'Peso Muerto',
                'description' => 'Ejercicio compuesto para espalda baja, glúteos e isquiotibiales.',
                'muscles'     => [
                    ['code' => 'GRU_SPINAL_ERECTORS', 'stimulation' => 'high'],
                    ['code' => 'GRU_GLUTES',          'stimulation' => 'high'],
                    ['code' => 'GRU_HAMSTRINGS',      'stimulation' => 'medium'],
                ],
            ],
            [
                'code'        => 'EX_BARBELL_ROW',
                'title'       => 'Remo con Barra',
                'description' => 'Trabaja la espalda media, dorsal ancho y bíceps.',
                'muscles'     => [
                    ['code' => 'GRU_LATS',         'stimulation' => 'high'],
                    ['code' => 'GRU_TRAPEZIUS',    'stimulation' => 'medium'],
                    ['code' => 'GRU_LONG_BICEPS',  'stimulation' => 'medium'],
                ],
            ],
            [
                'code'        => 'EX_DUMBBELL_ROW',
                'title'       => 'Remo con Mancuernas',
                'description' => 'Alternativa al remo con barra, enfocado en dorsal y trapecio.',
                'muscles'     => [
                    ['code' => 'GRU_LATS',         'stimulation' => 'high'],
                    ['code' => 'GRU_TRAPEZIUS',    'stimulation' => 'medium'],
                    ['code' => 'GRU_SHORT_BICEPS', 'stimulation' => 'medium'],
                ],
            ],
            [
                'code'        => 'EX_PULLUPS',
                'title'       => 'Dominadas',
                'description' => 'Ejercicio de peso corporal para dorsal y bíceps.',
                'muscles'     => [
                    ['code' => 'GRU_LATS',         'stimulation' => 'high'],
                    ['code' => 'GRU_LONG_BICEPS',  'stimulation' => 'medium'],
                ],
            ],
            [
                'code'        => 'EX_PARALLEL_BARS_DIP',
                'title'       => 'Fondos en Paralelas',
                'description' => 'Enfoca tríceps, pectoral inferior y deltoides.',
                'muscles'     => [
                    ['code' => 'GRU_LOWER_PEC',      'stimulation' => 'high'],
                    ['code' => 'GRU_MEDIAL_TRICEPS', 'stimulation' => 'high'],
                    ['code' => 'GRU_FRONT_DELTOID',  'stimulation' => 'medium'],
                ],
            ],
            // ... continúa agregando los ejercicios restantes hasta alcanzar entre 30 y 40
        ];

        foreach ($exercises as $exercise) {
            $exerciseId = DB::table('exercises')->insertGetId([
                'code'        => $exercise['code'],
                'title'       => $exercise['title'],
                'description' => $exercise['description'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            foreach ($exercise['muscles'] as $muscle) {
                $muscleGroupId = DB::table('muscle_groups')
                    ->where('code', $muscle['code'])
                    ->value('id');

                if ($muscleGroupId) {
                    DB::table('exercise_muscle_groups')->insert([
                        'exercise_id'     => $exerciseId,
                        'muscle_group_id' => $muscleGroupId,
                        'stimulation'     => $muscle['stimulation'],
                    ]);
                }
            }
        }
    }
}
