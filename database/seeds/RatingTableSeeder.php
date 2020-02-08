<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Employee;
use App\Rating;

class RatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rating::truncate();

        $employees = Employee::all();

        $ratings = collect([]);

        foreach ($employees as $employee) {
            $accuracy = rand(3,5);
            $discipline = rand(3,5);
            $skill = rand(3,5);
            $speed = rand(3,5);
            $teamwork = rand(3,5);

            $summary = ($accuracy + $discipline + $skill + $speed + $teamwork) / 5;
            $firstEvaluate = $summary;

            $ratings->push([
                'accuracy' => $accuracy,
                'discipline' => $discipline,
                'skill' => $skill,
                'speed' => $speed,
                'teamwork' => $teamwork,
                'summary' => $summary,
                'evaluate' => $firstEvaluate,
                'created_at' => Carbon::parse('2019-08-01')->toDateTimeString(),
                'updated_at' => Carbon::parse('2019-08-01')->toDateTimeString(),
                'user_id' => 2,
                'employee_id' => $employee->id,
                'employee_id' => $employee->id,
            ]);

            $accuracy = rand(3,5);
            $discipline = rand(3,5);
            $skill = rand(3,5);
            $speed = rand(3,5);
            $teamwork = rand(3,5);

            $summary = ($accuracy + $discipline + $skill + $speed + $teamwork) / 5;
            $secondEvaluate = ($firstEvaluate + $summary) / 2;

            $ratings->push([
                'accuracy' => $accuracy,
                'discipline' => $discipline,
                'skill' => $skill,
                'speed' => $speed,
                'teamwork' => $teamwork,
                'summary' => $summary,
                'evaluate' => $secondEvaluate,
                'created_at' => Carbon::parse('2019-09-01')->toDateTimeString(),
                'updated_at' => Carbon::parse('2019-09-01')->toDateTimeString(),
                'user_id' => 2,
                'employee_id' => $employee->id,
                'employee_id' => $employee->id,
            ]);

            $accuracy = rand(3,5);
            $discipline = rand(3,5);
            $skill = rand(3,5);
            $speed = rand(3,5);
            $teamwork = rand(3,5);

            $summary = ($accuracy + $discipline + $skill + $speed + $teamwork) / 5;
            $thirdEvaluate = ($secondEvaluate + $summary) / 2;

            $ratings->push([
                'accuracy' => $accuracy,
                'discipline' => $discipline,
                'skill' => $skill,
                'speed' => $speed,
                'teamwork' => $teamwork,
                'summary' => $summary,
                'evaluate' => $thirdEvaluate,
                'created_at' => Carbon::parse('2019-08-01')->toDateTimeString(),
                'updated_at' => Carbon::parse('2019-08-01')->toDateTimeString(),
                'user_id' => 2,
                'employee_id' => $employee->id,
                'employee_id' => $employee->id,
            ]);
        }

        Rating::insert($ratings->all());
    }
}
