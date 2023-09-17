<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    protected $permissions = [
        'all_categories' => 'Show All Categories',
        'add_category' => 'Add Category',
        'edit_category' => 'Edit Category',
        'delete_category' => 'Delete Category',

        'all_skills' => 'Show All Skills',
        'add_skill' => 'Add Skill',
        'edit_skill' => 'Edit Skill',
        'delete_skill' => 'Delete Skill',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::truncate();
        foreach($this->permissions as $code => $name) {
            Permission::create([
                'name' => $name,
                'code' => $code
            ]);
        }
    }
}
