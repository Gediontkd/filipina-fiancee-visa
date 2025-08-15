<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DropBoxController;
use App\Http\Controllers\FianceVisaApplicationController;
use App\Http\Controllers\AdjustmentOfStatusController;
use App\Http\Controllers\SpouseVisaApplicationController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\FianceVisa\SponsorController;
use App\Http\Controllers\FianceVisa\AlienController;
use App\Http\Controllers\FianceVisa\AlienChildrenController;

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
Route::get('/change-lang', [LocalizationController::class, 'changeLang'])->name('change.lang');

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
Route::group(['middleware' => ['auth', 'application']], function() {
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

    Route::get('/payment', [StripeController::class, 'index'])->name('payment.index');    
    Route::post('/payment', [StripeController::class, 'store'])->name('payment');    

    // Fiance visa step for Sponsor, Alien and Alien Children
    Route::middleware([fianceVisa::class])->group(function(){

    });
    // Fiance visa step form routes
    Route::controller(SponsorController::class)->prefix('fiance-sponsor')->group(function () {
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

    Route::controller(AlienChildrenController::class)->prefix('fiance-alien-child')->group(function () {
        Route::get('/application', 'index')->name('fianceAlienChildApplication');
        Route::post('/child1', 'child1')->name('fianceAlienChild1');        
        Route::post('/child2', 'child2')->name('fianceAlienChild2');        
        Route::post('/child3', 'child3')->name('fianceAlienChild3');        
        Route::post('/child4', 'child4')->name('fianceAlienChild4');        
        Route::post('/child5', 'child5')->name('fianceAlienChild5');        
        Route::post('/previous-and-continue', 'previousOrContinue')->name('fianceAlienChildPreOrCon');       
    });

    // Spouse visa step form routes
    Route::controller(SpouseVisaApplicationController::class)->prefix('spouse-visa')->group(function () {
        Route::get('/application', 'index')->name('spouseVisaApplication');
        Route::post('/name', 'name')->name('spouseName');
        Route::post('/contact', 'contact')->name('spouseContact');
        Route::post('/place-of-birth', 'placeOfBirth')->name('spousePlaceOfBirth');
        Route::post('/status', 'status')->name('spouseStatus');
        Route::post('/marital-status', 'maritalStatus')->name('spouseMaritalStatus');
        Route::post('/other-filing', 'otherFiling')->name('spouseOtherFiling');
        Route::post('/military-conviction', 'militaryConviction')->name('spouseMilitaryConviction');
        Route::post('/address', 'address')->name('spouseAddress');
        Route::post('/relationship', 'relationship')->name('spouseRelationship');
        Route::post('/employment', 'employment')->name('spouseEmployment');
        Route::post('/previous-and-continue', 'previousOrContinue')->name('spousePreviousOrContinue'); 
    });

    // Adjustment of status visa step form routes
    Route::controller(AdjustmentOfStatusController::class)->prefix('adjustment-of-status')->group(function () {
        // Route::get('/', 'index')->name('adjustment.visa');
        Route::get('/adjustment', 'show')->name('adjustment.show');
        Route::get('/{type}', 'application')->name('adjustmentVisaApplication');
        Route::post('/name', 'name')->name('adjustmentName');
        Route::post('/place-of-birth', 'placeOfBirth')->name('adjustmentPlaceOfBirth');
        Route::post('/visa-info', 'visaInfo')->name('adjustmentvisaInfo');
        Route::post('/address', 'address')->name('adjustmentAddress');
        Route::post('/civil-status', 'civilStatus')->name('adjustmentCivilStatus');
        Route::post('/sponsor-part-1', 'sponsorPart1')->name('adjustmentSponsorPart1');
        Route::post('/sponsor-part-2', 'sponsorPart2')->name('adjustmentSponsorPart2');
        Route::post('/qus-part-1', 'qusPart1')->name('adjustmentQusPart1');
        Route::post('/qus-part-2', 'qusPart2')->name('adjustmentQusPart2');
        Route::post('/qus-part-3', 'qusPart3')->name('adjustmentQusPart3');
        Route::post('/qus-part-4', 'qusPart4')->name('adjustmentQusPart4');
        Route::post('/qus-part-5', 'qusPart5')->name('adjustmentQusPart5');
        Route::post('/ead', 'ead')->name('adjustmentEad');
        Route::post('/accommodation', 'accommodation')->name('adjustmentAccommodation');
        Route::post('/interpreter', 'interpreter')->name('adjustmentInterpreter');
        Route::post('/children', 'children')->name('adjustmentChildren');
        Route::post('/affiliation', 'affiliation')->name('adjustmentAffiliation');
        Route::post('/alien-parents', 'alienParents')->name('adjustmentAlienParents');
        Route::post('/alien-employement', 'alienEmployement')->name('adjustmentAlienEmployement');
        Route::post('/previous-and-continue', 'previousOrContinue')->name('adjustmentPreviousOrContinue');
    });

    Route::resource('drop-box', DropBoxController::class);
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['application']], function() {
    Route::get('/fiancee-visa', [FianceVisaApplicationController::class, 'index'])->name('fiancee.visa');
    Route::get('/adjustment-of-status', [AdjustmentOfStatusController::class, 'index'])->name('adjustment.visa');
    Route::get('/spouse-visa', [SpouseVisaApplicationController::class, 'spouseVisa'])->name('spouse.visa');
});

// Route::get('/', function () {
//     \App::setLocale(Session::get('locale'));
//     return view('web.index');
//     return view('web.index');
// })->name('home');

Route::get('/about-us', function () {
    return view('web.about-us');
})->name('about-us');

Route::get('/service', function () {
    if (Auth::check() && isset(Auth::user()->application_route)) {
        return redirect()->route(Auth::user()->application_route);
    }
    return view('web.service.index');
})->name('service');

// Route::get('/fiancee-visa', function () {
//     return view('web.service.fiancee-visa');
// })->name('fiancee.visa');

// Route::get('/spouse-visa', function () {
//     return view('web.service.spouse-visa');
// })->name('spouse.visa');

Route::get('/testimonial', function () {
    return view('web.testimonial');
})->name('testimonial');

Route::get('/contact-us', function () {
    return view('web.contact-us');
})->name('contact-us');

Route::get('/guarantee', function () {
    return view('web.guarantee');
})->name('guarantee');

Auth::routes();
