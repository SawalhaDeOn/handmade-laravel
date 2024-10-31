<?php


use App\Http\Controllers\Conversations\{
    SysNotifiController,
    SysSmsNotifiController,
    WhatsAppHistoryController,
    TawkController,
};
use App\Http\Controllers\Calls\{
    ClientCallController,
    CallTasksCallController,


};
use App\Http\Controllers\SMS\{
    ClientSMSController,
    CallTaskSMSController

};

use App\Http\Controllers\Settings\{
    ConstantsController,
    MenuController,
    QuestionnaireController,
};
use App\Http\Controllers\UserManagement\{
    PermissionController,
    RolesController,
    UsersController
};
use App\Http\Controllers\Reviews\{
    ReviewsController,

};

use App\Http\Controllers\Features\{
    FeaturesController,

};


use App\Http\Controllers\Services\{
    ServicesController,

};
use App\Http\Controllers\Sliders\{
    SlidersController,

};

use App\Http\Controllers\Leads\{
    LeadController,
    LeadAttachmentController
};

use App\Http\Controllers\{
    Authentication\LoginController,
    CallScheduleController,
    CountryCityController,
    DashboardController,
    LanguageSwitcherController,

};

use App\Http\Controllers\Clients\{
    ClientController,
    ClientAttachmentController,

};
use App\Http\Controllers\CDR\{
    CallsController,
    CdrController,
};
use App\Http\Controllers\Complains\ComplainController;
use App\Http\Controllers\Complains\ComplainAttachmentController;

