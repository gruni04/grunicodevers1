<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\WebSetting\HomeBannerController;
use App\Http\Controllers\Admin\WebSetting\AnnouncementController;
use App\Http\Controllers\Admin\WebSetting\LatestNewsController;
use App\Http\Controllers\Admin\WebSetting\OurPodcastController;
use App\Http\Controllers\Admin\WebSetting\SuccessStoryController;
use App\Http\Controllers\Admin\WebSetting\DiscoverGruniController;
use App\Http\Controllers\Admin\WebSetting\SchoolAndProgramController;
use App\Http\Controllers\Admin\WebSetting\TestimonialController;
use App\Http\Controllers\Admin\WebSetting\UniversityCateogryController;
use App\Http\Controllers\Admin\WebSetting\UniversityController;
use App\Http\Controllers\Admin\WebSetting\SchoolOfMedicineCourseController;
use App\Http\Controllers\Admin\WebSetting\SchoolOfMedicineController;
use App\Http\Controllers\Admin\WebSetting\GruniInformationController;
use App\Http\Controllers\Admin\FeeController;

use App\Http\Controllers\Admin\StudentController;


use App\Http\Controllers\Admin\WebSetting\TeachingCategoryController;
use App\Http\Controllers\Admin\WebSetting\TeachingController;
use App\Http\Controllers\Admin\WebSetting\AdmissionCategoryController;
use App\Http\Controllers\Admin\WebSetting\AdmissionController;

use Illuminate\Support\Facades\Session;


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



Route::get('/', [WebController::class, 'index'])->name('web');
Route::get('/mission-admission', [WebController::class, 'mission_admission'])->name('web.mission-admission');
Route::get('university/{id?}/{id2?}', [WebController::class, 'university'])->name('web.university');
Route::get('indian-student/{id1}', [WebController::class, 'student'])->name('web.student');
Route::get('indians/{id2}', [WebController::class, 'food'])->name('web.india-Food');
Route::get('indian/{id3}', [WebController::class, 'health'])->name('web.health');
Route::get('school-of-medicine/{id?}/{id2?}', [WebController::class, 'school_of_medicine'])->name('web.school-of-medicine');
Route::get('learning-teaching/{id?}/{id2?}', [WebController::class, 'learning_teaching'])->name('web.learning-teaching');
Route::get('admission/{id?}/{id2?}', [WebController::class, 'admission'])->name('web.admission');
Route::get('latest-news-list', [WebController::class, 'latest_news_list'])->name('web.latest-news-list');
Route::get('latest-news/{id?}', [WebController::class, 'latest_news'])->name('web.latest-news');
Route::get('announcement/{id?}', [WebController::class, 'announcement'])->name('web.announcement');
Route::get('discover-gruni/{id?}', [WebController::class, 'discover_gruni'])->name('web.discover-gruni');
Route::get('success-story', [WebController::class, 'success_story'])->name('web.success-story');
Route::get('testimonial', [WebController::class, 'testimonial'])->name('web.testimonial');
Route::post('subscribe', [WebController::class, 'subscribe'])->name('web.subscribe');
Route::post('save-enquiry-data', [WebController::class, 'save_enquiry'])->name('web.save-enquiry');
Route::get('associate-parter', [WebController::class, 'associate_parter']);
Route::get('/gallery', [WebController::class, 'gallary'])->name('web.gallery');
Route::get('/campus-life', [WebController::class, 'campus_life'])->name('web.campus_life');
Route::get('/our-campus', [WebController::class, 'our_campus'])->name('web.our_campus');
Route::get('/academics', [WebController::class, 'academics'])->name('web.academics');


// Route::get('/', function () {
//     // return redirect(route('home'));
//     return view('welcome');
// });
Route::post('keep-token-alive', function() {
    return 'Token must have been valid, and the session expiration has been extended.';
});
Route::get('details212', function () {
    // PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
    // var_dump(extension_loaded ('zip'));
    $data = [
        'name' => "Test Mail",
        'email' => "ravindram297@gmail.com",
        'mobile' => "111111",
        'date' => date("Y-m-d H:i:s"),
    ];
    $res = Mail::send("email.student-email", $data, function($message) use ($data) {
        $message->to($data['email'])
        ->subject("Test mail on Gruni University");
    });
    // print_r($res) ;die;
    // echo $ip = request()->ip();//'50.90.0.1'; //Request::ip();//'50.90.0.1';
    // $data = \Location::get($ip);
    // dd($data);

});


