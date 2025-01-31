<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CounselorController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\InstituteDashboardController;
use App\Http\Controllers\AccManController;
use App\Http\Controllers\CounselorDashboardController;
use App\Http\Controllers\FileReturnsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\TestimonalController;
use App\Http\Controllers\SubscriptionPlanController;
// Get Routes to Navigate through website

Route::get('/', function () {
    return view('layouts.index');
})->name('index');

Route::get('/how-it-works', function () {
    return view('layouts.howitworks');
})->name('how-it-works');

// Route::get('/subscription-plans', function () {
//     return view('layouts.subscriptionplans');
// })->name('subscription-plans');

Route::get('sign-up', function () {
    return view('layouts.signup');
})->name('sign-up');

Route::get('/services', function () {
    return view('layouts.services');
})->name('services');

Route::get('/ask-for-help', function () {
    return view('layouts.ask-for-help');
})->name('ask-for-help');

Route::get('/getting-started', function () {
    return view('layouts.getting-started');
})->name('getting-started');

Route::get('/resources', function () {
    return view('layouts.resources');
})->name('resources');


Route::get('/contact-is', function () {
    return view('layouts.contact-us');
})->name('contact-us');

Route::get('/login', function () {
    return view('layouts.login');
})->name('login');

Route::get('/institute-dashboard', function () {
    return view('layouts.dashboard.institute.institute-dashboard');
})->name('institute-dashboard');

// Route::get('/inst-profile', function () {
//     return view('layouts.dashboard.institute.inst-profile');
// })->name('inst-profile');

// Route::get('/account-manager', function () {
//     return view('layouts.dashboard.institute.account-manager');
// })->name('account-manager');

Route::get('/view-reports', function () {
    return view('layouts.dashboard.institute.view-reports');
})->name('view-reports');

Route::get('/view-therapists-details', function () {
    return view('layouts.dashboard.institute.view-therapists-details');
})->name('view-therapists-details');


Route::get('/admin-login', function () {
    return view('layouts.dashboard.admin.login');
})->name('admin-login');

Route::get('/add-student', [InstituteDashboardController::class, 'showAddStudentForm'])->name('add-student');

// Route::get('/view-student', function () {
//     return view('layouts.dashboard.institute.view-student');
// })->name('view-student');

Route::get('/stu-login', function () {
    return view('layouts.dashboard.student.stu-login');
})->name('stu-login');


// Route::get('/write-a-blog', function () {
//     return view('layouts.dashboard.counselor.write-a-blog');
// })->name('write-a-blog');

// Route::get('/stu-dashboard', function () {
//     return view('layouts.dashboard.student.stu-dashboard');
// })->name('stu-dashboard');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Post routes to submit data
Route::post('/signup/institute', [InstituteController::class, 'store'])->name('signup.institute');
Route::post('/signup/counselor', [CounselorController::class, 'store'])->name('signup.counselor');
Route::post('/student/store', [InstituteDashboardController::class, 'storeStudent'])->name('student.store');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Route to update the profile
Route::post('/institute/profile/update', [InstituteDashboardController::class, 'updateProfile'])->name('update-profile')->middleware('auth');
// routes/web.php
// Middleware to ensure only authenticated users can access the institute dashboard
Route::middleware(['auth'])->group(function () {
    // Route to view the institute dashboard using the controller's showDashboard method
    Route::get('/institute-dashboard', [InstituteDashboardController::class, 'showDashboard'])->name('institute-dashboard');
    Route::post('/appointments/schedule', [AppointmentController::class, 'scheduleAppointment'])->name('appointments.schedule'); // To schedule a new appointment
    Route::get('/account-manager/dashboard', [AccManController::class, 'ViewDashboard'])->name('acc-man-dashboard');
});
// Route to view the profile
Route::get('/institute/profile', [InstituteDashboardController::class, 'showProfile'])->name('view-profile')->middleware('auth');
Route::get('/subscription-plans', [SubscriptionController::class, 'showPlans'])->name('subscription-plans');

// Route::get('/institute-dashboard', [InstituteDashboardController::class, 'showDashboard'])->name('institute-dashboard');

Route::get('/institute/students', [InstituteDashboardController::class, 'viewStudents'])->name('view-student');
Route::get('/institute/student/{id}/view', [InstituteDashboardController::class, 'viewStudent'])->name('student.view');
Route::get('/institute/student/{id}/edit', [InstituteDashboardController::class, 'editStudent'])->name('student.edit');
Route::post('/institute/student/{id}/update', [InstituteDashboardController::class, 'updateStudent'])->name('student.update');
Route::delete('/institute/student/{id}/delete', [InstituteDashboardController::class, 'deleteStudent'])->name('student.delete');
Route::get('/account-manager/{id}', [InstituteDashboardController::class, 'viewaccman'])->name('account-manager');

// Route to show the password reset form
Route::get('/password/reset', [LoginController::class, 'showResetForm'])->name('password.reset');

// Route to handle password reset form submission
Route::post('/password/reset', [LoginController::class, 'resetPassword'])->name('password.update');

Route::get('/view-dash-stu', [StudentController::class, 'viewStuDash'])->name('stu-dashboard');

