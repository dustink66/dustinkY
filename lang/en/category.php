<?php

declare(strict_types=1);

return [
    'deleteCategoryConfirm' => 'Are you sure you want to delete the category titled ":title"? This operation will delete all subcategories and posts under this category and cannot be undone!',
    'title_required' => 'The category title must be filled in',
    'title_max' => 'The maximum length of the category title cannot exceed 255 characters',
    'title_string' => 'The category title must be a string',
    'title_unique' => 'The category title already exists',
    'slug_required' => 'The category identifier must be filled in',
    'slug_regex' => 'The category identifier can only consist of letters, numbers and hyphens, and cannot start or end with a hyphen, for example: dustinky-5-1',
    'slug_max' => 'The maximum length of the category identifier cannot exceed 255 characters',
    'slug_unique' => 'The category identifier already exists',
    'parent_id_integer' => 'The parent category must be an integer',
    'description_max' => 'The maximum length of the category description cannot exceed 255 characters',
    'description_string' => 'The category description must be a string',
    'category' => 'Category',
    'categories' => 'Categories',
    'categoryList' => 'Category List',
    'categoryCreate' => 'Create Category',
    'categoryEdit' => 'Edit Category',
    'categoryShow' => 'Category Details',
    'categoryDelete' => 'Delete Category',
];