use App\Http\Controllers\Quote\QuoteRequestController;
use App\Http\Controllers\Settings\MenuWebSiteController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale()], function () {


    // for login

    Route::get('/', 'App\Http\Controllers\MainController@index');
    Route::get('index', 'App\Http\Controllers\MainController@index')->name('index');
    Route::post('leadForm1', 'App\Http\Controllers\MainController@leadForm1')->name('leadForm1');
    Route::post('leadForm2', 'App\Http\Controllers\MainController@leadForm2')->name('leadForm2');


    Route::get('/webhookwa', [LoginController::class, 'webhookwa'])->name('webhookwa');
    Route::post('/webhookwa', [LoginController::class, 'webhookwa2'])->name('webhookwa2');
    Route::post('/testwhatsapp', [LoginController::class, 'testwhatsapp'])->name('testwhatsapp');

    Route::get('/webhooktawk', [LoginController::class, 'webhooktawk'])->name('webhooktawk');
    Route::post('/webhooktawk', [LoginController::class, 'webhooktawk2'])->name('webhooktawk');
    Route::post('/testtawk', [LoginController::class, 'testtawk'])->name('testtawk');

    Route::group(['prefix' => 'cp'], function () {

        Route::get('/login', function () {
            return view('authentication.signIn');
        })->name('login');


        Route::get('/setLangauge/{language}', [LanguageSwitcherController::class, 'setLanguage'])->name('setLanguage');
        Route::get('getSelect', [\App\Http\Controllers\Controller::class, 'getSelect'])->name('getSelect');
        Route::prefix('user-management')->name('user-management.')->group(function () {
            Route::prefix('permissions')->name('permissions.')
                ->middleware(['permission:user_management_access'])
                ->group(function () {
                    Route::match(['get', 'post'], '/', [PermissionController::class, 'index'])->name('index');
                    Route::post('/add-permission', [PermissionController::class, 'addPermission'])->name('add');
                    Route::post('/delete-permission/{permission}', [PermissionController::class, 'deletePermission'])->name('delete');
                });

            Route::prefix('roles')->name('roles.')
                ->middleware(['permission:user_management_access'])
                ->group(function () {
                    Route::get('/', [RolesController::class, 'index'])->name('index');
                    Route::get('/getCards', [RolesController::class, 'getCards'])->name('getCards');
                    Route::get('/create', [RolesController::class, 'create'])->name('create');
                    Route::post('/store', [RolesController::class, 'store'])->name('store');
                    Route::get('/{role}/edit', [RolesController::class, 'edit'])->name('edit');
                    Route::post('{role}/update', [RolesController::class, 'update'])->name('update');
                    Route::delete('{role}/delete', [RolesController::class, 'delete'])->name('delete');
                });

            Route::prefix('users')->name('users.')
                ->middleware(['permission:user_management_access'])
                ->group(function () {
                    Route::match(['get', 'post'], '/', [UsersController::class, 'index'])->name('index');
                    Route::get('/create', [UsersController::class, 'create'])->name('create');
                    Route::post('/store', [UsersController::class, 'store'])->name('store');
                    Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('edit');
                    Route::post('{user}/update', [UsersController::class, 'update'])->name('update');
                    Route::delete('{user}/delete', [UsersController::class, 'delete'])->name('delete');

                    Route::get('/export', [UsersController::class, 'export'])->name('export');
                });
        });

        Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
        Route::get('/updateCDR', [CdrController::class, 'updateLocalCDR'])->name('updateLocalCDR');
        Route::middleware(['auth', 'language'])->group(function () {
            Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
            Route::get('/', [DashboardController::class, 'index'])->name('home');

            Route::impersonate();

            Route::prefix('dashboard')->name('dashboard.')->group(function () {
                Route::get('/', [DashboardController::class, 'index'])->name('index');
            });

            Route::prefix('getUnreadMessages')->name('dashboard.')->group(function () {
                Route::get('/', [DashboardController::class, 'getUnreadMessages'])->name('getUnreadMessages');
            });
            Route::prefix('getWhatsAppMessage')->name('dashboard.')->group(function () {
                Route::get('/', [DashboardController::class, 'getWhatsAppMessage'])->name('getWhatsAppMessage');
            });
            Route::prefix('sendWhatsappChat')->name('dashboard.')->group(function () {
                Route::post('/', [DashboardController::class, 'sendWhatsappChat'])->name('sendWhatsappChat');
            });
            Route::prefix('createAtt')->name('dashboard.')->group(function () {
                Route::get('/', [DashboardController::class, 'createAtt'])->name('createAtt');
            });
            Route::prefix('storeAtt')->name('dashboard.')->group(function () {
                Route::post('/', [DashboardController::class, 'storeAtt'])->name('storeAtt');
            });

            //Set Locale
            Route::get('/setLangauge/{language}', [LanguageSwitcherController::class, 'setLanguage'])->name('setLanguage');

            Route::prefix('user-management')->name('user-management.')->group(function () {
                Route::prefix('permissions')->name('permissions.')
                    ->middleware(['permission:user_management_access'])
                    ->group(function () {
                        Route::match(['get', 'post'], '/', [PermissionController::class, 'index'])->name('index');
                        Route::post('/add-permission', [PermissionController::class, 'addPermission'])->name('add');
                        Route::post('/delete-permission/{permission}', [PermissionController::class, 'deletePermission'])->name('delete');
                    });

                Route::prefix('roles')->name('roles.')
                    ->middleware(['permission:user_management_access'])
                    ->group(function () {
                        Route::get('/', [RolesController::class, 'index'])->name('index');
                        Route::get('/getCards', [RolesController::class, 'getCards'])->name('getCards');
                        Route::get('/create', [RolesController::class, 'create'])->name('create');
                        Route::post('/store', [RolesController::class, 'store'])->name('store');
                        Route::get('/{role}/edit', [RolesController::class, 'edit'])->name('edit');
                        Route::post('{role}/update', [RolesController::class, 'update'])->name('update');
                        Route::delete('{role}/delete', [RolesController::class, 'delete'])->name('delete');
                    });

                Route::prefix('users')->name('users.')
                    ->middleware(['permission:user_management_access'])
                    ->group(function () {
                        Route::match(['get', 'post'], '/', [UsersController::class, 'index'])->name('index');
                        Route::get('/create', [UsersController::class, 'create'])->name('create');
                        Route::post('/store', [UsersController::class, 'store'])->name('store');
                        Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('edit');
                        Route::post('{user}/update', [UsersController::class, 'update'])->name('update');
                        Route::delete('{user}/delete', [UsersController::class, 'delete'])->name('delete');

                        Route::get('/export', [UsersController::class, 'export'])->name('export');
                    });
            });


            Route::prefix('settings')->name('settings.')
                ->group(function () {
                    Route::prefix('CountriesCities')->name('country-city.')
                        ->middleware(['permission:settings_country_city_access'])
                        ->group(function () {
                            Route::get('/', [CountryCityController::class, 'index'])->name('index');
                            Route::post('/Countries', [CountryCityController::class, 'countries'])->name('countries');
                            Route::post('/Cities', [CountryCityController::class, 'cities'])->name('cities');

                            Route::get('country/create', [CountryCityController::class, 'country_create'])->name('country.create');
                            Route::post('country/store', [CountryCityController::class, 'country_store'])->name('country.store');
                            Route::get('country/{country}/edit', [CountryCityController::class, 'country_edit'])->name('country.edit');
                            Route::post('country/{country}/update', [CountryCityController::class, 'country_update'])->name('country.update');
                            Route::delete('country/{country}/delete', [CountryCityController::class, 'country_delete'])->name('country.delete');

                            Route::get('city/create', [CountryCityController::class, 'city_create'])->name('city.create');
                            Route::post('city/store', [CountryCityController::class, 'city_store'])->name('city.store');
                            Route::get('city/{city}/edit', [CountryCityController::class, 'city_edit'])->name('city.edit');
                            Route::post('city/{city}/update', [CountryCityController::class, 'city_update'])->name('city.update');
                            Route::delete('city/{city}/delete', [CountryCityController::class, 'city_delete'])->name('city.delete');
                        });

                    Route::prefix('Menus')->name('menus.')
                        ->middleware(['permission:settings_menu_access'])
                        ->group(function () {
                            Route::match(['GET', 'POST'], '/', [MenuController::class, 'index'])->name('index');
                            Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
                            Route::post('{menu}/update', [MenuController::class, 'update'])->name('update');

                        });


                    Route::prefix('questionnaires')->name('questionnaires.')
                        ->middleware(['permission:settings_questionnaire_access'])
                        ->group(function () {
                            Route::match(['GET', 'POST'], '/', [QuestionnaireController::class, 'index'])->name('index');
                            Route::get('/create', [QuestionnaireController::class, 'create'])->name('create');
                            Route::post('/store', [QuestionnaireController::class, 'store'])->name('store');
                            Route::get('/{questionnaire}/edit', [QuestionnaireController::class, 'edit'])->name('edit');
                            Route::post('{questionnaire}/update', [QuestionnaireController::class, 'update'])->name('update');
                            Route::delete('{questionnaire}/delete', [QuestionnaireController::class, 'delete'])->name('delete');

                            Route::get('{questionnaire}/get_questions', [QuestionnaireController::class, 'getQuestionnaireQuestions'])->name('get_questions');
                        });


                    Route::prefix('Constants')->name('constants.')
                        ->middleware(['permission:settings_constants_access'])
                        ->group(function () {
                            Route::match(['GET', 'POST'], '/', [ConstantsController::class, 'index'])->name('index');
                            Route::post('/store', [ConstantsController::class, 'store'])->name('store');
                            Route::get('/{constant}/edit/{module?}', [ConstantsController::class, 'edit'])->name('edit');
                            Route::post('/{constant}/update/{module?}', [ConstantsController::class, 'update'])->name('update');
                        });
                });

            Route::prefix('menuWebsite')->name('menuWebsite.')
                ->middleware(['permission:settings_menu_access'])
                ->group(function () {
                    Route::get('/create', [MenuWebSiteController::class, 'create'])->name('create');

                    Route::match(['GET', 'POST'], '/', [MenuWebSiteController::class, 'index'])->name('index');
                    Route::get('/{menu}/edit', [MenuWebSiteController::class, 'edit'])->name('edit');
                    Route::post('{menu}/update', [MenuWebSiteController::class, 'update'])->name('update');
                    Route::post('/store', [MenuWebSiteController::class, 'store'])->name('store');

                });
            Route::prefix('clients')->name('clients.')
                ->group(function () {
                    Route::get('/export', [ClientController::class, 'export'])->name('export')->middleware(['permission:client_access']);
                    Route::get('/getCitiesForSelectedCountry/{country}', [CountryCityController::class, 'getCountryCities'])->name('getCountryCities');
                    Route::match(['get', 'post'], '/', [ClientController::class, 'index'])->name('index')
                        ->middleware(['permission:client_access']);
                    Route::get('/getByTelephone/{telephone}', [ClientController::class, 'getByTelephone'])->name('getByTelephone');

                    Route::get('/create', [ClientController::class, 'create'])->name('create')->middleware(['permission:client_add']);
                    Route::post('/store', [ClientController::class, 'store'])->name('store')->middleware(['permission:client_add']);
                    Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('edit')->middleware(['permission:client_edit']);
                    Route::post('{client}/update', [ClientController::class, 'update'])->name('update')->middleware(['permission:client_edit']);
                    Route::delete('{client}/delete', [ClientController::class, 'delete'])->name('delete')->middleware(['permission:client_delete']);
                    Route::post('/Client/{Id?}', [ClientController::class, 'Client'])->name('addedit')
                        ->middleware(['permission:client_add']);
                    Route::match(['GET', 'POST'], '/{client}/attachments', [ClientAttachmentController::class, 'index'])->name('attachments')->middleware(['permission:client_edit']);
                    Route::prefix('attachments')->name('attachments.')
                        ->middleware(['permission:client_edit'])
                        ->group(function () {
                            Route::get('/{client}/create', [ClientAttachmentController::class, 'create'])->name('create');
                            Route::post('/{client}/store', [ClientAttachmentController::class, 'store'])->name('store');
                            Route::get('/{client}/{attachment}/edit', [ClientAttachmentController::class, 'edit'])->name('edit');
                            Route::post('/{client}/{attachment}/update', [ClientAttachmentController::class, 'update'])->name('update');
                            Route::delete('/{attachment}/delete', [ClientAttachmentController::class, 'delete'])->name('delete');
                        });
                    Route::get('{client}/client_calls', [ClientController::class, 'viewCalls'])->name('view_calls')
                        ->middleware(['permission:client_edit']);
                    Route::get('{client}/viewattachments', [ClientController::class, 'viewAttachments'])->name('view_attachments')
                        ->middleware(['permission:client_edit']);


                });
            Route::prefix('leads')->name('leads.')
                ->group(function () {
                    Route::get('/export', [LeadController::class, 'export'])->name('export')->middleware(['permission:lead_access']);
                    Route::get('/getCitiesForSelectedCountry/{country}', [CountryCityController::class, 'getCountryCities'])->name('getCountryCities');
                    Route::match(['get', 'post'], '/', [LeadController::class, 'index'])->name('index')
                        ->middleware(['permission:lead_access']);
                    Route::get('/create', [LeadController::class, 'create'])->name('create')->middleware(['permission:lead_add']);
                    Route::post('/store', [LeadController::class, 'store'])->name('store')->middleware(['permission:lead_add']);
                    Route::get('/{lead}/edit', [LeadController::class, 'edit'])->name('edit')->middleware(['permission:lead_edit']);
                    Route::post('{lead}/update', [LeadController::class, 'update'])->name('update')->middleware(['permission:lead_edit']);
                    Route::delete('{lead}/delete', [LeadController::class, 'delete'])->name('delete')->middleware(['permission:lead_delete']);
                    Route::post('/Lead/{Id?}', [LeadController::class, 'Lead'])->name('addedit')
                        ->middleware(['permission:lead_add']);


                    Route::match(['GET', 'POST'], '/{lead}/attachments', [LeadAttachmentController::class, 'index'])->name('attachments')->middleware(['permission:lead_edit']);
                    Route::prefix('attachments')->name('attachments.')
                        ->middleware(['permission:lead_edit'])
                        ->group(function () {
                            Route::get('/{lead}/create', [LeadAttachmentController::class, 'create'])->name('create');
                            Route::post('/{lead}/store', [LeadAttachmentController::class, 'store'])->name('store');
                            Route::get('/{lead}/{attachment}/edit', [LeadAttachmentController::class, 'edit'])->name('edit');
                            Route::post('/{lead}/{attachment}/update', [LeadAttachmentController::class, 'update'])->name('update');
                            Route::delete('/{attachment}/delete', [LeadAttachmentController::class, 'delete'])->name('delete');
                        });

                    Route::get('{lead}/sms', [LeadController::class, 'viewSMS'])->name('view_sms')
                        ->middleware(['permission:lead_edit']);
                    Route::get('{lead}/calls', [LeadController::class, 'viewCalls'])->name('view_calls')
                        ->middleware(['permission:lead_edit']);

                    Route::get('{lead}/items', [LeadController::class, 'viewItems'])->name('view_items')
                        ->middleware(['permission:lead_edit']);

                    Route::get('{lead}/clients', [LeadController::class, 'viewClients'])->name('view_clients')
                        ->middleware(['permission:lead_edit']);
                    Route::get('{lead}/tickets', [LeadController::class, 'viewTickets'])->name('view_tickets')
                        ->middleware(['permission:lead_edit']);


                    Route::get('{lead}/viewattachments', [LeadController::class, 'viewAttachments'])->name('view_attachments')
                        ->middleware(['permission:lead_edit']);

                    Route::get('{lead}/teams', [LeadController::class, 'viewItems'])->name('view_teams')
                        ->middleware(['permission:lead_edit']);


                });


            Route::prefix('conversations')->name('conversations.')
                ->group(function () {
                    Route::prefix('sms')->name('sms.')
                        ->group(function () {
                            Route::match(['get', 'post'], '/', [SysSmsNotifiController::class, 'index'])->name('index')
                                ->middleware(['permission:sys_sms_notify_access']);
                        });

                    Route::prefix('whatsapp_history')->name('whatsapp_history.')
                        ->group(function () {
                            Route::match(['get', 'post'], '/', [WhatsAppHistoryController::class, 'index'])->name('index')
                                ->middleware(['permission:whatsapp_history_access']);
                        });

                    Route::prefix('tawk')->name('tawk.')
                        ->group(function () {
                            Route::match(['get', 'post'], '/', [TawkController::class, 'index'])->name('index')
                                ->middleware(['permission:tawk_access']);
                            Route::match(['get', 'post'], '{tawk}/changeStatus', [TawkController::class, 'changeStatus'])->name('changeStatus')
                                ->middleware(['permission:tawk_edit']);
                            Route::delete('{tawk}/delete', [TawkController::class, 'delete'])->name('delete');

                        });

                    Route::prefix('sys_notifications')->name('sys_notifications.')
                        ->group(function () {
                            Route::match(['get', 'post'], '/', [SysNotifiController::class, 'index'])->name('index')
                                ->middleware(['permission:sys_notifications_access']);
                        });
                });


            Route::prefix('cdr')->name('cdr.')
                ->group(function () {
                    Route::match(['get', 'post'], '/', [CdrController::class, 'index'])->name('index')
                        ->middleware(['permission:cdr_access']);
                });


            Route::prefix('complains')->name('complains.')
                ->group(function () {
                    Route::match(['get', 'post'], '/', [ComplainController::class, 'index'])->name('index')
                        ->middleware(['permission:complain_access']);
                    Route::get('/create/{Id?}', [ComplainController::class, 'create'])->name('create')
                        ->middleware(['permission:complain_add']);
                    Route::post('/complain/{Id?}', [ComplainController::class, 'Complain'])->name('addedit')
                        ->middleware(['permission:complain_edit']);
                    Route::delete('{complain}/delete', [ComplainController::class, 'delete'])->name('delete')
                        ->middleware(['permission:complain_delete']);
                    Route::get('{complain}/assignUser', [ComplainController::class, 'assignUser'])->name('assignUser')
                        ->middleware(['permission:complain_edit']);
                    Route::match(['get', 'post'], '{complain}/assignUser', [ComplainController::class, 'assignUser'])->name('assignUser')
                        ->middleware(['permission:complain_edit']);
                    Route::match(['get', 'post'], '{complain}/changeStatus', [ComplainController::class, 'changeStatus'])->name('changeStatus')
                        ->middleware(['permission:complain_edit']);

                    Route::match(['GET', 'POST'], '/{complain}/attachments', [ComplainAttachmentController::class, 'index'])->name('attachments')->middleware(['permission:complain_edit']);
                    Route::prefix('attachments')->name('attachments.')
                        ->middleware(['permission:complain_edit'])
                        ->group(function () {
                            Route::get('/{complain}/create', [ComplainAttachmentController::class, 'create'])->name('create');
                            Route::post('/{complain}/store', [ComplainAttachmentController::class, 'store'])->name('store');
                            Route::get('/{complain}/{attachment}/edit', [ComplainAttachmentController::class, 'edit'])->name('edit');
                            Route::post('/{complain}/{attachment}/update', [ComplainAttachmentController::class, 'update'])->name('update');
                            Route::delete('/{attachment}/delete', [ComplainAttachmentController::class, 'delete'])->name('delete');
                        });

                });

            Route::prefix('cdr')->name('cdr.')
                ->group(function () {
                    Route::match(['get', 'post'], '/', [CdrController::class, 'index'])->name('index')
                        ->middleware(['permission:cdr_access']);
                    Route::match(['post'], '/indexMobile/{mobile?}', [CdrController::class, 'indexMobile'])->name('indexMobile');


                    Route::match(['get', 'post'], '/{telephone}/indexHistory', [CdrController::class, 'indexHistory'])->name('indexHistory')
                        ->middleware(['permission:cdr_access']);
                });
            Route::prefix('calls')->name('calls.')
                ->group(function () {
                    Route::get('/{client}/calls', [ClientCallController::class, 'view_clients_calls'])->name('client.view_clients_calls')
                        ->middleware(['permission:client_call_access']);
                    Route::get('/{client}/create', [ClientCallController::class, 'create'])->name('client.create')
                        ->middleware(['permission:client_call_add']);
                    Route::post('/{client}/store', [ClientCallController::class, 'store'])->name('client.store')
                        ->middleware(['permission:client_call_add']);
                    Route::get('/{client}/{call}/edit', [ClientCallController::class, 'edit'])->name('client.edit')
                        ->middleware(['permission:client_call_edit']);
                    Route::post('/{client}/{call}/update', [ClientCallController::class, 'update'])->name('client.update')
                        ->middleware(['permission:client_call_edit']);


                    Route::get('/{client}/calls', [ClientCallController::class, 'view_clients_calls'])->name('client.view_clients_calls')
                        ->middleware(['permission:client_call_access']);
                    Route::get('/{client}/create', [ClientCallController::class, 'create'])->name('client.create')
                        ->middleware(['permission:client_call_add']);
                    Route::post('/{client}/store', [ClientCallController::class, 'store'])->name('client.store')
                        ->middleware(['permission:client_call_add']);
                    Route::get('/{client}/{call}/edit', [ClientCallController::class, 'edit'])->name('client.edit')
                        ->middleware(['permission:client_call_edit']);
                    Route::post('/{client}/{call}/update', [ClientCallController::class, 'update'])->name('client.update')
                        ->middleware(['permission:client_call_edit']);


                    Route::delete('/{call}/delete', [ClientCallController::class, 'delete'])->name('client.delete')
                        ->middleware(['permission:client_call_delete']);

                    Route::get('/{call}/questionnaireResponses', [ClientCallController::class, 'view_call_questionnaire_responses'])->name('client.view_call_questionnaire_responses')
                        ->middleware(['permission:client_call_access']);


                    Route::get('/{callTask}/callCallsTask', [CallTasksCallController::class, 'view_callTasks_calls'])->name('callTask.view_calls')
                        ->middleware(['permission:callTasks_module_access']);
                    Route::get('/{callTask}/createCallsCallsTask', [CallTasksCallController::class, 'create'])->name('callTask.create')
                        ->middleware(['permission:callTasks_module_add']);
                    Route::post('/{callTask}/storeCallsCallsTask', [CallTasksCallController::class, 'store'])->name('callTask.store')
                        ->middleware(['permission:callTasks_module_add']);
                    Route::get('/{callTask}/{call}/editCallsCallsTask', [CallTasksCallController::class, 'edit'])->name('callTask.edit')
                        ->middleware(['permission:callTasks_module_edit']);
                    Route::post('/{callTask}/{call}/CallsupdateCallsTask', [CallTasksCallController::class, 'update'])->name('callTask.update')
                        ->middleware(['permission:callTasks_module_edit']);
                    Route::delete('/{callTask}/deleteCallsCallsTask', [CallTasksCallController::class, 'delete'])->name('callTask.delete')
                        ->middleware(['permission:callTasks_module_delete']);

                    Route::get('/{callTask}/questionnaireResponsesCallsCallsTask', [CallTasksCallController::class, 'view_call_questionnaire_responses'])->name('callTask.view_call_questionnaire_responses')
                        ->middleware(['permission:callTasks_module_access']);
                    Route::match(['get', 'post'], '/indexByPhone', [CdrController::class, 'indexByPhone'])->name('indexByPhone')
                        ->middleware(['permission:calls_module_access']);


                });

            Route::prefix('sms')->name('sms.')
                ->group(function () {
                    Route::get('{client}/sms', [ClientSMSController::class, 'view_clients_sms'])->name('client.view_clients_sms')
                        ->middleware(['permission:client_sms_access']);
                    Route::get('/{client}/create', [ClientSMSController::class, 'create'])->name('client.create')
                        ->middleware(['permission:client_sms_add']);
                    Route::post('/{client}/store', [ClientSMSController::class, 'store'])->name('client.store')
                        ->middleware(['permission:client_sms_add']);


                    Route::get('{client}/sms', [ClientSMSController::class, 'view_clients_sms'])->name('client.view_clients_sms')
                        ->middleware(['permission:client_sms_access']);
                    Route::get('/{client}/create', [ClientSMSController::class, 'create'])->name('client.create')
                        ->middleware(['permission:client_sms_add']);
                    Route::post('/{client}/store', [ClientSMSController::class, 'store'])->name('client.store')
                        ->middleware(['permission:client_sms_add']);


                    Route::get('{callTask}/smsCallTask', [CallTaskSMSController::class, 'view_callTasks_sms'])->name('callTask.view_callTasks_sms')
                        ->middleware(['permission:callTask_sms_access']);
                    Route::get('/{callTask}/createCallTask', [CallTaskSMSController::class, 'create'])->name('callTask.create')
                        ->middleware(['permission:callTask_sms_add']);
                    Route::post('/{callTask}/storeCallTask', [CallTaskSMSController::class, 'store'])->name('callTask.store')
                        ->middleware(['permission:callTask_sms_add']);

                });

            Route::prefix('callschedule')->name('callschedule.')
                ->group(function () {
                    Route::match(['get', 'post'], '/', [CallScheduleController::class, 'index'])->name('index')
                        ->middleware(['permission:callschedule_access']);
                    Route::get('/{user}/GetUserSchedules', [CallScheduleController::class, 'GetUserSchedules'])->name('GetUserSchedules')
                        ->middleware(['permission:callschedule_edit']);
                });


            Route::prefix('services')->name('services.')
                ->middleware(['permission:service_access'])
                ->group(function () {
                    Route::match(['get', 'post'], '/', [ServicesController::class, 'index'])->name('index');
                    Route::get('/create', [ServicesController::class, 'create'])->name('create');
                    Route::post('/store', [ServicesController::class, 'store'])->name('store');
                    Route::get('/{service}/edit', [ServicesController::class, 'edit'])->name('edit');
                    Route::post('{service}/update', [ServicesController::class, 'update'])->name('update');
                    Route::delete('{service}/delete', [ServicesController::class, 'delete'])->name('delete');

                    Route::get('/export', [ServicesController::class, 'export'])->name('export');
                });


            Route::prefix('reviews')->name('reviews.')
                ->middleware(['permission:review_access'])
                ->group(function () {
                    Route::match(['get', 'post'], '/', [ReviewsController::class, 'index'])->name('index');
                    Route::get('/create', [ReviewsController::class, 'create'])->name('create');
                    Route::post('/store', [ReviewsController::class, 'store'])->name('store');
                    Route::get('/{review}/edit', [ReviewsController::class, 'edit'])->name('edit');
                    Route::post('{review}/update', [ReviewsController::class, 'update'])->name('update');
                    Route::delete('{review}/delete', [ReviewsController::class, 'delete'])->name('delete');

                    Route::get('/export', [ReviewsController::class, 'export'])->name('export');
                });


            Route::prefix('sliders')->name('sliders.')
                ->middleware(['permission:slider_access'])
                ->group(function () {
                    Route::match(['get', 'post'], '/', [SlidersController::class, 'index'])->name('index');
                    Route::get('/create', [SlidersController::class, 'create'])->name('create');
                    Route::post('/store', [SlidersController::class, 'store'])->name('store');
                    Route::get('/{slider}/edit', [SlidersController::class, 'edit'])->name('edit');
                    Route::post('{slider}/update', [SlidersController::class, 'update'])->name('update');
                    Route::delete('{slider}/delete', [SlidersController::class, 'delete'])->name('delete');

                    Route::get('/export', [SlidersController::class, 'export'])->name('export');
                });


            Route::prefix('features')->name('features.')
                ->middleware(['permission:feature_access'])
                ->group(function () {
                    Route::match(['get', 'post'], '/', [FeaturesController::class, 'index'])->name('index');
                    Route::get('/create', [FeaturesController::class, 'create'])->name('create');
                    Route::post('/store', [FeaturesController::class, 'store'])->name('store');
                    Route::get('/{feature}/edit', [FeaturesController::class, 'edit'])->name('edit');
                    Route::post('{feature}/update', [FeaturesController::class, 'update'])->name('update');
                    Route::delete('{feature}/delete', [FeaturesController::class, 'delete'])->name('delete');

                    Route::get('/export', [FeaturesController::class, 'export'])->name('export');
                });
            Route::resource('quote_requests', QuoteRequestController::class);


        });
    });
});