Route::post('/appointments/reschedule/{appointmentId}', [AppointmentController::class, 'rescheduleAppointment'])->name('appointments.reschedule');
Route::post('/assign-therapist', [InstituteDashboardController::class, 'assignTherapist'])->name('assign-therapist');

// Route to process subscription payment
Route::post('/subscription/process-payment', [SubscriptionController::class, 'processPayment'])->name('processPayment');
Route::get('/counselor-dashboard', [CounselorDashboardController::class, 'showDashboard'])->name('counselor-dashboard');

Route::get('/write-a-blog', [BlogController::class, 'showBlog'])->middleware('auth')->name('write-a-blog');
Route::post('/blogs', [BlogController::class, 'store'])->middleware('auth')->name('blogs.store');
Route::get('/counselor-profile', [CounselorDashboardController::class, 'showProfile'])->name('counselor-profile');
Route::post('/counselor-profile/update', [CounselorDashboardController::class, 'updateProfile'])->name('counselor-profile.update');
// Route to display the Return Form
Route::get('/returns/request', [FileReturnsController::class, 'viewReturnForm'])->name('view-return-form');

// Route to handle Return Form submission
Route::post('/returns/store', [FileReturnsController::class, 'store'])->name('returns-store');
Route::get('/returns/view', [FileReturnsController::class, 'viewReturnRequests'])->name('returns-view');

Route::get('/feedback/create', [FeedbackController::class, 'createcons'])->name('feedback-create-cons');
Route::get('/feedback/view', [FeedbackController::class, 'viewFeedbackCons'])->name('feedback-view-cons');
Route::get('/feedback/view-institute', [FeedbackController::class, 'viewFeedbackIns'])->name('feedback-view-ins');
Route::get('/feedback/create-ins', [FeedbackController::class, 'createins'])->name('feedback-create-2');
Route::get('/feedback/create-stu', [FeedbackController::class, 'createstu'])->name('feedback-create-3');
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback-store');
Route::get('/', [IndexController::class, 'showBlogs'])->name('index');
Route::get('/blog/{id}', [IndexController::class, 'show'])->name('blog.show');
Route::get('/blogs', [IndexController::class, 'showBlogs'])->name('blogs.index');
Route::get('/blogs/all', [IndexController::class, 'showAllBlogs'])->name('blogs.all');
Route::get('/admin/aditya', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/login', [LoginController::class, 'showLogin'])->name('show-login');
// Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin-login');
Route::get('/admin/institutes', [AdminController::class, 'ViewInstitutes'])->name('admin.institutes.index');
Route::get('/admin/counselors', [AdminController::class, 'ViewCounselors'])->name('admin.counselors.index');
Route::get('/admin/subscriptions', [AdminController::class, 'ViewSubscriptions'])->name('admin.subscriptions.index');
Route::patch('/subscriptions/{id}/status', [AdminController::class, 'setSubscriptionStatus'])->name('subscriptions.setStatus');
Route::get('/subscriptions/{id}/assign-counselor', [AdminController::class, 'assignCounselor'])->name('counselors.assign');
Route::post('/subscriptions/{id}/assign', [AdminController::class, 'storeAssignedCounselor'])->name('counselors.storeAssigned');

Route::post('/contact-submit', [ContactUsController::class, 'submit'])->name('contact.submit');
Route::get('/buy-subscription/{plan}', [SubscriptionController::class, 'buySubscription'])->name('buySubscription');
Route::get('/feedbacks', [TestimonalController::class, 'index'])->name('feedbacks');

Route::get('/view-account-manager', [AdminController::class, 'ViewAccountManager'])->name('ViewAccountManager');
// Route::get('/add-subscription-plan', [AdminController::class, 'ViewAddSubscriptionPlan'])->name('ViewAddSubscriptionPlan');

Route::post('/appointments/{id}/ask-to-reschedule', [AppointmentController::class, 'askToReschedule'])->name('appointments.askToReschedule');
Route::get('/view-return-requests', [AdminController::class, 'ViewBillings'])->name('ViewReturnRequestss');
Route::patch('/admin/update-return-status/{id}', [AdminController::class, 'updateReturnStatus'])->name('admin.updateReturnStatus');
Route::get('/view-appointments-admin', [AdminController::class, 'ViewAppointments'])->name('ViewAppointments');

Route::prefix('admin')->group(function () {
    Route::get('/follow-ups', [AdminController::class, 'viewFollowUps'])->name('admin.follow-ups.index');
    Route::get('/follow-ups/create', [AdminController::class, 'createFollowUp'])->name('admin.follow-ups.create');
    Route::post('/follow-ups', [AdminController::class, 'storeFollowUp'])->name('admin.follow-ups.store');
});

Route::get('/manage-subscription', [SubscriptionPlanController::class, 'manage'])->name('admin.subscription-plans.manage');
Route::post('/add-subscription', [SubscriptionPlanController::class, 'store'])->name('admin.subscription-plans.store');
Route::post('/update-subscription', [SubscriptionPlanController::class, 'update'])->name('admin.subscription-plans.update');
