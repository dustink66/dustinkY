<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Users extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return User::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id', 'name', 'email'])
            ->column('id', sortable: true)
            ->column('name', 'User Name', sortable: true)
            ->column('email', 'User Email', sortable: true)
            ->column('created_at', sortable: true)
            ->column('updated_at', sortable: true)
            ->column('email_verified_at', sortable: true)
            ->column(label: 'Actions')
            ->export()
            ->paginate(15);
    }
}
