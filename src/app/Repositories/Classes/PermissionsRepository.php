<?php


namespace App\Repositories\Classes;


use App\Models\Permission\Permission;
use App\Repositories\Contracts\PermissionsRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;
use Core\Repositories\Contracts\RepositoryInterface;

class PermissionsRepository extends BaseRepository implements PermissionsRepositoryInterface
{

    public function model(): string
    {
        return Permission::class;
    }

    public function table_name(): string
    {
        return "permissions";
    }

    public function primary_key(): string
    {
        return "role_id";
    }

    public function columns(): array
    {
        return array(
            'can_view_own_profile',
            'can_view_all_profiles',
            'can_generate_own_documents',
            'can_generate_all_documents',
            'can_upload_books',
            'can_download_books',
            'can_delete_books',
            'can_edit_own_personal_info',
            'can_edit_all_personal_info',
            'adm_students_view',
            'adm_students_edit',
            'adm_books_view',
            'adm_books_edit',
            'adm_permissions_view',
            'adm_permissions_edit'
        );
    }
}