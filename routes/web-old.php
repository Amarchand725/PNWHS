<?php

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
Auth::routes();
Route::get('/create_new_user', 'Auth\RegisterController@createNewUser');
Route::post('/user_store', 'Auth\RegisterController@userStore');
Route::group(['middleware' => 'auth'], function() {
    Route::post('uniqueuser', 'AllotteeParticularController@uniqueuser');
    Route::get('AllotteeParticular/assigndata','AllotteeParticularController@assigndata');

    Route::get('AllotteeParticular/assignplotview/{id}','AllotteeParticularController@assignplotview');
    Route::get('generate-pdf','HomeController@generatePDF');
    Route::post('getplotprice','AllotteeParticularController@getplotprice');
    Route::post('getconstructor','AllotteeParticularController@getconstructor');
    Route::post('getconstruction','AllotteeParticularController@getconstruction');
    Route::post('assignedplotsubmit','AllotteeParticularController@assignedplotsubmit')->name('assignedplotsubmit');
    Route::resource('Payment', 'PaymentController');
    Route::get('Payment/installment/{id}', 'PaymentController@installment');
    Route::get('Ledger/{id}', 'PaymentController@Ledger');

    Route::get('AllotteeParticular/standalone','AllotteeParticularController@standalone' );
    Route::post('AllotteeParticular/standalonesubmit','AllotteeParticularController@standalonesubmit' )->name('standalonesubmit');

    Route::get('/download_form/{id}', 'AllotteeParticularController@downloadForm');
    Route::get('/download_image/{name}', 'AllotteeParticularController@downloadImage');
    Route::get('/download_kins_doc/{name}', 'AllotteeParticularController@downloadKinsDoc');

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');

    //User Routes
    Route::resource('Users', 'UsersController');
    Route::post('Users/storeChangePassword/{id}','UsersController@storeChangePassword');
    Route::get('Users/ChangePassword/{id}', 'UsersController@ChangePassword');
    Route::get('Users/show/{id}', 'UsersController@show');
    Route::get('Users/destroy/{id}', 'UsersController@destroy');
    Route::get('Users/status/{id}', 'UsersController@status');
    Route::post('Users/statusupdates', 'UsersController@statusupdates');
    Route::post('Users/checkpass', 'UsersController@checkpass');
    Route::post('/Users/Profile', 'UsersController@userProfile');

    //Payment Listing
    Route::get('paymentlisting', 'PaymentController@paymentlisting');

    Route::resource('Applicantform', 'ApplicantformController');
    Route::resource('crud', 'CrudController');
    //Permission work is in
    Route::get('AllotteeParticular/create1', 'AllotteeParticularController@create1')->middleware('urlcontrol');
    //Route::get('AllotteeParticular/createkin/{$id}', 'AllotteeDetailsOfKinController@createkin');
    Route::get('AllotteeDetailsOfKin/create2/{id}', 'AllotteeDetailsOfKinController@create2');
    Route::get('AllotteeDetailsOfKin/create2edit/{id}', 'AllotteeDetailsOfKinController@create2edit');
    Route::get('AllotteeDetailsOfKin/create3/{id}', 'AllotteeDetailsOfKinController@create3');
    Route::get('AllotteeDetailsOfKin/create3edit/{id}', 'AllotteeDetailsOfKinController@create3edit');
    Route::get('AllotteeDetailsOfKin/create4/{id}', 'AllotteeDetailsOfKinController@create4');
    Route::get('AllotteeDetailsOfKin/create4edit/{id}', 'AllotteeDetailsOfKinController@create4edit');
    Route::post('AllotteeDetailsOfKin/receivestore', 'AllotteeDetailsOfKinController@receivestore')->name('receivestore');
    Route::post('AllotteeDetailsOfKin/uploadfiles', 'AllotteeDetailsOfKinController@uploadfiles')->name('uploadfiles');
    Route::post('AllotteeDetailsOfKin/form2update', 'AllotteeDetailsOfKinController@form2update');
    Route::post('AllotteeDetailsOfKin/form3update', 'AllotteeDetailsOfKinController@form3update');
    Route::post('AllotteeDetailsOfKin/form4update', 'AllotteeDetailsOfKinController@form4update');
    Route::get('/get_last_reg_file_no/{id}', 'AllotteeParticularController@getLastRegFileNo'); 

    Route::get('AllotteeParticular/Application_view', 'AllotteeParticularController@applicationdata')->middleware('urlcontrol');

    Route::resource('UserType', 'UserTypeController');
    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });

    Route::resource('AllotteeParticular', 'AllotteeParticularController');
    //Route::get('/AllotteeParticular/create1', 'AllotteeParticularController@create1');

    Route::resource('AllotteeDetailsOfKin', 'AllotteeDetailsOfKinController')->middleware('urlcontrol');
    //Routes User Management
    Route::resource('Userroles', 'UserrolesController');
    Route::get('Userroles/editpermission/{id}','UserrolesController@editpermission');
    Route::post('Userroles/editpermissionstore','UserrolesController@editpermissionstore');
    Route::post('Userroles/destroy','UserrolesController@destroy');
    Route::resource('Userpermission', 'UserpermissionController');
    Route::post('Userpermission/destroy','UserpermissionController@destroy');
    Route::get('Userpermission/show/{id}', 'UserpermissionController@show');
    Route::resource('Userpermission', 'UserpermissionController');
    Route::resource('Userroles', 'UserrolesController');
    //Plot
    Route::post('plotget', 'PlotController@plotget');
    Route::post('plotgetbytype', 'PlotController@plotgetbytype');
    Route::post('sizebytypeplot', 'PlotController@sizebytypeplot');
    Route::post('checkplotavailable', 'PlotController@checkplotavailable');
    //Plot Or Size
    Route::resource('Plot', 'PlotController');
    Route::resource('Size', 'SizeController');
    //Category Property
    Route::resource('Categoryproperty', 'CategorypropertyController');

    //Get Stand Alone form
    //Notification Route
    Route::get('AllotteeParticular/approveapp/{id}','AllotteeParticularController@approveapp');
    Route::get('Users/approve/{id}','AllotteeParticularController@approve');
    Route::get('AllotteeParticular/approveappbyuser/{id}/{seen}','AllotteeParticularController@approveappbyuser');
    Route::post('AllotteeParticular/updatefile','AllotteeParticularController@updatefile')->name('updatefile');
    Route::get('AllotteeParticular/viewfiles/{id}','AllotteeParticularController@viewfiles');
    Route::get('AllotteeDetailsOfKin/destroy/{id}','AllotteeDetailsOfKinController@destroy');

    //Property Type
    Route::resource('Propertytype', 'PropertytypeController');
    Route::resource('Block', 'BlockController');
    Route::get('block_delete', 'BlockController@blockDelete');
    Route::resource('Constructor', 'ConstructorController');
    Route::get('Constructor/destroy/{id}', 'ConstructorController@destroy');
    Route::resource('Construction', 'ConstructionController');
    // Route::get('Construction/ledger/{id}', 'ConstructionController@ledger');
    Route::get('contructor_ledger/{id}', 'ConstructorController@contructorLedger');
    Route::get('Construction/destroy/{id}', 'ConstructionController@destroy');
    Route::get('construction_status', 'ConstructionController@constructionStatus');
    Route::get('Feedback/destroy/{id}', 'FeedbackController@destroy');

    Route::resource('Membershippayment', 'MembershippaymentController');

    Route::get('/import', 'ImportController@getImport');
    Route::post('/import_parse', 'ImportController@parseImport')->name('import_parse');
    Route::post('/import_process', 'ImportController@processImport')->name('import_process');

    //Reports Routes here

    Route::get('/Report/generalReport', 'ReportController@generalReport');

    Route::get('/Report/memberReport', 'ReportController@membershipReport');
    Route::get('/Report/allotmentReport', 'ReportController@allotmentReport');

    Route::resource('MonthlyInstalment', 'MonthlyInstalmentController');
    Route::resource('Rank', 'RankController');
    Route::resource('PaymentPolicy', 'PaymentPolicyController');

    Route::get('/member_financial_report', 'ReportController@memberFinancialReport');
    Route::get('/project_financial_report', 'ReportController@projectFinancialReport');
    Route::get('/eligibility_report', 'ReportController@eligibilityReport');
    Route::get('/profit_statement_report', 'ReportController@profitStatementReport');
    Route::get('/search', 'ReportController@search');

    Route::get('/search_membership_members', 'ReportController@searchMembershipMembers');

    Route::resource('Feedback', 'FeedbackController');

    Route::resource('Newsletter', 'NewsletterController');
    Route::get('Newsletter/destroy/{id}', 'NewsletterController@destroy');

    Route::resource('HouseCost', 'HouseCostController');
    Route::get('allocate_house/{id}', 'PaymentController@allocateHouse');
    Route::post('allocated_house', 'PaymentController@allocatedHouse');
    Route::post('get_house_details', 'PaymentController@getHouseDetails');
    Route::resource('AllotedHouse', 'AllotedHouseController');
    Route::resource('MemberProfit', 'MemberProfitController');

    Route::post('/get_profit', 'PaymentController@getProfit');

    Route::get('activemembers', 'AllotteeParticularController@activemembers');
    Route::post('/member_status', 'AllotteeParticularController@memberStatus');
    
    Route::post('/update_form_status', 'AllotteeParticularController@updateFormStatus');

    Route::get('allotee_completed_details/{id}', 'AllotteeParticularController@allotee_completed_details');

    Route::post('/member_more_details', 'AllotteeParticularController@memberMoreDetails');
    Route::resource('GalleryImage', 'GalleryImageController');
    Route::resource('CsvFile', 'CsvFileController');
    Route::resource('CsvData', 'CsvDataController');
    Route::post('/register_members', 'CsvFileController@registerMembers');
    Route::get('/import_file', 'CsvFileController@importFile');
    Route::post('/parse_file', 'CsvFileController@parseFile');
    Route::post('/process_file', 'CsvFileController@processFile');
    Route::resource('CsvRawData', 'CsvRawDataController');
    Route::resource('Csv_Raw_File', 'Csv_Raw_FileController');

    Route::get('/delete_image', 'AllotteeParticularController@deleteImage');
    Route::get('/delete_next_kin_img', 'AllotteeParticularController@deleteNextKinImg');
    Route::resource('PromotedMember', 'PromotedMemberController');
    
    Route::resource('GetProfit', 'GetProfitController');
    Route::post('/release_profit_payment', 'GetProfitController@releaseProfitPayment');
    Route::post('/get_profit_details', 'GetProfitController@getProfitDetails');
    Route::get('/download_sheet_sample', 'CsvFileController@downloadSheetSample');
});