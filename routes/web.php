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

Route::get('/', function () {
    return redirect('/User/index');
});

Route::get('/clear-cache', function() {
	Artisan::call('cache:clear');
	Artisan::call('view:clear');
	Cache::flush();
    return "Cache is cleared";
});

Route::get('/MessageNew', 'UserController@MessageNew');
Route::get('/GetMessageHistory/{string}', 'UserController@GetMessageHistory');
Route::get('/getNotification', 'UserController@getNotification');
Route::get('/getSectorIndustry', 'UserController@getSectorIndustry');
Route::get('/getRegionCountries', 'UserController@getRegionCountries');


Route::group(['prefix' => '/Admin'], function(){
	Route::get('/dashboard', 'AdminController@dashboard');
	Route::get('/index','AdminController@index');
	Route::match(['GET','POST'],'/adminLogin','AdminController@adminLogin');
	Route::match(['GET','POST'],'/User','AdminController@User');
	Route::match(['GET'], '/findUser','AdminController@findUser');
	Route::get('/logout', 'AdminController@logout');
	Route::match(['GET','POST'],'/InactiveUser','AdminController@InactiveUser');
	Route::match(['GET','POST'],'/ApprovedProfile','AdminController@ApprovedProfile');
	Route::match(['GET','POST'],'/DeleteUser','AdminController@DeleteUser');
	Route::get('/editUser/{id}','AdminController@editUser');
	Route::match(['GET','POST'],'/SaveUser','AdminController@SaveUser');
	Route::match(['GET','POST'],'/viewMeetings','AdminController@viewMeetings');
	Route::match(['GET','POST'],'/addUserForm','AdminController@addUserForm');
	Route::match(['GET','POST'],'/addNewUser','AdminController@addNewUser');
	Route::match(['GET','POST'],'contactus','AdminController@contactus');
	Route::match(['GET','POST'],'report','AdminController@report');
	Route::match(['GET','POST'],'deleteContactMessage','AdminController@deleteContactMessage');
	Route::match(['GET','POST'],'deleteReportAbuse','AdminController@deleteReportAbuse');
	
	Route::get('viewContactMessage/{id}','AdminController@viewContactMessage');
	Route::match(['GET','POST'],'ApprovedMeeting','AdminController@ApprovedMeeting');
	Route::match(['GET','POST'],'approveAllMeetings','AdminController@approveAllMeetings');
	Route::match(['GET','POST'],'InactiveMeeting','AdminController@InactiveMeeting');
	Route::match(['GET','POST'],'/viewCompanyType','AdminController@viewCompanyType');
	Route::match(['GET','POST'],'/AddCompanyTypeForm','AdminController@AddCompanyTypeForm');
	Route::match(['GET','POST'],'/AddCompanyType','AdminController@AddCompanyType');
	Route::match(['GET','POST'],'/DeleteCompanyType','AdminController@DeleteCompanyType');
	Route::get('/EditCompanyType/{id}','AdminController@EditCompanyType');
	Route::match(['GET','POST'],'/SaveCompanyType','AdminController@SaveCompanyType');

	Route::match(['GET','POST'],'/viewFundingType','AdminController@viewFundingType');
	Route::match(['GET','POST'],'/AddFundingTypeForm','AdminController@AddFundingTypeForm');
	Route::match(['GET','POST'],'/AddFundingType','AdminController@AddFundingType');
	Route::match(['GET','POST'],'/DeleteFundingType','AdminController@DeleteFundingType');
	Route::get('/EditFundingType/{id}','AdminController@EditFundingType');
	Route::match(['GET','POST'],'/SaveFundingType','AdminController@SaveFundingType');

	Route::match(['GET','POST'],'/viewIndustryType','AdminController@viewIndustryType');
	Route::match(['GET','POST'],'/AddIndustryTypeForm','AdminController@AddIndustryTypeForm');
	Route::match(['GET','POST'],'/AddIndustryType','AdminController@AddIndustryType');
	Route::match(['GET','POST'],'/DeleteIndustryType','AdminController@DeleteIndustryType');
	Route::get('/EditIndustryType/{id}','AdminController@EditIndustryType');
	Route::match(['GET','POST'],'/SaveIndustryType','AdminController@SaveIndustryType');

	Route::match(['GET','POST'],'/viewCountry','AdminController@viewCountry');
	Route::match(['GET','POST'],'/AddCountryForm','AdminController@AddCountryForm');
	Route::match(['GET','POST'],'/AddCountry','AdminController@AddCountry');
	Route::match(['GET','POST'],'/DeleteCountry','AdminController@DeleteCountry');
	Route::get('/EditCountry/{id}','AdminController@EditCountry');
	Route::post('/SaveCountry','AdminController@SaveCountry');

	Route::match(['GET','POST'],'/viewInvestorType','AdminController@viewInvestorType');
	Route::match(['GET','POST'],'/AddInvestorTypeForm','AdminController@AddInvestorTypeForm');
	Route::match(['GET','POST'],'/AddInvestorType','AdminController@AddInvestorType');
	Route::match(['GET','POST'],'/DeleteInvestorType','AdminController@DeleteInvestorType');
	Route::get('/EditInvestorType/{id}','AdminController@EditInvestorType');
	Route::post('/SaveInvestorType','AdminController@SaveInvestorType');

	Route::match(['GET','POST'],'/viewInvestmentType','AdminController@viewInvestmentType');
	Route::match(['GET','POST'],'/AddInvestmentTypeForm','AdminController@AddInvestmentTypeForm');
	Route::match(['GET','POST'],'/AddInvestmentType','AdminController@AddInvestmentType');
	Route::match(['GET','POST'],'/DeleteInvestmentType','AdminController@DeleteInvestmentType');
	Route::get('/EditInvestmentType/{id}','AdminController@EditInvestmentType');
	Route::post('/SaveInvestmentType','AdminController@SaveInvestmentType');

	Route::match(['GET','POST'],'/viewCity','AdminController@viewCity');
	Route::match(['GET','POST'],'/AddCityForm','AdminController@AddCityForm');
	Route::match(['GET','POST'],'/AddCity','AdminController@AddCity');
	Route::match(['GET','POST'],'/DeleteCity','AdminController@DeleteCity');
	Route::get('/EditCity/{id}','AdminController@EditCity');
	Route::post('/SaveCity','AdminController@SaveCity');

	Route::match(['GET','POST'],'/viewFundGoalValue','AdminController@viewFundGoalValue');
	Route::get('/EditFundGoal/{id}','AdminController@EditFundGoal');
	Route::post('/SaveFundGoal','AdminController@SaveFundGoal');

	Route::match(['GET','POST'],'/StaticPages','AdminController@StaticPages');
	Route::get('/StaticPageData/{id}','AdminController@StaticPageData');
	Route::get('/AddStaticPageForm','AdminController@AddStaticPageForm');
	Route::match(['GET','POST'],'/AddStaticPageData','AdminController@AddStaticPageData');
	Route::match(['GET','POST'],'/SaveStaticPageData','AdminController@SaveStaticPageData');

	Route::match(['GET','POST'],'/ViewCompanyCampaign','AdminController@ViewCompanyCampaign');
	Route::match(['GET','POST'],'/SuspendCompanyCampaign','AdminController@SuspendCompanyCampaign');
	Route::match(['GET','POST'],'/ActivateCompanyCampaign','AdminController@ActivateCompanyCampaign');
	Route::match(['GET','POST'],'/DeleteCompanyCampaign','AdminController@DeleteCompanyCampaign');
	Route::get('/EditCompanyCampaign/{id}','AdminController@EditCompanyCampaign');
	Route::match(['GET','POST'],'/SaveEditCompanyCampaign','AdminController@SaveEditCompanyCampaign');
	Route::match(['GET','POST'],'/AddCompanyCampaignForm','AdminController@AddCompanyCampaignForm');
	Route::match(['GET','POST'],'/AddCompanyCampaign','AdminController@AddCompanyCampaign');

	Route::match(['GET','POST'],'/ViewInvestorCampaign','AdminController@ViewInvestorCampaign');
	Route::match(['GET','POST'],'/SuspendInvestorCampaign','AdminController@SuspendInvestorCampaign');
	Route::match(['GET','POST'],'/ActivateInvestorCampaign','AdminController@ActivateInvestorCampaign');
	Route::match(['GET','POST'],'/DeleteInvestorCampaign','AdminController@DeleteInvestorCampaign');
	Route::get('/EditInvestorCampaign/{id}','AdminController@EditInvestorCampaign');
	Route::match(['GET','POST'],'/SaveEditInvestorCampaign','AdminController@SaveEditInvestorCampaign');
	Route::match(['GET','POST'],'/AddInvestorCampaignForm','AdminController@AddInvestorCampaignForm');
	Route::match(['GET','POST'],'/AddInvestorCampaign','AdminController@AddInvestorCampaign');
	Route::match(['GET','POST'],'/GetCityList','AdminController@GetCityList');
	Route::get('importExport', 'AdminController@importExport');
	Route::get('downloadExcelUser/{type}', 'AdminController@downloadExcelUser');
	Route::get('downloadExcelUserCompany/{type}', 'AdminController@downloadExcelUserCompany');
	Route::get('downloadExcelUserInvestor/{type}', 'AdminController@downloadExcelUserInvestor');
	Route::match(['GET','POST'],'/importExcelForm', 'AdminController@importExcelForm');
	Route::match(['GET','POST'],'/importExcel', 'AdminController@importExcel');
	Route::match(['GET','POST'],'/userTrail','AdminController@userTrail');
	Route::get('/editSubscriptionForm/{id}','AdminController@editSubscriptionForm');
	Route::match(['GET','POST'],'/submitSubscriptonDate','AdminController@submitSubscriptonDate');
	Route::match(['GET','POST'],'/CreateMessage','AdminController@CreateMessage');
	Route::match(['GET','POST'],'/getUserList','AdminController@getUserList');
	Route::match(['GET','POST'],'/sendMessage','AdminController@sendMessage');


	Route::match(['POST'],'/ChangeFeatured','AdminController@ChangeFeatured');
	Route::match(['POST'],'/changeVisablity','AdminController@changeVisablity');

	Route::match(['GET','POST'],'/config','AdminController@config');
	Route::match(['GET','POST'],'/updateConfig','AdminController@updateConfig');
	
	Route::match(['GET','POST'],'/UserHistory','AdminController@UserHistory');

	Route::match(['GET','POST'],'/userGroupSubscriptions','AdminController@userGroupSubscriptions');
	Route::match(['GET','POST'],'/updateGroupSubscriptions','AdminController@updateGroupSubscriptions');

	Route::match(['GET','POST'],'/changePublicStatus','AdminController@changePublicStatus');
	Route::match(['GET','POST'],'/changeProfStatus','AdminController@changeProfStatus');

	Route::match(['GET','POST'],'/changeMessageMeetingApproval_','AdminController@changeMessageMeetingApproval_');
	
	
});

