<?php

namespace App\Tables;

use App\Models\Comment;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Comments extends AbstractTable
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
        return Comment::query();
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
            ->withGlobalSearch(columns: ['id', 'user.name', 'post.title', 'content'])
            ->column('id', sortable: true)
            ->column('user.name', 'Comment User', sortable: true)
            ->column('post.title', 'Comment Post', sortable: true)
            ->column('content', 'Comment Content', sortable: true)
            ->column('created_at', 'Comment Created At', sortable: true)
            ->column(label: 'Actions')
            ->export()
            ->paginate(15);
    }
}
