<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/my-visitors', function () {
    return view('visitor');
})->name('visitor');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/reset', function () {
    return view('reset-password');
})->name('reset-password');

Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot-password');

Route::get('/admin/', function () {
    return view('admin.login');
})->name('admin-login');

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin-login');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin-dashboard');

Route::get('/admin/deactivated/users', function () {
    return view('admin.deactivate-users');
})->name('deactivated-users');

Route::get('/admin/users', function () {
    return view('admin.users');
})->name('users');

Route::get('/admin/deactivate-user/', function () {
    return view('admin.deactivate-page');
})->name('deactivate-user');

Route::get('/admin/activate-user/', function () {
    return view('admin.activate-page');
})->name('activate-user');

Route::get('/admin/delete-user/', function () {
    return view('admin.delete-page');
})->name('activate-user');

Route::get('/admin/companies/', function () {
    return view('admin.companies');
})->name('admin.companies');

Route::get('/admin/companies/employees', function () {
    return view('admin.employees');
})->name('admin.employees');

Route::get('/reset-password', function () {
    return view('reset');
})->name('reset');

Route::get('/forgot-password', function () {
    return view('forgot');
})->name('forgot');

Route::post('/upload-profile-pic', [App\Http\Controllers\v1\User\UserController::class, 'updateProfilePic'])->name('upload-pic');

// company
Route::group([], function(){
    Route::get('/company', function () {
        return view('company.register');
    })->name('company.register');
    
    Route::get('/employees/login', function () {
        return view('company.login');
    })->name('company.login');
    
    Route::get('/employees/dashboard', function () {
        return view('company.employee.dashboard');
    })->name('company.employee.dashboard');
    
    Route::get('/employees/profile', function () {
        return view('company.employee.profile');
    })->name('company.employee.profile');
    
    Route::post('/employees/profile/', [App\Http\Controllers\v1\Company\EmployeeController::class, 'updateProfilePic'])->name('company.employee.profile-update');
    
    Route::get('/employees/lead-generation', function () {
        return view('company.employee.lead-generation');
    })->name('company.employee.lead-generation');
    
    Route::get('/employees/', function () {
        return view('company.employee.employees');
    })->name('company.employee.employees');
    
    Route::get('/activate-employees', function () {
        return view('company.employee.activate-employees');
    })->name('company.employee.activate-employees');
    
    Route::get('/deactivate-employees', function () {
        return view('company.employee.deactivate-employees');
    })->name('company.employee.deactivate-employees');
    
    Route::get('/deactivated-employees', function () {
        return view('company.employee.deactivated-employees');
    })->name('company.employee.deactivated-employees');
    
    Route::get('/delete-employees', function () {
        return view('company.employee.delete-employees');
    })->name('company.employee.delete-employees');

    Route::get('/company/profile', function () {
        return view('company.profile');
    })->name('company.profile');

    Route::post('/company/profile/', [App\Http\Controllers\v1\Company\CompanyController::class, 'updateCompanyProfilePic'])->name('company.profile-update');
    
    Route::get('/lead-generation', function () {
        return view('company.lead-generation');
    })->name('company.lead-generation');

});

Route::get('/company/{username}', function () {
    return view('company.preview');
})->name('company.preview');

Route::get('/company/{username}/{employee}', function () {
    return view('company.employee.preview');
})->name('company.employee.preview');

Route::get('/{username}', function () {
    return view('preview');
})->name('preview-user');