Route::group(['prefix' => '/User'], function(){
	Route::get('/index', 'UserController@index');
	Route::match(['GET','POST'], '/Login', 'UserController@userLogin');
	Route::get('/contact', 'UserController@Contactus');
	Route::get('/browse-investors', 'UserController@BrowseInvestors');
	Route::match(['GET','POST'],'/signupForm', 'UserController@signupForm');
	Route::match(['GET','POST'],'/userSignup', 'UserController@userSignup');
	Route::match(['GET','POST'],'/confirmSignup', 'UserController@confirmSignup');
	Route::match(['GET','POST'],'/successSignup', 'UserController@successSignup');
	//Route::match(['GET','POST'],'/message', 'UserController@message');
	Route::match(['GET','POST'],'/message', 'UserController@MessageNew');
	Route::match(['GET','POST'],'/useraccount', 'UserController@userAccount');
	Route::get('/logout', 'UserController@logout');
	Route::match(['GET','POST'],'/userAccountInfo','UserController@userAccountInfo');
	Route::get('/userProfileCompany/{id}','UserController@userProfileCompany');
	Route::get('/userProfileInvestor/{id}','UserController@userProfileInvestor');
	Route::match(['GET','POST'],'/forgetPasswordForm', 'UserController@forgetPasswordForm');
	Route::match(['GET','POST'],'/forgetPassword', 'UserController@forgetPassword');
	Route::get('/resetPassword/{email}','UserController@resetPassword');
	Route::match(['GET','POST'],'/resetSuccess','UserController@resetSuccess');
	Route::get('/companyProfile', 'UserController@companyProfileView');
	Route::get('/investorProfile', 'UserController@investorProfileView');
	
	//   static pages 
	Route::get('/aboutus', 'UserController@aboutUs');
	Route::get('/get-funded', 'UserController@get_funded');
	Route::get('/how-it-works', 'UserController@how_it_works');
	Route::get('/browse-companies', 'UserController@browse_companies');
	Route::get('/companies', 'UserController@companies');
	Route::get('/people', 'UserController@people');
	Route::get('/terms-of-use', 'UserController@terms_of_use');
	Route::get('/privacy-policy', 'UserController@privacy_policy');
	Route::get('/testimonial', 'UserController@testimonial');
	Route::get('/news-and-events', 'UserController@news_and_events');
	Route::get('/blog', 'UserController@blog');
	Route::get('/support', 'UserController@support');
	Route::get('/newsletter', 'UserController@newsletter');
	Route::get('/investor-faq', 'UserController@investor_faq');
	Route::get('/knowledge-center', 'UserController@knowledge_center');

	
	//Route::match(['GET','POST'],'/signupas', 'UserController@signupas');
	Route::match(['GET','POST'],'/addcompanyProfile', 'UserController@addcompanyProfile');
	Route::match(['GET','POST'],'/comapnyProfileAdd', 'UserController@comapnyProfileAdd');
	

	Route::match(['GET','POST'],'/addinvestorProfile', 'UserController@addinvestorProfile');
	Route::match(['GET','POST'],'/investorProfileAdd', 'UserController@investorProfileAdd');
	Route::match(['GET','POST'],'/searchCompanyName', 'UserController@searchCompanyName');
	Route::match(['GET','POST'],'/searchInvestors', 'UserController@searchInvestors');
	Route::get('/viewInvestorProfile/{id}','UserController@viewInvestorProfile');
	Route::get('/viewCompanyProfile/{id}','UserController@viewCompanyProfile');
	Route::match(['GET','POST'],'/searchCompanyRelevance','UserController@searchCompanyRelevance');
	Route::match(['GET','POST'],'/searchInvestorRelevance','UserController@searchInvestorRelevance');
	Route::match(['GET','POST'],'/getSearchData','UserController@getSearchData');
	Route::match(['GET','POST'],'/getSearchDatainvestor','UserController@getSearchDatainvestor');
	Route::match(['GET','POST'],'/contact-form','UserController@contactForm');
	Route::get('/viewcompProfile','UserController@viewcompProfile');
	Route::get('/editCompanyProfile/{id}','UserController@editCompanyProfile');
	Route::match(['GET','POST'],'/saveCompanyProfile','UserController@saveCompanyProfile');
	Route::get('/editInvestorProfile/{id}','UserController@editInvestorProfile');
	Route::match(['GET','POST'],'/saveInvestorProfile','UserController@saveInvestorProfile');
	Route::get('/events','UserController@events');
	Route::get('/termsofuse','UserController@termsofuse');
	Route::get('/privacy_policy','UserController@privacy_policy');
	Route::get('/viewcProfile/{id}','UserController@viewcProfile');
	Route::get('/viewiProfile/{id}','UserController@viewiProfile');
	Route::match(['GET','POST'],'/requestMeeting','UserController@requestMeeting');
	Route::match(['GET','POST'],'/requestMessage','UserController@requestMessage');
	Route::match(['GET','POST'],'/reportAbuse','UserController@reportAbuse');
	Route::get('/viewRecieveMsg/{id}','UserController@viewRecieveMsg');
	Route::get('/viewSendMsg/{id}','UserController@viewSendMsg');
	Route::match(['GET','POST'],'/postMsg','UserController@postMsg');
	Route::match(['GET','POST'],'/deleteMsgs','UserController@deleteMsgs');
	Route::match(['GET','POST'],'/getcityList','UserController@getcityList');
	Route::match(['GET','POST'],'/findCityList','UserController@findCityList');
	Route::match(['GET','POST'],'/fundraising','UserController@fundraising');
	Route::match(['GET','POST'],'/MessageLimits','UserController@MessageLimits');
	Route::match(['GET','POST'],'/ChangePasswordForm','UserController@ChangePasswordForm');
	Route::match(['GET','POST'],'/ChangeUserPassword','UserController@ChangeUserPassword');
	Route::match(['GET','POST'],'/comapnyPublishData','UserController@comapnyPublishData');
	Route::match(['GET','POST'],'/investorPublishData','UserController@investorPublishData');
	Route::match(['GET','POST'],'/editUserInfo','UserController@editUserInfo');
	Route::match(['GET','POST'],'/deleteAccount','UserController@deleteAccount');
	Route::get('/userCompanyIntrestedIn/{id}','UserController@userCompanyIntrestedIn');
	Route::get('/userInvestorIntrestedIn/{id}','UserController@userInvestorIntrestedIn');
	Route::match(['GET','POST'],'/findNamelist','UserController@findNamelist');
	Route::match(['GET','POST'],'/sendUserMessage','UserController@sendUserMessage');
	Route::match(['GET','POST'],'/changeToNoInvestment','UserController@changeToNoInvestment');
	Route::match(['GET','POST'],'/changeToNoInvestmentInv','UserController@changeToNoInvestmentInv');
	
	Route::match(['GET','POST'],'/deleteCompany','UserController@deleteCompany');
	Route::match(['GET','POST'],'/verify-email','UserController@verify_email');
	Route::match(['GET','POST'],'/emailnotverified','UserController@emailnotverified');
	Route::match(['GET','POST'],'/resendEmailCVerification','UserController@resendEmailCVerification');
	
});

Route::get('/login/facebook', 'Auth\LoginController@redirectToFacebookProvider');
 
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');

Route::get('/login/linkedin', 'Auth\LoginController@redirectToLinkedinProvider');
 
Route::get('login/linkedin/callback', 'Auth\LoginController@handleProviderLinkedinCallback');