// **********************************start
// do not change or remove this route
Route::get('daily-cron-job', function () {
    Artisan::call('schedule:run');
    return true;
});
// **********************************end


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth'] ], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::group(['name' => 'roles'], function() {
        Route::get('user-roles', [RoleController::class, 'datatables'])->name('roles.datatables');
    });

    Route::group(['name' => 'users'], function() {
        Route::get('users-list/index', [UserController::class, 'index'])->name('users.list.index');
        Route::post('users/updates', [UserController::class, 'updates'])->name('user.update');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::get('/user-datatable', [UserController::class, 'datatables'])->name('user.datatables');
        Route::get('users/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        Route::get('/edit-password', [UserController::class, 'change_password'])->name('user.edit-user-password');
        Route::post('/update-password', [UserController::class, 'update_password'])->name('user.update-user-password');


        Route::get('partner-user-list/index', [UserController::class, 'partner_agent'])->name('partner-user.list.index');
        Route::get('partner-user/save/{id?}', [UserController::class, 'create_partner_agent'])->name('admin.partner-user.save');
        Route::post('partner-user/save', [UserController::class, 'save_partner_agent'])->name('admin.partner-user.store');
        Route::get('partner-user/datatable', [UserController::class, 'datatables_partner_agent'])->name('admin.partner-user.datatables');
    });

    Route::group(['name' => 'roles'], function() {
        Route::post('/updates', [RoleController::class, 'update'])->name('role.updates');
        Route::get('/delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

    });

    Route::group(['name' => 'student'], function() {
        Route::get('admin/student/view/{id}', [StudentController::class, 'view'])->name('admin.student.view');

        Route::get('admin/student/list', [StudentController::class, 'index'])->name('admin.student.index');
        Route::get('admin/student/profile_list', [StudentController::class, 'profile_list'])->name('admin.student.profile_list');
        Route::get('admin/student/save-student/{id?}', [StudentController::class, 'save'])->name('admin.student.save-student');
        Route::post('admin/student/store-student', [StudentController::class, 'store'])->name('admin.student.store-student');
        Route::post('admin/student/delete-student-docs', [StudentController::class, 'destroy_student_docs'])->name('admin.student.delete-student-docs');
        Route::get('admin/student/delete-student/{id}', [StudentController::class, 'delete'])->name('admin.student.delete-student');
        Route::get('admin/student/list-student', [StudentController::class, 'datatables'])->name('admin.student.list-student');
        Route::get('admin/student/get-fee-history/{id?}', [StudentController::class, 'get_fee_history'])->name('admin.student.get-fee-history');
        Route::get('admin/student/get-interview-history/{id?}', [StudentController::class, 'get_interview_history'])->name('admin.student.get-interview-history');
        Route::get('admin/student/get-hostel-fee-history/{id?}', [StudentController::class, 'get_hostel_fee_history'])->name('admin.student.get-hostel-fee-history');
        Route::post('admin/student/update-student-docs-status', [StudentController::class, 'update_student_doc_status'])->name('admin.student.update-student-docs-status');
        Route::post('admin/student/update-student-fee-status', [StudentController::class, 'update_student_fee_status'])->name('admin.student.update-student-fee-status');
        Route::post('admin/student/update-student-indian-office-document-status', [StudentController::class, 'update_student_indian_office_document_status'])->name('admin.student.update-student-indian-office-document-status');
        Route::post('admin/student/update-student-interview-status', [StudentController::class, 'update_interview_status'])->name('admin.student.update-student-interview-status');
        Route::get('admin/student/get_detais_of_admin', [StudentController::class, 'get_detais_of_admin'])->name('admin.student.get_detais_of_admin');
        Route::get('admin/student/get_enquiry', [StudentController::class, 'enquiry'])->name('admin.student.get_enquiry');
        Route::post('admin/student/delete_enquirey', [StudentController::class, 'destroy_enquiry'])->name('admin.student.delete-enquireys');
    });

    Route::group(['name' => 'web-setting'], function() {
        Route::get('web-setting/banner', [HomeBannerController::class, 'banner'])->name('web-setting.banner');
        Route::get('web-setting/save-banner/{id?}', [HomeBannerController::class, 'save_banner'])->name('web-setting.save-banner');
        Route::post('web-setting/store-banner', [HomeBannerController::class, 'store_banner'])->name('web-setting.store-banner');
        Route::get('web-setting/delete-banner/{id}', [HomeBannerController::class, 'delete_banner'])->name('web-setting.delete-banner');
        Route::get('web-setting/list-banner', [HomeBannerController::class, 'datatables_banner'])->name('web-setting.list-banner');


        Route::get('web-setting/announcement', [AnnouncementController::class, 'index'])->name('web-setting.announcement');
        Route::get('web-setting/save-announcement/{id?}', [AnnouncementController::class, 'save'])->name('web-setting.save-announcement');
        Route::post('web-setting/store-announcement', [AnnouncementController::class, 'store'])->name('web-setting.store-announcement');
        Route::get('web-setting/delete-announcement/{id}', [AnnouncementController::class, 'delete'])->name('web-setting.delete-announcement');
        Route::get('web-setting/list-announcement', [AnnouncementController::class, 'datatables'])->name('web-setting.list-announcement');


        Route::get('web-setting/latest-news', [LatestNewsController::class, 'index'])->name('web-setting.latest-news');
        Route::get('web-setting/save-latest-news/{id?}', [LatestNewsController::class, 'save'])->name('web-setting.save-latest-news');
        Route::post('web-setting/store-latest-news', [LatestNewsController::class, 'store'])->name('web-setting.store-latest-news');
        Route::get('web-setting/delete-latest-news/{id}', [LatestNewsController::class, 'delete'])->name('web-setting.delete-latest-news');
        Route::get('web-setting/list-latest-news', [LatestNewsController::class, 'datatables'])->name('web-setting.list-latest-news');


        Route::get('web-setting/our-podcast', [OurPodcastController::class, 'index'])->name('web-setting.our-podcast');
        Route::get('web-setting/save-our-podcast/{id?}', [OurPodcastController::class, 'save'])->name('web-setting.save-our-podcast');
        Route::post('web-setting/store-our-podcast', [OurPodcastController::class, 'store'])->name('web-setting.store-our-podcast');
        Route::get('web-setting/delete-our-podcast/{id}', [OurPodcastController::class, 'delete'])->name('web-setting.delete-our-podcast');
        Route::get('web-setting/list-our-podcast', [OurPodcastController::class, 'datatables'])->name('web-setting.list-our-podcast');


        Route::get('web-setting/success-story', [SuccessStoryController::class, 'index'])->name('web-setting.success-story');
        Route::get('web-setting/save-success-story/{id?}', [SuccessStoryController::class, 'save'])->name('web-setting.save-success-story');
        Route::post('web-setting/store-success-story', [SuccessStoryController::class, 'store'])->name('web-setting.store-success-story');
        Route::get('web-setting/delete-success-story/{id}', [SuccessStoryController::class, 'delete'])->name('web-setting.delete-success-story');
        Route::get('web-setting/list-success-story', [SuccessStoryController::class, 'datatables'])->name('web-setting.list-success-story');


        Route::get('web-setting/discover-gruni', [DiscoverGruniController::class, 'index'])->name('web-setting.discover-gruni');
        Route::get('web-setting/save-discover-gruni/{id?}', [DiscoverGruniController::class, 'save'])->name('web-setting.save-discover-gruni');
        Route::post('web-setting/store-discover-gruni', [DiscoverGruniController::class, 'store'])->name('web-setting.store-discover-gruni');
        Route::get('web-setting/delete-discover-gruni/{id}', [DiscoverGruniController::class, 'delete'])->name('web-setting.delete-discover-gruni');
        Route::get('web-setting/list-discover-gruni', [DiscoverGruniController::class, 'datatables'])->name('web-setting.list-discover-gruni');

        Route::get('web-setting/school-and-program', [SchoolAndProgramController::class, 'index'])->name('web-setting.school-and-program');
        Route::get('web-setting/save-school-and-program/{id?}', [SchoolAndProgramController::class, 'save'])->name('web-setting.save-school-and-program');
        Route::post('web-setting/store-school-and-program', [SchoolAndProgramController::class, 'store'])->name('web-setting.store-school-and-program');
        Route::get('web-setting/delete-school-and-program/{id}', [SchoolAndProgramController::class, 'delete'])->name('web-setting.delete-school-and-program');
        Route::get('web-setting/list-school-and-program', [SchoolAndProgramController::class, 'datatables'])->name('web-setting.list-school-and-program');

        Route::get('web-setting/testimonial', [TestimonialController::class, 'index'])->name('web-setting.testimonial');
        Route::get('web-setting/save-testimonial/{id?}', [TestimonialController::class, 'save'])->name('web-setting.save-testimonial');
        Route::post('web-setting/store-testimonial', [TestimonialController::class, 'store'])->name('web-setting.store-testimonial');
        Route::get('web-setting/delete-testimonial/{id}', [TestimonialController::class, 'delete'])->name('web-setting.delete-testimonial');
        Route::get('web-setting/list-testimonial', [TestimonialController::class, 'datatables'])->name('web-setting.list-testimonial');

        Route::get('web-setting/university-cateogry', [UniversityCateogryController::class, 'index'])->name('web-setting.university-cateogry');
        Route::get('web-setting/save-university-cateogry/{id?}', [UniversityCateogryController::class, 'save'])->name('web-setting.save-university-cateogry');
        Route::post('web-setting/store-university-cateogry', [UniversityCateogryController::class, 'store'])->name('web-setting.store-university-cateogry');
        Route::get('web-setting/delete-university-cateogry/{id}', [UniversityCateogryController::class, 'delete'])->name('web-setting.delete-university-cateogry');
        Route::get('web-setting/list-university-cateogry', [UniversityCateogryController::class, 'datatables'])->name('web-setting.list-university-cateogry');


        Route::get('web-setting/university', [UniversityController::class, 'index'])->name('web-setting.university');
        Route::get('web-setting/save-university/{id?}', [UniversityController::class, 'save'])->name('web-setting.save-university');
        Route::post('web-setting/store-university', [UniversityController::class, 'store'])->name('web-setting.store-university');
        Route::get('web-setting/delete-university/{id}', [UniversityController::class, 'delete'])->name('web-setting.delete-university');
        Route::get('web-setting/list-university', [UniversityController::class, 'datatables'])->name('web-setting.list-university');

        Route::get('web-setting/school-of-medicine-course', [SchoolOfMedicineCourseController::class, 'index'])->name('web-setting.school-of-medicine-course');
        Route::get('web-setting/save-school-of-medicine-course/{id?}', [SchoolOfMedicineCourseController::class, 'save'])->name('web-setting.save-school-of-medicine-course');
        Route::post('web-setting/store-school-of-medicine-course', [SchoolOfMedicineCourseController::class, 'store'])->name('web-setting.store-school-of-medicine-course');
        Route::get('web-setting/delete-school-of-medicine-course/{id}', [SchoolOfMedicineCourseController::class, 'delete'])->name('web-setting.delete-school-of-medicine-course');
        Route::get('web-setting/list-school-of-medicine-course', [SchoolOfMedicineCourseController::class, 'datatables'])->name('web-setting.list-school-of-medicine-course');

        Route::get('web-setting/school-of-medicine', [SchoolOfMedicineController::class, 'index'])->name('web-setting.school-of-medicine');
        Route::get('web-setting/save-school-of-medicine/{id?}', [SchoolOfMedicineController::class, 'save'])->name('web-setting.save-school-of-medicine');
        Route::post('web-setting/store-school-of-medicine', [SchoolOfMedicineController::class, 'store'])->name('web-setting.store-school-of-medicine');
        Route::get('web-setting/delete-school-of-medicine/{id}', [SchoolOfMedicineController::class, 'delete'])->name('web-setting.delete-school-of-medicine');
        Route::get('web-setting/list-school-of-medicine', [SchoolOfMedicineController::class, 'datatables'])->name('web-setting.list-school-of-medicine');


        Route::get('web-setting/gruni-information', [GruniInformationController::class, 'index'])->name('web-setting.gruni-information');
        Route::get('web-setting/save-gruni-information/{id?}', [GruniInformationController::class, 'save'])->name('web-setting.save-gruni-information');
        Route::post('web-setting/store-gruni-information', [GruniInformationController::class, 'store'])->name('web-setting.store-gruni-information');
        Route::get('web-setting/delete-gruni-information/{id}', [GruniInformationController::class, 'delete'])->name('web-setting.delete-gruni-information');
        Route::get('web-setting/list-gruni-information', [GruniInformationController::class, 'datatables'])->name('web-setting.list-gruni-information');


        Route::get('web-setting/teaching-category', [TeachingCategoryController::class, 'index'])->name('web-setting.teaching-category');
        Route::get('web-setting/save-teaching-category/{id?}', [TeachingCategoryController::class, 'save'])->name('web-setting.save-teaching-category');
        Route::post('web-setting/store-teaching-category', [TeachingCategoryController::class, 'store'])->name('web-setting.store-teaching-category');
        Route::get('web-setting/delete-teaching-category/{id}', [TeachingCategoryController::class, 'delete'])->name('web-setting.delete-teaching-category');
        Route::get('web-setting/list-teaching-category', [TeachingCategoryController::class, 'datatables'])->name('web-setting.list-teaching-category');

        Route::get('web-setting/teaching', [TeachingController::class, 'index'])->name('web-setting.teaching');
        Route::get('web-setting/save-teaching/{id?}', [TeachingController::class, 'save'])->name('web-setting.save-teaching');
        Route::post('web-setting/store-teaching', [TeachingController::class, 'store'])->name('web-setting.store-teaching');
        Route::get('web-setting/delete-teaching/{id}', [TeachingController::class, 'delete'])->name('web-setting.delete-teaching');
        Route::get('web-setting/list-teaching', [TeachingController::class, 'datatables'])->name('web-setting.list-teaching');


        Route::get('web-setting/admission-category', [AdmissionCategoryController::class, 'index'])->name('web-setting.admission-category');
        Route::get('web-setting/save-admission-category/{id?}', [AdmissionCategoryController::class, 'save'])->name('web-setting.save-admission-category');
        Route::post('web-setting/store-admission-category', [AdmissionCategoryController::class, 'store'])->name('web-setting.store-admission-category');
        Route::get('web-setting/delete-admission-category/{id}', [AdmissionCategoryController::class, 'delete'])->name('web-setting.delete-admission-category');
        Route::get('web-setting/list-admission-category', [AdmissionCategoryController::class, 'datatables'])->name('web-setting.list-admission-category');

        Route::get('web-setting/admission', [AdmissionController::class, 'index'])->name('web-setting.admission');
        Route::get('web-setting/save-admission/{id?}', [AdmissionController::class, 'save'])->name('web-setting.save-admission');
        Route::post('web-setting/store-admission', [AdmissionController::class, 'store'])->name('web-setting.store-admission');
        Route::get('web-setting/delete-admission/{id}', [AdmissionController::class, 'delete'])->name('web-setting.delete-admission');
        Route::get('web-setting/list-admission', [AdmissionController::class, 'datatables'])->name('web-setting.list-admission');


    //   Ajax routes
       Route::get('read-notification/{id}', [StudentController::class, 'readNotification']);
       Route::post('get-student-fee', [StudentController::class, 'getFee']);
    });

    // Fee setting routes
    Route::get('setting/fee', [FeeController::class, 'fee'])->name('setting.fee');
    Route::get('setting/save-fee/{id?}', [FeeController::class, 'save_fee'])->name('setting.save-fee');
    Route::post('setting/store-fee', [FeeController::class, 'store_fee'])->name('setting.store-fee');
    Route::get('setting/delete-fee/{id}', [FeeController::class, 'delete_fee'])->name('setting.delete-fee');
    Route::get('setting/list-fee', [FeeController::class, 'datatables_fee'])->name('setting.list-fee');



});
Route::fallback(function () {
    Session::flash('error','Page not found');
    return redirect()->route('home');
});
/*//route by controller
Route::controller(OrderController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
});

//Subdomain Routing
Route::domain('{account}.example.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        //
    });
});
*/

Route::get('/optimize', function() {
    Artisan::call('optimize:clear');

    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    // Artisan::call('optimize:clear');
    return "Optimized!";

});

Route::get('/cmds', function() {
    // Artisan::call('permission:create-permission "web-setting-list"');
    // Artisan::call('permission:create-permission "web-setting-create"');
    // Artisan::call('permission:create-permission "web-setting-edit"');
    // Artisan::call('permission:create-permission "web-setting-delete"');

    // Artisan::call('make:model ProjectUser -mcr');
    // Artisan::call('migrate:rollback');
    // Artisan::call('migrate');
    // Artisan::call('make:model ProjectTaskClientResponse --migration');
    // Artisan::call('make:migration create_settings ');
    // Artisan::call('session:table ');
    // Artisan::call('make:migration create_table_lead_requirements');
    // Artisan::call('make:migration add_columns_to_table_orders_table ');
    return "migrate Success!";

});


use Illuminate\Support\Facades\Hash;

Route::get('update-user-new123', function(){
    $pass = Hash::make('');

    $user = DB::table('users')->where('id',1)->update(['email'=>'admin@gruni.co.in','password'=>$pass]);
});




