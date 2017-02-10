<?php

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $UploadImagePermission = Permission::create([
            'name' => 'Upload image',
            'slug' => 'upload.image',
        ]);

        $DestroyImagePermission = Permission::create([
            'name' => 'Destroy image',
            'slug' => 'destroy.image',
        ]);

        $UploadCommentPermission = Permission::create([
            'name' => 'Upload comment',
            'slug' => 'upload.comment',
        ]);

        $DestroyCommentPermission = Permission::create([
            'name' => 'Destroy comment',
            'slug' => 'destroy.comment',
        ]);

        $UpdateAccountPermission = Permission::create([
            'name' => 'Update account',
            'slug' => 'update.account',
        ]);

        /* Maybe move these to http/rbac.php.. will it still be called???
        /* Attach permissions */
        $role = Role::where('slug', 'admin')->first(); // change to where(slug = admin)
        $role->attachPermission($UploadImagePermission); // permission attached to a role
        $role->attachPermission($DestroyImagePermission);
        $role->attachPermission($UploadCommentPermission);
        $role->attachPermission($DestroyCommentPermission);
        $role->attachPermission($UpdateAccountPermission);

        /*$user = User::find('2');
        $user->attachPermission($UploadImagePermission); // permission attached to a user*/

        $role = Role::where('slug', 'user')->first();
        $role->attachPermission($UploadImagePermission);
        $role->attachPermission($UploadCommentPermission);
        $role->attachPermission($UpdateAccountPermission);
    }
}
