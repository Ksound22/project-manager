<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects_json_file = File::get(database_path('seeders/projects.json'));
        $projects = json_decode($projects_json_file, true);

        foreach ($projects as $projectData) {
            $project = Project::create([
                'name' => $projectData['name'],
                'description' => $projectData['description'],
                'status' => $projectData['status'],
                'priority' => $projectData['priority'],
                'deadline' => $projectData['deadline'],
            ]);

            foreach ($projectData["tasks"] as $task) {
                Task::create([
                    'project_id' => $project->id,
                    'title' => $task['title'],
                    'description' => $task['description'],
                    'priority' => $task['priority'],
                    'deadline' => $task['deadline'],
                    'status' => $task['status'],
                ]);
            }
        }

        $this->command->info("Projects and tasks seeded successfully");
    }
}
