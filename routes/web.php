<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DropBoxController;
use App\Http\Controllers\FianceVisaApplicationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\StripeController;

// Fiance Visa Controllers
use App\Http\Controllers\FianceVisa\SponsorController as FianceSponsorController;
use App\Http\Controllers\FianceVisa\AlienController;
use App\Http\Controllers\FianceVisa\AlienChildrenController;

// Simplified Spouse Visa Controller
use App\Http\Controllers\SpouseVisa\SimplifiedSpouseVisaController;

// Simplified Adjustment of Status Controller
use App\Http\Controllers\AdjustmentOfStatus\SimplifiedAosController;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\DocumentManagementController;
use App\Http\Controllers\Admin\UploadedDocumentsController;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ImmigrationNewsController;
use App\Http\Controllers\PdfGenerationController;
use App\Http\Controllers\CombinedCr1AosController;

/*
|--------------------------------------------------------------------------
| Public Web Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

Route::get('/change-lang', [LocalizationController::class, 'changeLang'])->name('change.lang');

// Public Visa Information Pages
Route::get('/fiancee-visa', [FianceVisaApplicationController::class, 'index'])->name('fiancee.visa');

// Adjustment of Status Public Page - Redirect to info or login
Route::get('/adjustment-of-status', function() {
    if (Auth::check()) {
        return redirect()->route('aos-simplified.index');
    }
    return view('web.service.adjustment-visa.index'); // Info page for non-logged users
})->name('adjustment.visa');

// Spouse Visa Public Page - Redirect to info or login
Route::get('/spouse-visa', function() {
    if (Auth::check()) {
        return redirect()->route('spouse-visa-simplified.index');
    }
    return view('web.service.spouse-visa'); // Info page for non-logged users
})->name('spouse.visa');

Route::group(['prefix' => 'contact-us'], function() {
    Route::get('/', [ContactUsController::class, 'index'])->name('contactUs');
    Route::post('/', [ContactUsController::class, 'store'])->name('contactUs');
});

Route::get('reload-captcha', [ContactUsController::class, 'reloadCaptcha']);
Route::post('/newsletter', [ContactUsController::class, 'newsletter'])->name('newsletter');

Route::get('/resource', [ResourceController::class, 'index'])->name('resource');
Route::get('/resource/{page}', [ResourceController::class, 'show'])->name('resource.page');
Route::post('/resource-search', [ResourceController::class, 'search'])->name('resource.search');

Route::post('/choose-application', [ProfileController::class, 'chooseApplication'])->name('chooseApplication');

// Service Pages Routes
Route::group(['controller' => ServiceController::class], function() {
    Route::get('/removal-of-conditions', 'removalOfConditions')->name('removal.conditions');
    Route::get('/ir5-parent-visa', 'ir5ParentVisa')->name('ir5.parent.visa');
    Route::get('/petition-child', 'petitionChild')->name('petition.child');
    Route::get('/naturalization', 'naturalization')->name('naturalization');
    Route::get('/combined-cr1-aos', 'combinedCr1Aos')->name('combined.cr1.aos');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

// Static Pages
Route::get('/about-us', function () {
    return view('web.about-us');
})->name('about-us');

Route::get('/service', function () {
    if (Auth::check() && isset(Auth::user()->application_route)) {
        return redirect()->route(Auth::user()->application_route);
    }
    return view('web.service.index');
})->name('service');

Route::get('/testimonial', function () {
    return view('web.testimonial');
})->name('testimonial');

Route::get('/contact-us', function () {
    return view('web.contact-us');
})->name('contact-us');

Route::get('/privacy-policy', function () {
    return view('web.privacy-policy');
})->name('privacy-policy');

Route::get('/money-back-guarantee', function () {
    return view('web.guarantee');
})->name('guarantee');

// Immigration News Routes (Public)
Route::group(['prefix' => 'immigration-news', 'as' => 'immigration-news.'], function() {
    Route::get('/', [ImmigrationNewsController::class, 'index'])->name('index');
    Route::get('/search', [ImmigrationNewsController::class, 'search'])->name('search');
    Route::get('/{slug}', [ImmigrationNewsController::class, 'show'])->name('show');
});

Route::get('/combined-cr1-aos', [CombinedCr1AosController::class, 'index'])
    ->name('combined.cr1.aos');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Login Required)
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth', 'application']], function() {
    
    // Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/user/{page}', 'profile')->name('user.page');
        Route::post('/basic-information', 'basicInformation')->name('basicInformation');
        Route::post('/change-password', 'changePassword')->name('changePassword');
        Route::get('/payment-card', 'paymentCard')->name('paymentCard');
        Route::post('/add-payment-card', 'addPaymentCard')->name('addPaymentCard');
        Route::get('/delete-payment-card/{id}', 'deletePaymentCard')->name('deletePaymentCard');
        Route::get('/mail', 'mails')->name('mails');
        Route::post('/send-mail', 'sendMail')->name('sendMail');
        Route::post('/delete-mail', 'deleteMail')->name('deleteMail'); 
    });

    // PDF Generation for Users
    Route::get('/generate-pdf', [PdfGenerationController::class, 'generateUserPdf'])
        ->name('user.generate-pdf');
    
    Route::get('/check-pdf-status', [PdfGenerationController::class, 'checkPdfStatus'])
        ->name('user.check-pdf-status');

    // Payment routes
    Route::get('/payment', [StripeController::class, 'index'])->name('payment.index');
    Route::post('/payment', [StripeController::class, 'store'])->name('payment');
    Route::get('/payment/success', [StripeController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [StripeController::class, 'cancel'])->name('payment.cancel'); 

    // Messaging Routes for Users
    Route::group(['prefix' => 'messages', 'as' => 'messages.'], function() {
        Route::get('/', [MessageController::class, 'index'])->name('index');
        Route::get('/compose', [MessageController::class, 'compose'])->name('compose');
        Route::post('/send', [MessageController::class, 'store'])->name('store');
        Route::get('/conversation/{applicationId}', [MessageController::class, 'conversation'])->name('conversation');
        Route::post('/{message}/reply', [MessageController::class, 'reply'])->name('reply');
        Route::post('/{message}/mark-read', [MessageController::class, 'markAsRead'])->name('mark-read');
        Route::get('/unread-count', [MessageController::class, 'getUnreadCount'])->name('unread-count');
        Route::get('/{message}/attachment/{index}', [MessageController::class, 'downloadAttachment'])->name('download-attachment');

        // NEW: Panel data endpoint for AJAX
        Route::get('/panel-data', [MessageController::class, 'getPanelData'])
            ->name('panel-data');
    });

    // Application Submission Routes
    Route::group(['controller' => \App\Http\Controllers\ApplicationSubmissionController::class], function() {
        Route::get('/application/review', 'showSubmissionPage')->name('application.review');
        Route::post('/application/submit', 'submitApplication')->name('application.submit');
        Route::get('/application/status', 'checkSubmissionStatus')->name('application.status');
    });

    /*
    |--------------------------------------------------------------------------
    | FIANCE VISA ROUTES (K-1)
    |--------------------------------------------------------------------------
    */
    
    // Fiance Visa - Sponsor Section
    Route::controller(FianceSponsorController::class)->prefix('fiance-sponsor')->group(function () {
        Route::get('/application', 'index')->name('fianceSponsorApplication');
        Route::post('/name', 'name')->name('fianceSponsorName');    
        Route::post('/contact', 'contact')->name('fianceSponsorContact');    
        Route::post('/placeOfBirth', 'placeOfBirth')->name('fianceSponsorPlaceOfBirth');    
        Route::post('/status', 'status')->name('fianceSponsorStatus');    
        Route::post('/maritalStatus', 'maritalStatus')->name('fianceSponsorMaritalStatus');    
        Route::post('/otherFilings', 'otherFilings')->name('fianceSponsorOtherFilings');    
        Route::post('/militaryAndConvictions', 'militaryAndConvictions')->name('fianceSponsorMilitaryAndConvictions');    
        Route::post('/address', 'address')->name('fianceSponsorAddress');    
        Route::post('/relationship', 'relationship')->name('fianceSponsorRelationship');    
        Route::post('/employment', 'employment')->name('fianceSponsorEmployment');    
        Route::post('/previous-and-continue', 'previousOrContinue')->name('sponsorPreviousOrContinue');
        Route::get('/get-state', 'getState')->name('getState');
        Route::get('/get-city', 'getCities')->name('getCities');
    });

    // Fiance Visa - Alien Section
    Route::controller(AlienController::class)->prefix('fiance-alien')->group(function () {
        Route::get('/application', 'index')->name('fianceAlienApplication');
        Route::post('/name', 'name')->name('fianceAlienName');    
        Route::post('/citizenship', 'citizenship')->name('fianceAlienCitizenship');        
        Route::post('/embassy', 'embassy')->name('fianceAlienEmbassy');        
        Route::post('/contact', 'contact')->name('fianceAlienContact');        
        Route::post('/marital-status', 'maritalStatus')->name('fianceAlienMaritalStatus');        
        Route::post('/parents', 'parents')->name('fianceAlienParents');        
        Route::post('/visit-u-s', 'visitUS')->name('fianceAlienVisitUS');        
        Route::post('/address', 'address')->name('fianceAlienAddress');        
        Route::post('/employment', 'employment')->name('fianceAlienEmployment');        
        Route::post('/school', 'school')->name('fianceAlienSchool');        
        Route::post('/travel', 'travel')->name('fianceAlienTravel');        
        Route::post('/military', 'military')->name('fianceAlienMilitary');        
        Route::post('/activity', 'activity')->name('fianceAlienActivity');        
        Route::post('/immigration', 'immigration')->name('fianceAlienImmigration');        
        Route::post('/language', 'language')->name('fianceAlienLanguage');        
        Route::post('/relative', 'relative')->name('fianceAlienRelative');        
        Route::post('/question1', 'question1')->name('fianceAlienQuestion1');        
        Route::post('/question2', 'question2')->name('fianceAlienQuestion2');        
        Route::post('/question3', 'question3')->name('fianceAlienQuestion3');        
        Route::post('/question4', 'question4')->name('fianceAlienQuestion4');        
        Route::post('/question5', 'question5')->name('fianceAlienQuestion5');        
        Route::post('/previous-and-continue', 'previousOrContinue')->name('fianceAlienPreOrCon');        
    });

    // Fiance Visa - Alien Children Section
    Route::controller(AlienChildrenController::class)->prefix('fiance-alien-child')->group(function () {
        Route::get('/application', 'index')->name('fianceAlienChildApplication');
        Route::post('/child1', 'child1')->name('fianceAlienChild1');        
        Route::post('/child2', 'child2')->name('fianceAlienChild2');        
        Route::post('/child3', 'child3')->name('fianceAlienChild3');        
        Route::post('/child4', 'child4')->name('fianceAlienChild4');        
        Route::post('/child5', 'child5')->name('fianceAlienChild5');        
        Route::post('/previous-and-continue', 'previousOrContinue')->name('fianceAlienChildPreOrCon');      
    });

    /*
    |--------------------------------------------------------------------------
    | SIMPLIFIED SPOUSE VISA ROUTES (CR-1/IR-1)
    |--------------------------------------------------------------------------
    */
    
    Route::prefix('spouse-visa-simplified')->name('spouse-visa-simplified.')->group(function () {
        // Main application form
        Route::get('/', [SimplifiedSpouseVisaController::class, 'index'])->name('index');
        
        // Save/update application
        Route::post('/store', [SimplifiedSpouseVisaController::class, 'store'])->name('store');
        
        // Submit completed application
        Route::post('/submit', [SimplifiedSpouseVisaController::class, 'submit'])->name('submit');
        
        // AJAX: Get states for country
        Route::get('/get-states', [SimplifiedSpouseVisaController::class, 'getStates'])->name('get-states');
    });

    /*
    |--------------------------------------------------------------------------
    | SIMPLIFIED ADJUSTMENT OF STATUS ROUTES (I-485)
    |--------------------------------------------------------------------------
    */
    
    Route::prefix('aos-simplified')->name('aos-simplified.')->group(function () {
        // Main application form
        Route::get('/', [SimplifiedAosController::class, 'index'])->name('index');
        
        // Save/update application
        Route::post('/store', [SimplifiedAosController::class, 'store'])->name('store');
        
        // Submit completed application
        Route::post('/submit', [SimplifiedAosController::class, 'submit'])->name('submit');
        
        // AJAX: Get states for country
        Route::get('/get-states', [SimplifiedAosController::class, 'getStates'])->name('get-states');
    });

    /*
    |--------------------------------------------------------------------------
    | COMBINED CR-1 + AOS ROUTES
    |--------------------------------------------------------------------------
    */
    
    Route::controller(CombinedCr1AosController::class)
        ->prefix('combined-cr1-aos')
        ->group(function () {
            Route::get('/application', 'application')->name('combinedCr1AosApplication');
            Route::post('/petitioner-name', 'petitionerName')->name('combinedPetitionerName');
            Route::post('/previous-and-continue', 'previousOrContinue')->name('combinedPreviousOrContinue');
        });

    // Drop Box Routes
    Route::prefix('drop-box')->name('drop-box.')->group(function() {
        Route::get('/', [DropBoxController::class, 'index'])->name('index');
        Route::get('/{id}', [DropBoxController::class, 'show'])->name('show');
        Route::post('/store', [DropBoxController::class, 'store'])->name('store');
        Route::delete('/{id}', [DropBoxController::class, 'destroy'])->name('destroy');
        Route::get('/download/{id}', [DropBoxController::class, 'download'])->name('download');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {

    // Monitoring routes
    Route::controller(MonitoringController::class)->group(function() {
        Route::get('/monitoring', 'index')->name('monitoring.index');
        Route::post('/monitoring/check-uscis', 'checkUscisChanges')->name('monitoring.check-uscis');
        Route::post('/monitoring/check-medical', 'checkMedicalFees')->name('monitoring.check-medical');
        Route::post('/monitoring/changes/{change}/mark-read', 'markAsRead')->name('monitoring.mark-read');
        Route::get('/monitoring/mark-all-read', 'markAllAsRead')->name('monitoring.mark-all-read');
    });

    // Document Management Routes
    Route::prefix('documents/management')->name('documents.management.')->group(function() {
        Route::get('/', [DocumentManagementController::class, 'index'])->name('index');
        Route::get('/visa-type/{visaType}', [DocumentManagementController::class, 'showVisaType'])->name('visa-type');
        
        // Category Management
        Route::post('/categories', [DocumentManagementController::class, 'storeCategory'])->name('categories.store');
        Route::put('/categories/{category}', [DocumentManagementController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{category}', [DocumentManagementController::class, 'destroyCategory'])->name('categories.destroy');
        Route::post('/categories/reorder', [DocumentManagementController::class, 'reorderCategories'])->name('categories.reorder');
        
        // Document Type Management
        Route::post('/document-types', [DocumentManagementController::class, 'storeDocumentType'])->name('document-types.store');
        Route::put('/document-types/{documentType}', [DocumentManagementController::class, 'updateDocumentType'])->name('document-types.update');
        Route::delete('/document-types/{documentType}', [DocumentManagementController::class, 'destroyDocumentType'])->name('document-types.destroy');
        Route::post('/document-types/reorder', [DocumentManagementController::class, 'reorderDocumentTypes'])->name('document-types.reorder');
    });
    
    // View User Documents
    Route::get('/users/{user}/documents', [DocumentManagementController::class, 'viewUserDocuments'])->name('users.documents');

    // Uploaded Documents Management Routes
    Route::prefix('documents/uploaded')->name('documents.uploaded.')->group(function() {
        // Main dashboard
        Route::get('/', [UploadedDocumentsController::class, 'index'])->name('index');
        
        // User-specific documents
        Route::get('/user/{user}', [UploadedDocumentsController::class, 'userDocuments'])->name('user-documents');
        
        // Document actions
        Route::get('/{id}/preview', [UploadedDocumentsController::class, 'preview'])->name('preview');
        Route::get('/{id}/download', [UploadedDocumentsController::class, 'download'])->name('download');
        Route::post('/{id}/verify', [UploadedDocumentsController::class, 'verify'])->name('verify');
        Route::delete('/{id}', [UploadedDocumentsController::class, 'destroy'])->name('destroy');
        
        // Bulk actions
        Route::post('/bulk-verify', [UploadedDocumentsController::class, 'bulkVerify'])->name('bulk-verify');
        
        // User package download
        Route::get('/user/{user}/download-package', [UploadedDocumentsController::class, 'downloadUserPackage'])->name('download-package');
        
        // Statistics
        Route::get('/statistics', [UploadedDocumentsController::class, 'statisticsByVisaType'])->name('statistics');
    });

    // PDF Generation for Admin
    Route::get('/applications/{application}/generate-pdf', 
        [PdfGenerationController::class, 'generateAdminPdf'])
        ->name('applications.generate-pdf');

    Route::get('/check-pdf-status', [PdfGenerationController::class, 'checkPdfStatus'])
        ->name('check-pdf-status');
    
    // Admin Guest Routes (not logged in)
    Route::middleware('admin.guest')->group(function() {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Admin Authenticated Routes
    Route::middleware('admin')->group(function() {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/', [DashboardController::class, 'index']); // Redirect admin/ to dashboard

        // User Management
        Route::resource('users', AdminUserController::class)->only([
            'index', 'show', 'edit', 'update', 'destroy'
        ]);

        // Application Management
        Route::controller(ApplicationController::class)->group(function() {
            Route::get('/applications', 'index')->name('applications.index');
            Route::get('/applications/{application}', 'show')->name('applications.show');
            Route::get('/applications/{application}/form-data', 'showFormData')->name('applications.form-data');
            Route::patch('/applications/{application}/status', 'updateStatus')->name('applications.update-status');
            Route::get('/applications/export', 'export')->name('applications.export');
        });

        // Message Management
        Route::group(['prefix' => 'messages', 'as' => 'messages.', 'controller' => AdminMessageController::class], function() {
            Route::get('/', 'index')->name('index');
            Route::get('/conversation/{userId}/{applicationId}', 'conversation')->name('conversation');
            Route::post('/send', 'store')->name('store');
            Route::post('/{message}/reply', 'reply')->name('reply');
            Route::post('/{message}/mark-read', 'markAsRead')->name('mark-read');
            Route::get('/mark-all-read', 'markAllAsRead')->name('mark-all-read');
            Route::get('/unread-count', 'getUnreadCount')->name('unread-count');
            Route::get('/{message}/attachment/{index}', 'downloadAttachment')->name('download-attachment');
            Route::delete('/{message}', 'destroy')->name('destroy');

            // NEW: Panel data endpoint for AJAX
            Route::get('/panel-data', 'getPanelData')->name('panel-data');
            
            // NEW: Bulk action routes
            Route::post('/bulk-mark-read', 'bulkMarkAsRead')->name('bulk-mark-read');
            Route::post('/bulk-delete', 'bulkDelete')->name('bulk-delete');
        });

        // Document Management
        Route::group(['prefix' => 'documents', 'as' => 'documents.', 'controller' => AdminDocumentController::class], function() {
            Route::get('/', 'index')->name('index');
            Route::get('/application/{application}', 'applicationDocuments')->name('application');
            Route::post('/upload', 'store')->name('store');
            Route::patch('/{document}/review', 'review')->name('review');
            Route::get('/{document}/download', 'download')->name('download');
            Route::delete('/{document}', 'destroy')->name('destroy');
        });
    });
});

// Admin redirect
Route::redirect('/admin', '/admin/dashboard');

// Auth routes
Auth::routes();