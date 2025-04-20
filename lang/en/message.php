<?php
return [

    'auth'=>[
        'register'=>[
            'success'=>'User registered successfully. Please check your email for verification link.',
            'error'=>'Invalid credentials',
        ],
        'login'=>[
            'success'=>'User logged in successfully.',
            'error'=>'Invalid credentials',
            'verify'=>'Please verify your email before logging in.',
        ],
        'logout'=>'Logout successfully.',
        'verify'=>[
            'success'=>'Email verified successfully.',
            'error'=>'Invalid verification token.',
        ],
    ],
    'user'=>[
        'status'=>'only admin can access this page.',
        'create_success'=>'User created successfully.',
        'not_found'=>'User not found.',
        'update_success'=>'User updated successfully.',
        'delete_success'=>'User deleted successfully.',
        'delete_error'=>'Failed to delete user.',
        'show_success'=>'User retrieved successfully.',
        'status_error'=>'User is not in created status.',
    ],
    'category'=>[
        'create_success'=>'Category created successfully.',
        'not_found'=>'Category not found.',
        'update_success'=>'Category updated successfully.',
        'delete_success'=>'Category deleted successfully.',
        'delete_error'=>'Failed to delete category.',
        'show_success'=>'Category retrieved successfully.',
    ],
    'email' => [
        'welcome' => 'Hello :name',
        'verify_button' => 'Verify Email',
        'ignore' => 'If you did not register, please ignore this email.',
    ],
    
];