<?php

namespace App\Http\Controllers;

use App;
use App\CityList;
use App\CompanyTypes;
use App\Config;
use App\Contact;
use App\countryList;
use App\FundGoalValue;
use App\Industry;
use App\InterestedIn;
use App\InvestmentType;
use App\InvestorType;
use App\Message;
use App\PageData;
use App\RegionName;
use App\Report;
use App\SectorType;
use App\StaticPage;
use App\TypeCompanies;
use App\TypeFunding;
use App\User;
use App\UserCompany;
use App\UserHistory;
use App\UserInvestor;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Mail;
use Session;
use Socialite;

class UserController extends Controller {
    public function __construct() {
        /*	print_r(Session::get('User'));exit;
        if(Session::has('User')){
        }*/
    }

    // function for check user session
    public function checkUser() {
        if (!Session::has('User')) {
            return 1;
        }

        if (Session::has('User')) {
            $user_id = Session::get('User.id');
            $user = User::where('id', $user_id)->first()->toArray();

            if ('inactive' == $user['email_verification']) {
                //$this->logout();
                //return header('Location: '.url('/User/emailnotverified'));
                \App::abort(302, '', ['Location' => url('/User/emailnotverified')]);
            }
        }
    }

    public function approve_check() {
        $user_id = Session::get('User.id');
        $user = User::where('id', $user_id)->with('companyDetail')->with('investorDetail')->first()->toArray();

        if ('1' == $user['usertype'] && '0' == $user['company_detail']['is_Public']) {
            return false;
        }

        if ('2' == $user['usertype'] && '0' == $user['investor_detail']['is_Public']) {
            return false;
        }

        return true;
    }

    public function validUser() {
        // if(Session::has('days')){
        // 	if(Session::get('days') < 1){
        // 		return 1;
        // 	}
        // }else{
        // 	return 0;
        // }
        if (Session::has('User')) {
            $user_id = Session::get('User.id');
            $user = User::where('id', $user_id)->first()->toArray();

            if ('unlimited' == $user['subscription_plan']) {
                return 0;
            }

            if (!$this->checkMeetingLimit()) {
                return 1;
            }

            if (!$this->checkMsgLimit()) {
                return 1;
            }

            if (!$this->checkProfileLimit()) {
                return 1;
            }
            $active_till = date('Y-m-d', strtotime($user['activation']));
            $today = date('Y-m-d');

            if ($today > $active_till) {
                return 1;
            }
        } else {
            if ('user/index' != strtolower(Route::getFacadeRoot()->current()->uri())) {
                \App::abort(302, '', ['Location' => url('/User/index')]);
            }
        }
    }

    public function checkMsgLimit() {
        $user_id = Session::get('User.id');
        $user = User::where('id', $user_id)->first()->toArray();

        if ('unlimited' == $user['subscription_plan']) {
            return true;
        }

        $query = "SELECT COUNT(*) as num FROM `messages` WHERE sender_id = '".$user_id."'  AND `type` = '2' AND DATE_FORMAT(`created_at`,'%Y-%m-%d') = '".date('Y-m-d')."';";
        $result = DB::select($query);
        $msg_count = $result[0]->num;
        $config = Config::where('variable', 'trial_message')->first()->toArray();
        $msg_limit = $config['value'];

        if ($msg_count >= $msg_limit) {
            return false;
        }

        return true;
    }

    public function checkMeetingLimit($add = 0) {
        $user_id = Session::get('User.id');
        $user = User::where('id', $user_id)->first()->toArray();

        if ('unlimited' == $user['subscription_plan']) {
            return true;
        }
        $query = "SELECT COUNT(*) as num FROM `messages` WHERE sender_id = '".$user_id."' AND `type` = '1' AND DATE_FORMAT(`created_at`,'%Y-%m-%d') = '".date('Y-m-d')."';";
        $result = DB::select($query);
        $meeting_count = $result[0]->num;

        $config = Config::where('variable', 'trial_meeting')->first()->toArray();
        $meeting_limit = $config['value'];

        if ($meeting_count + $add >= $meeting_limit) {
            return false;
        }

        return true;
    }

    public function checkProfileLimit() {
        $user_id = Session::get('User.id');
        $user = User::where('id', $user_id)->first()->toArray();

        if ('unlimited' == $user['subscription_plan']) {
            return true;
        }
        $query = "SELECT COUNT(*) AS num FROM `user_history` WHERE `userid` = '".$user_id."' AND DATE_FORMAT(`created_at`,'%Y-%m-%d') = '".date('Y-m-d')."';";
        $result = DB::select($query);
        $prifile_visit_count = $result[0]->num;

        $config = Config::where('variable', 'profile_limit')->first()->toArray();
        $profile_limit = $config['value'];

        if ($prifile_visit_count >= $profile_limit) {
            return false;
        }

        return true;
    }

    // function for home page
    public function index(Request $request) {
        if (1 == $this->validUser()) {
            return redirect('User/fundraising');
        }

        if ((2 == Session::get('User.usertype')) || empty(Session::get('User.usertype'))) {
            $data = $request->query();
            $companytypes = TypeCompanies::where('status', 1)->orderBy('typeCompanies', 'ASC')->get();
            $fundingtype = TypeFunding::where('status', 1)->orderBy('typeFunding', 'ASC')->get();
            $industry = Industry::where('status', 1)->orderBy('industryName', 'ASC')->get();
            $country = countryList::orderBy('country_name', 'ASC')->get();
            $city = CityList::with('country')->orderBy('city_name', 'ASC')->get();
            $sectors = SectorType::where('status', '1')->get();
            $companyData = UserCompany::/*with('sector')->*/with('countryData')
                ->with('cityData')
                ->with('industry')// ->with('companyType')
                                        //->with('User')/*->with('TypeFunding')*/
                ->where('is_Public', 1)
                ->where('is_featured', 1)
                                        /*->where('closingDate', '>=',date('Y-m-d'))*/;

            /*
            $is_proff = null;

            if (Session::has('User')) {
                $user_id = Session::get('User.id');
                $user = User::where('id',$user_id)->first()->toArray();
                $is_proff = $user['is_Professional'];
            }

            if ($is_proff == '0') {
                $companyData->whereHas('user', function (Builder $query) {
                    $query->where('is_Professional', '0');
                });
            } else {
                if ($is_proff == '1') {
                    $companyData->whereHas('user', function (Builder $query) {
                        $query->where('is_Professional', '1');
                    });
                }
            }
            */

            //$companyData->dd();

            $companyData = $companyData->get();

            return view('frontend/index')
                ->with('companyTypes', $companytypes)
                ->with('fundType', $fundingtype)
                ->with('industry', $industry)
                ->with('companyData', $companyData->toArray())
                ->with('queryString', $request->query())
                ->with('getFullQueryString', $request->getQueryString())
                ->with('countrylist', $country)
                ->with('citylist', $city)
                ->with('sectors', $sectors);
        }

        return redirect('User/browse-investors');
    }

    public function Contactus() {
        $contactusData = PageData::where('page_id', '=', 1)->first();
        $address = Config::where('variable', 'contact_address')->first()->toArray();
        $phone = Config::where('variable', 'contact_number')->first()->toArray();

        return view('frontend/contactus')->with('data', $contactusData)->with('address', $address)->with('phone', $phone);
    }

    public function contactForm() {
        $inputData = Input::all();
        $response = [];

        if (!empty($inputData)) {
            $contactData = new Contact();
            $contactData->fname = @$inputData['fname'];
            $contactData->lname = @$inputData['lname'];
            $contactData->email = @$inputData['email'];
            $contactData->phone = @$inputData['phone'];
            $contactData->address = @$inputData['address'];
            $contactData->text = @$inputData['text'];

            if ($contactData->save()) {
                $response = ['code' => 1, 'msg' => 'success'];
            } else {
                $response = ['code' => 1, 'msg' => 'Message not sent!!'];
            }
        }

        return $response;
    }

    public function BrowseInvestors(Request $request) {
        if ((1 == Session::get('User.usertype')) || empty(Session::get('User.usertype'))) {
            $investorType = InvestorType::where('status', 1)->orderBy('typeInvestor')->get();
            $investmentType = InvestmentType::where('status', 1)->orderBy('typeInvestment')->get();
            $industry = Industry::where('status', 1)->orderBy('industryName')->pluck('industryName', 'id');
            $country = countryList::orderBy('country_name')->pluck('country_name', 'id');
            $sectors = SectorType::where('status', 1)->orderBy('sectorName')->pluck('sectorName', 'id');

            $investorData = UserInvestor::with('regionFocus')
                ->with('investorType')
                ->with('countryData')
                ->with('cityData')
                ->with('User')
                ->where('isPublished', 1)
                ->where('is_public', 1)
                ->where('is_featured', 1);

            $is_proff = null;

            if (Session::has('User')) {
                $user_id = Session::get('User.id');
                $user = User::where('id', $user_id)->first()->toArray();
                $is_proff = $user['is_Professional'];
            }

            if ('0' == $is_proff) {
                $investorData->whereHas('user', function (Builder $query) {
                    $query->where('is_Professional', '0');
                });
            } else {
                if ('1' == $is_proff) {
                    $investorData->whereHas('user', function (Builder $query) {
                        $query->where('is_Professional', '1');
                    });
                }
            }

            $investorData = $investorData->get();

            $city = CityList::with('country')->where('status', 1)->orderBy('city_name')->get();
            
            $regionFocus = RegionName::where('status', 1)->orderBy('regionName')->pluck('regionName', 'id');

            return view('frontend/browse-investors')->with('investortype', $investorType)->with('investmentType', $investmentType)->with('industry', $industry->toArray())->with('investorData', $investorData->toArray())->with('queryString', $request->query())->with('getFullQueryString', $request->getQueryString())->with('countrylist', $country->toArray())->with('citylist', $city)->with('sectorlist', $sectors->toArray())->with('regionlist', $regionFocus->toArray());
        }

        return redirect('User/index');
    }

    public function userLogin() {
        /*if($this->checkUser() == 0){
            return redirect('/User/index');
        }*/

        $inputData = Input::all();
        $response = [];

        if (!empty($inputData)) {
            $rules = ['email' => 'required|email', 'password' => 'required'];
            $validator = Validator::make($inputData, $rules);

            if ($validator->fails()) {
                $errors = $validator->getMessageBag()->toArray();
                $erMsg = '';

                foreach ($errors as $error) {
                    $erMsg .= $error[0].'<br> ';
                }
                $response = ['code' => 2, 'msg' => $erMsg];
            } else {
                $inputData['email'] = strtolower($inputData['email']);
                $ckkLogin = User::where('email', $inputData['email'])
                    ->where('password', md5($inputData['password']))
                    ->where('status', '!=', '3')
                    //->where('email_verification','active')
                    ->first();

                if (empty($ckkLogin)) {
                    $response = ['code' => 2, 'msg' => 'Email-id or password is incorrect'];
                } else {
                    $user_id = $ckkLogin['id'];

                    $user = User::where('id', $user_id)->first()->toArray();

                    if ('inactive' == $user['email_verification']) {
                        return $response = ['msg' => 'email_not_verified', 'email' => $inputData['email']];
                    }

                    $userId = $ckkLogin['id'];
                    $data = $ckkLogin->toArray();
                    $date = $data['activation'];
                    $curr_date = date('Y-m-d');
                    $date1 = strtotime($curr_date);
                    $date2 = strtotime($date);
                    $days = $date2 - $date1;
                    $count_days = $days / (60 * 60 * 24);
                    Session::put('days', $count_days);
                    Session::put('User', $ckkLogin->toArray());
                    $user = User::find($userId);
                    $user->last_login = date('Y-m-d');
                    $user->userip = \Request::ip();
                    $user->save();

                    $isEmailVerified = '0';

                    if (Session::has('email_verified')) {
                        $isEmailVerified = '1';
                    }
                    $response = ['code' => 1,
                        'msg' => 'success',
                        'data' => $ckkLogin,
                        'days' => $count_days,
                        'isEmailVerified' => $isEmailVerified,
                    ];
                }
            }
        }

        return $response;
    }

    public function signupForm() {
        return view('frontend/signup');
    }

    public function userSignup() {
        $inputData = Input::all();
        $response = [];

        if (!empty($inputData)) {
            $rules = [
                'userType' => 'required',
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ];

            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                $response = ['code' => 2, 'msg' => 'Email Already Registered!!'];
            } else {
                $userInput = new User();
                $userInput->firstname = $inputData['fname'];
                $userInput->lastname = $inputData['lname'];
                $userInput->email = $inputData['email'];
                $userInput->password = md5($inputData['password']);
                $userInput->usertype = $inputData['userType'];
                $userInput->status = 1;

                $config = Config::where('variable', 'trial_days')->first()->toArray();
                $freeTrialDays = $config['value'];

                $userInput->activation = date('Y-m-d', strtotime('+'.$freeTrialDays.' days'));

                if ($userInput->save()) {
                    $insertedId = $userInput->id;

                    if ('1' == $inputData['userType']) {
                        ///// save data in company table
                        $companyData = new UserCompany();
                        $companyData->userid = $insertedId;
                        $companyData->fname = $inputData['fname'];
                        $companyData->lname = $inputData['lname'];
                        $companyData->email = $inputData['email'];
                        $companyData->save();
                    } else {
                        if ('2' == $inputData['userType']) {
                            $investorData = new UserInvestor();
                            $investorData->userid = $insertedId;
                            $investorData->firstname = $inputData['fname'];
                            $investorData->lastname = $inputData['lname'];
                            $investorData->email = $inputData['email'];
                            $investorData->save();
                        }
                    }

                    // echo $insertedId; exit;
                    Session::put('User.id', $insertedId);
                    Session::put('User.firstname', $inputData['fname']);
                    Session::put('User.lastname', $inputData['lname']);
                    Session::put('User.email', $inputData['email']);
                    Session::put('User.usertype', $inputData['userType']);
                    // Email Sending Code
                    $data = [
                        'name' => $inputData['fname'].' '.$inputData['lname'],
                        'email' => $inputData['email'],
                    ];

                    try {
                        $mailckk = Mail::send(
                            'frontend/email/invite',
                            ['userData' => $data, 'email_verification_link' => url('/User/verify-email?id=').$insertedId],
                            function ($message) use ($inputData) {
                                $message->to($inputData['email'], $inputData['fname'].' '.$inputData['lname'])->subject('LondCap - Email Verification');
                            }
                        );
                    } catch (\Exception $e) {
                    }

                    if (count(Mail::failures()) > 0) {
                        foreach (Mail::failures as $email_address) {
                            $response = ['code' => 1, 'msg' => 'Mail Not Sent'];
                        }
                    } else {
                        $response = ['code' => 1, 'msg' => 'Success'];
                    }
                    //$response = array('code'=>1,'msg'=>'Success');
                } else {
                    $response = ['code' => 2, 'msg' => 'User Registration Failed!!'];
                    //return view('frontend.signup')->with('response',$response);
                }
            }
        }

        return $response;
    }

    public function confirmSignup() {
        $countries = countryList::orderBy('country_name', 'ASC')->get();

        return view('frontend/confirmSignup')->with('countries', $countries);
    }

    public function successSignup() {
        $inputData = Input::all();

        $country = $inputData['country'];
        $city = $inputData['city'];
        $is_professional = $inputData['is_professional'];

        $country_id = null;
        $city_id = null;

        $countryData = countryList::where('country_name', trim($country))->first();

        if ($countryData) {
            $country_id = $countryData['id'];
        }

        $cityData = CityList::where('country_id', trim($country_id))->where('city_name', trim($city))->first();

        if ($cityData) {
            $city_id = $cityData['id'];
        }

        if (!empty($inputData)) {
            $id = Session::get('User.id');
            $userData = User::find($id);
            $userData->country = $country;
            $userData->city = $city;
            $userData->is_Professional = $is_professional;

            if ($userData->save()) {
                $usertype = Session::get('User.usertype');
                $userid = Session::get('User.id');

                if ('1' == $usertype) {
                    UserCompany::where('userid', $userid)
                        ->update(['country' => $country_id, 'city' => $city_id]);
                } else {
                    if ('2' == $usertype) {
                        UserInvestor::where('userid', $userid)
                            ->update(['country' => $country_id, 'city' => $city_id]);
                    }
                }

                $response = ['code' => 1, 'msg' => 'Success', 'utype' => $usertype];
            } else {
                $response = ['code' => 2, 'msg' => 'Failed'];
            }
        }

        return $response;
    }

    public function emailnotverified(Request $request) {
        if ($request->input('id')) {
            $user_id = $request->input('id');

            $user = User::find($user_id);

            if ($user) {
                return view('frontend/emailnotverified', ['user_email' => $user->email]);
            }
        }

        return view('frontend/emailnotverified');
    }

    public function resendEmailCVerification() {
        $inputData = Input::all();
        $response = [];
        $email = $inputData['email'];
        $resp = User::where('email', $email)->first();
        $user = $resp->toArray();

        $firstname = $user['firstname'];
        $lastname = $user['lastname'];
        $email = $user['email'];
        $id = $user['id'];

        $data = [
            'name' => $firstname.' '.$lastname,
            'email' => $email,
        ];

        try {
            $mailckk = Mail::send('frontend/email/invite', ['userData' => $data, 'email_verification_link' => url('/User/verify-email?id=').$id], function ($message) use ($data) {
                $message->to($data['email'], $data['name'])->subject('LondCap - Email Verification');
                //	$message->from('optimus@nextolive.com','Optimus');
            });
        } catch (\Exception $e) {
        }

        if (count(Mail::failures()) > 0) {
            foreach (Mail::failures as $email_address) {
                $response = ['success' => 'error', 'msg' => 'Mail Not Sent'];
            }
        } else {
            $response = ['success' => 'success', 'msg' => 'Verification email has been sent successfully. Please check your inbox/spam box.'];
        }

        return $response;
    }

    public function verify_email(Request $request) {
        $id = $request['id'];

        if (!empty($id)) {
            $resp = User::where('id', $id)->update(['email_verification' => 2]);

            if ($resp) {
                Session::put('email_verified', '1');

                return view('frontend/emailVerified');
            }
        }
    }

    public function userAccount() {
        return view('frontend.user-account-my-info');
    }

    // function to view recieved msgs
    public function message() {
        if (1 == $this->checkUser()) {
            return redirect('User/index');
        }

        if (1 == $this->validUser()) {
            header('Location : '.url('User/fundraising'));
        }

        $inputData = Input::all();
        $response = [];
        $userid = Session::get('User.id');
        $inboxmsg = Message::with('inboxImgComp')->with('inboxImgInv')->with('inboxuser')->where('reciever_id', $userid)->groupBy('sender_id')->orderBy('created_at', 'DESC')->get();

        $outboxmsg = Message::with('outboxImgComp')->with('outboxImgInv')->with('outboxuser')->where('sender_id', $userid)->groupBy('reciever_id')->get();
        Message::where('reciever_id', $userid)->update(['notify' => 0]);

        return view('frontend/inbox')->with('inbox', $inboxmsg->toArray())->with('outbox', $outboxmsg->toArray());
    }

    public function viewRecieveMsg($id) {
        if (1 == $this->checkUser()) {
            return redirect('User/index');
        }
        $id = $id;
        $userid = Session::get('User.id');
        $senderData = Message::where('id', $id)->first();
        $sender_id = $senderData['sender_id'];
        $msgData = Message::with('inboxuser')->with('outboxImgComp')->with('inboxImgInv')->where('sender_id', $id)->where('reciever_id', $userid)->orderBy('created_at', 'desc')->get();
        /*echo "<pre>";
        print_r($msgData->toArray());exit;*/
        return view('frontend/userchatinbox')->with('data', $msgData->toArray());
    }

    public function viewSendMsg($id) {
        if (1 == $this->checkUser()) {
            return redirect('User/index');
        }
        $sender_id = $id;
        $userid = Session::get('User.id');
        //$sendarData = Message::where('id',$id)->first();
        $recieved_id = $id; //$sendarData['reciever_id'];

        $msgData = Message::with('outboxImgComp')->with('outboxImgInv')->with('outboxuser')->where('sender_id', $userid)->where('reciever_id', $sender_id)->orderBy('created_at', 'desc')->get();
        // echo "<pre>"; print_r($msgData->toArray());exit;
        return view('frontend/userchatoutbox')->with('data', $msgData);
    }

    // function to send msg to user from inbox view
    /*public function postMsg()
    {
        if($this->checkUser()==1){
            return redirect('User/index');
        }
        $inputData= Input::all();
        $response = array();
        if(!empty($inputData)){
            $userid = Session::get('User.id');
            $messageData = new Message();
            $messageData->sender_id = $userid;
            $messageData->message = $inputData['data'];
            $messageData->reciever_id = $inputData['userid'];
            $messageData->status = 1;
            $messageData->type = 2;
            $messageData->notify = 1;
            if($messageData->save())
            {
                $response = array("code"=>1,"msg"=>"Success");
            }else{
                $response = array("code"=>2,"msg"=>"Failed");
            }
        }
        return $response;
    }*/

    public function logout() {
        Session::flush();

        return redirect('User/index');
    }

    public function forgetPasswordForm() {
        return view('frontend/forgetPassword');
    }

    public function forgetPassword() {
        $inputData = Input::all();
        $response = [];

        if (!empty($inputData)) {
            $email = strtolower($inputData['email']);
            $userData = User::where('email', $email)->first();

            if (!empty($userData)) {
                $data = [
                    'name' => $userData['firstname'].' '.$userData['lastname'],
                    'email' => $userData['email'],
                ];

                try {
                    $mailckk = Mail::send('frontend/email/forget-password', ['userData' => $data], function ($message) use ($userData) {
                        $message->to($userData['email'], $userData['firstname'])
                            ->subject('LondCap -  Reset Password');
                    });
                } catch (\Exception $e) {
                }

                if (count(Mail::failures()) > 0) {
                    foreach (Mail::failures as $email_address) {
                        $response = ['code' => 1, 'msg' => 'We were unable to send your password reset link to the email address you entered.'];
                    }
                } else {
                    $response = ['code' => 1, 'msg' => 'success'];
                }
            } else {
                $response = ['code' => 2, 'msg' => 'The email address that you have entered in incorrect.'];
            }
        }

        return $response;
    }

    public function resetPassword($email) {
        $email = $email;
        $userData = User::where('email', $email)->first();

        if (!empty($userData)) {
            return view('frontend/resetPasswordForm')->with('data', $userData);
        }
    }

    public function resetSuccess() {
        $inputData = Input::all();
        $response = [];

        if (!empty($inputData)) {
            $password = md5($inputData['password']);
            $email = $inputData['email'];
            $userData = User::where('email', $email)->update(['password' => $password]);
            $response = ['code' => 1, 'msg' => 'success'];
        } else {
            $response = ['code' => 2, 'msg' => 'error'];
        }

        return $response;
    }

    // function to add comapny profile
    public function addcompanyProfile() {
        /*if($this->checkUser() == 0){
        	return redirect('/User/index');
        }*/
        $this->checkUser();
        $userId = Session::get('User.id');

        $inputData = Input::all();
        $companytypes = TypeCompanies::where('status', 1)->orderBy('typeCompanies')->get();
        // print_r($companytypes); exit;
        $fundingtype = TypeFunding::where('status', 1)->orderBy('typeFunding')->get();
        // print_r($fundingtype); exit;
        $industry = Industry::where('status', 1)->orderBy('industryName')->get();

        $sectors = SectorType::where('status', 1)->orderBy('sectorName')->get();
        $country = CountryList::orderBy('country_name')->get();
        $city = CityList::orderBy('city_name')->get();
        $UserDetails = User::find($userId);

        return view('frontend/company-profile-add')->with('cp_type', $companytypes)->with('fundType', $fundingtype)->with('industry', $industry)->with('sector', $sectors)->with('country', $country)->with('city', $city)->with('UserDetails', $UserDetails->toArray());
    }

    public function comapnyProfileAdd(Request $request) {
        //$userId = Session::get('User.id');

        $userid = Session::get('User.id');
        $companyUser = UserCompany::where('userid', $userid)->first();

        if (empty($companyUser)) {
            $user_companies = new UserCompany();
            $user_companies->userid = @$userid;

            if ($request->hasFile('photo')) {
                $image = base64_decode($request->get('FilePayload'));
                $folderName = '/uploads/images/';
                $safeName = str_random(10).'.'.'png';
                $destinationPath = public_path().$folderName;
                $success = file_put_contents($destinationPath.$safeName, $image);
                $arr_data['image_name'] = $safeName;
                $user_companies->image_name = $safeName;
            }

            if ($request->hasFile('banner')) {
                $image = $request->file('banner');
                $name = time().'_'.$userid.'.'.$image->getClientOriginalName();
                $destinationPath = public_path('/uploads/images');
                $imagePath = $destinationPath.'/'.$name;
                $image->move($destinationPath, $name);
                $user_companies->banner_name = $name;
            }
            $user_companies->fname = $request->get('fname');
            $user_companies->lname = $request->get('lname');
            $user_companies->email = $request->get('email');
            $user_companies->status = 1;
            $user_companies->jobTitle = $request->get('job_title');
            $user_companies->phoneno = $request->get('phoneno');
            $user_companies->country = $request->get('country');
            $user_companies->city = @$request->get('city');
            $user_companies->companyUrl = @$request->get('cp_url');
            $user_companies->fundraisUrl = @$request->get('fr_url');
            $user_companies->linkedinUrl = @$request->get('ld_url');
            $user_companies->fbUrl = @$request->get('fb_url');
            $user_companies->twitterUrl = @$request->get('tw_url');
            $user_companies->slideshareUrl = @$request->get('sd_url');
            $user_companies->investorFirmvideo = @$request->get('fv_url');
            $user_companies->companyTagline = @$request->get('c_tagline');
            $user_companies->profileText = @$request->get('cp_text');
            $user_companies->companyName = @$request->get('cp_name');

            if ($request->get('cp_type')) {
                $user_companies->companyType = @implode(',', $request->get('cp_type'));
                $user_companies->fundingType = @implode(',', $request->get('fd_type'));
                $user_companies->industry = @implode(',', $request->get('industry'));
                $user_companies->sector = @implode(',', $request->get('sector'));
            }
            // $user_companies->companyType = @$request->get('cp_type');
            // $user_companies->fundingType = @$request->get('fd_type');
            // $user_companies->industry = @$request->get('industry');
            // $user_companies->sector = @$request->get('sector');

            $user_companies->ammountRaised = @$request->get('amt_raised');
            $user_companies->fundingGoal = @$request->get('fd_goal');
            $user_companies->minReservation = @$request->get('min_reserve');
            $user_companies->maxReservation = @$request->get('max_reserve');
            $user_companies->equity = @$request->get('equity');
            $user_companies->openDate = @$request->get('open_date');
            $user_companies->closingDate = date('Y-m-d', strtotime('+100 years'));
            $user_companies->personalBio = @$request->get('personalBio');
            $user_companies->is_Public = 0;
            $user_companies->isPublished = 1;
            $v = true;
            $masterFundingGoal = FundGoalValue::first();

            if (($masterFundingGoal['minValue'] > str_replace(',', '', @$request->get('fd_goal')) || $masterFundingGoal['maxValue'] < str_replace(',', '', @$request->get('fd_goal'))) && !empty(@$request->get('fd_goal'))) {
                $v = false;

                if ($masterFundingGoal['minValue'] > str_replace(',', '', @$request->get('fd_goal'))) {
                    $msg = 'Fund Goal is  lower than Minimum Fund Goal limit i.e.'.$masterFundingGoal['minValue'];
                }

                if ($masterFundingGoal['maxValue'] < str_replace(',', '', @$request->get('fd_goal'))) {
                    $msg = 'Fund Goal is  higher than Maximum Fund Goal limit i.e.'.$masterFundingGoal['maxValue'];
                }
            } else {
                if (str_replace(',', '', @$request->get('amt_raised')) > str_replace(',', '', @$request->get('fd_goal'))) {
                    $v = false;
                    $msg = 'Amount raised can’t be larger then funding goal';
                }
            }

            if ($v) {
                if ($user_companies->save()) {
                    $response = ['code' => 1, 'msg' => 'success'];
                } else {
                    $response = ['code' => 2, 'msg' => 'failed'];
                }
            } else {
                $response = ['code' => 2, 'msg' => @$msg];
            }
        } else {
            $response = ['code' => 2, 'msg' => 'You have Alredy Registered'];
        }

        return json_encode($response);
    }

    public function addinvestorProfile() {
        $userId = Session::get('User.id');
        $inputData = Input::all();
        $investorType = InvestorType::where('status', 1)->orderBy('typeInvestor')->get();
        // print_r($companytypes); exit;
        $investmentType = InvestmentType::where('status', 1)->orderBy('typeInvestment')->get();
        // print_r($fundingtype); exit;
        $sectortype = SectorType::where('status', 1)->orderBy('sectorName')->get();
        $country = CountryList::orderBy('country_name')->get();
        $city = CityList::orderBy('city_name')->get();
        $industry = Industry::where('status', 1)->orderBy('industryName')->get();
        $regionFocus = RegionName::where('status', 1)->orderBy('regionName')->get();
        $UserDetails = User::find($userId);

        return view('frontend/investors-profile-add')->with('investortype', $investorType)->with('investmenttype', $investmentType)->with('sector', $sectortype)->with('country', $country)->with('city', $city)->with('industry', $industry)->with('region', $regionFocus)->with('UserDetails', $UserDetails->toArray());
    }

    public function investorProfileAdd(Request $request) {
        // print_r($request->all()); exit;
        $response = [];
        $userid = Session::get('User.id');
        $user_investors = new UserInvestor();

        if ($request->hasFile('photo')) {
            /*$image = $request->file('photo');
            $name=time().'_'.$userid.'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/images');
            $imagePath = $destinationPath. "/". $name;
            $image->move($destinationPath, $name);
            $user_investors->image_name = $name;*/
            $image = base64_decode($request->get('FilePayload'));
            $folderName = '/uploads/images/';
            $safeName = str_random(10).'.'.'png';
            $destinationPath = public_path().$folderName;
            $success = file_put_contents($destinationPath.$safeName, $image);

            $user_investors->image_name = $safeName;
        }

        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name = time().'_'.$userid.'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/images');
            $imagePath = $destinationPath.'/'.$name;
            $image->move($destinationPath, $name);
            $user_investors->banner_name = $name;
        }

        $user_investors->userid = $userid;
        $user_investors->status = 1;
        $user_investors->firstname = $request->get('firstname');
        $user_investors->lastname = $request->get('lastname');
        $user_investors->email = $request->get('email');
        $user_investors->phoneno = $request->get('phoneno');
        $user_investors->firmTagline = $request->get('firmTagline');
        $user_investors->firmName = $request->get('firmName');
        $user_investors->profileText = $request->get('profileText');
        $user_investors->jobTitle = $request->get('jobTitle');
        $user_investors->country = $request->get('country');
        $user_investors->city = $request->get('city');
        $user_investors->investorfirmUrl = $request->get('investorfirmUrl');
        $user_investors->linkedinUrl = $request->get('linkedinUrl');
        $user_investors->fbUrl = $request->get('fbUrl');
        $user_investors->twitterUrl = $request->get('twitterUrl');
        $user_investors->slideshareUrl = $request->get('slideshareUrl');
        $user_investors->investorFirmvideo = $request->get('investorFirmvideo');
        $user_investors->investorType = $request->get('investorType');
        $user_investors->investmentType = $request->get('investmentType');
        $sFocus = implode(',', $request->get('sectorFocus'));
        $user_investors->sectorFocus = $sFocus;
        $iFocus = implode(',', $request->get('industryFocus'));
        $user_investors->industryFocus = $iFocus;
        $rFocus = implode(',', $request->get('regionFocus'));
        $user_investors->regionFocus = $rFocus;
        $cFocus = implode(',', $request->get('countryFocus'));
        $user_investors->countryFocus = $cFocus;
        $user_investors->assetUndermgmt = $request->get('assetUndermgmt');
        $user_investors->investmentRangefrm = $request->get('investmentRangefrm');
        $user_investors->investmentRangeto = $request->get('investmentRangeto');
        $user_investors->is_Public = 0;
        $user_investors->isPublished = 1;
        $v = true;

        if (str_replace(',', '', $request->get('investmentRangefrm')) > str_replace(',', '', $request->get('investmentRangeto')) || str_replace(',', '', $request->get('investmentRangefrm')) > str_replace(',', '', $request->get('assetUndermgmt')) || str_replace(',', '', $request->get('investmentRangeto')) > str_replace(',', '', $request->get('assetUndermgmt'))) {
            $v = false;
        }

        if ($v) {
            if ($user_investors->save()) {
                $response = ['code' => 1, 'msg' => 'success'];
            } else {
                $response = ['code' => 2, 'msg' => 'failed'];
            }
        } else {
            $response = ['code' => 2, 'msg' => 'Please ensure that Investment Range From is lower than Investment Range To and that Investment Range To is lower than Assets Under Management'];
        }

        return json_encode($response);
    }

    public function aboutUs() {
        $page_data = StaticPage::where('url', 'aboutus')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function get_funded() {
        $page_data = StaticPage::where('url', 'get-funded')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function how_it_works() {
        $page_data = StaticPage::where('url', 'how-it-works')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function terms_of_use() {
        $page_data = StaticPage::where('url', 'terms-of-use')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function people() {
        $page_data = StaticPage::where('url', 'people')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function testimonial() {
        $page_data = StaticPage::where('url', 'testimonial')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function news_and_events() {
        $page_data = StaticPage::where('url', 'news-and-events')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function blog() {
        $page_data = StaticPage::where('url', 'blog')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function support() {
        $page_data = StaticPage::where('url', 'support')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function newsletter() {
        $page_data = StaticPage::where('url', 'newsletter')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function investor_faq() {
        $page_data = StaticPage::where('url', 'investor-faq')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function knowledge_center() {
        $page_data = StaticPage::where('url', 'knowledge-center')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function investorProfileView() {
        $investorType = InvestorType::where('status', 1)->orderBy('typeInvestor')->get();
        $investmentType = InvestmentType::where('status', 1)->orderBy('typeInvestment')->get();
        $industry = Industry::where('status', 1)->orderBy('industryName')->get();
        $investorData = UserInvestor::where('status', 1)->get();

        return view('frontend/browse-investors')->with('investortype', $investorType)->with('investmentType', $investmentType)->with('industry', $industry)->with('investorData', $investorData->toArray());
    }

    public function companyProfileView() {
        $companytypes = TypeCompanies::where('status', 1)->orderBy('typeCompanies')->pluck('typeCompanies', 'id');
        $fundingtype = TypeFunding::where('status', 1)->orderBy('typeFunding')->pluck('typeFunding', 'id');
        $industry = Industry::where('status', 1)->orderBy('industryName')->pluck('industryName', 'id');
        $companyData = UserCompany::where('status', 1)->where('is_Public', 1)->get();

        return view('frontend/index')->with('companyTypes', $companytypes)->with('fundType', $fundingtype)->with('industry', $industry)->with('companyData', $companyData->toArray());
    }

    public function searchCompanyName() {
        $inputData = Input::all();

        $response = [];
        $resData = [];

        if (!empty($inputData)) {
            $companyName = $inputData['data'];

            if (!empty($companyName)) {
                $companyData = UserCompany::
                    // with('sector')->
                with('countryData')->with('cityData')->with('industry')// ->with('companyType')
                    ->with('User')/*->with('typeFunding')*/->where('companyName', 'like', '%'.$companyName.'%')
                    ->where('isPublished', 1)->where('is_Public', 1)->get();
            } else {
                $companyData = UserCompany::// with('sector')->
                    with('countryData')->with('cityData')->with('industry')// ->with('companyType')
                        ->with('User') /*->with('TypeFunding')*/->where('isPublished', 1)
                        ->where('is_Public', 1)->get();
            }

            foreach ($companyData->toArray() as $c_data) {
                $c_typ = [];
                $f_typ = [];
                $s_typ = [];

                $companyTypesnos = explode(',', $c_data['companyType']);

                foreach ($companyTypesnos as $nos) {
                    if (!empty($nos)) {
                        $cTypes = TypeCompanies::where('id', $nos)->first();
                        $cType = $cTypes->toArray();
                        $cType = $cType['typeCompanies'];
                        $c_typ[] = $cType;
                    }
                }

                $fundingTypesnos = explode(',', $c_data['fundingType']);

                foreach ($fundingTypesnos as $fnos) {
                    if (!empty($fnos)) {
                        $fTypes = TypeFunding::where('id', $fnos)->first();
                        $fType = $fTypes->toArray();
                        $fType = $fType['typeFunding'];
                        $f_typ[] = $fType;
                    }
                }

                $sectorTypesnos = explode(',', $c_data['sector']);

                foreach ($sectorTypesnos as $snos) {
                    if (!empty($snos)) {
                        $sTypes = SectorType::where('id', $snos)->first();
                        $sType = $sTypes->toArray();
                        $sType = $sType['sectorName'];
                        $s_typ[] = $sType;
                    }
                }
                $c_data['comp_type'] = $c_typ;
                $c_data['fund_type'] = $f_typ;
                $c_data['sec_type'] = $s_typ;
                $resData[] = $c_data;
                unset($c_typ, $f_typ, $s_typ);
            }

            //$resData = $companyData->toArray();
            /*echo "<pre>";
            print_r($resData); exit;*/

            if (!empty($resData)) {
                $response = ['code' => 1, 'msg' => 'success', 'data' => $resData];
            } else {
                $response = ['code' => 2, 'msg' => 'failed', 'data' => 'Data Not Found!!'];
            }
        }

        return $response;
    }

    public function searchInvestors() {
        $inputData = Input::all();
        $response = [];
        $resData = [];

        if (!empty($inputData)) {
            $firmName = $inputData['data'];
            $firmData = UserInvestor::with('regionFocus')->with('investorType')->with('countryData')->with('cityData')->with('User')->where('firstName', 'like', '%'.$firmName.'%')->where('isPublished', 1)->where('is_public', 1)->get();
            $resData = $firmData->toArray();

            if (!empty($resData)) {
                $response = ['code' => 1, 'msg' => 'success', 'data' => $resData];
            } else {
                $response = ['code' => 2, 'msg' => 'failed', 'data' => 'Data Not Found!!'];
            }
        }

        return $response;
    }

    //function to view profile by another user who have reistered as company
    public function viewInvestorProfile($id) {
        $can_see_contacts = 'not';

        if (Session::has('User')) {
            if (!$this->checkProfileLimit()) {
                return redirect('User/fundraising');
            }
            $user_id = Session::get('User.id');
            $user = User::where('id', $user_id)->first();
            $can_see_contacts = $user->toArray()['see_contacts'];
            $this->saveUserHistory('profile', $id);
        }

        $id = $id;
        $invetorData = UserInvestor::with('countryData')->with('cityData')->with('User')->with('investorType')->with('investmentType')->with('sectorType')->with('industry')->where('id', $id)->where('status', 1)->first();
        $r = $invetorData->toArray();

        if (!empty($r)) {
            $regionFocus = RegionName::where('status', 1)->whereIn('id', explode(',', $r['regionFocus']))->orderBy('regionName')->get();
            $investorType = InvestorType::where('status', 1)->whereIn('id', explode(',', $r['investorType']))->orderBy('typeInvestor')->get();
            $investmentType = InvestmentType::where('status', 1)->whereIn('id', explode(',', $r['investmentType']))->orderBy('typeInvestment')->get();
            $sectorFocus = SectorType::where('status', 1)->whereIn('id', explode(',', $r['sectorFocus']))->orderBy('sectorName')->get();
            $industryList = Industry::where('status', 1)->whereIn('id', explode(',', $r['industryFocus']))->orderBy('industryName')->get();
            $countryFocus = CountryList::orderBy('country_name')->whereIn('id', explode(',', $r['countryFocus']))->get();

            return view('frontend/investors-profile-view')->with('data', $r)->with('regionFocus', $regionFocus)->with('investorType', $investorType)->with('investmentType', $investmentType)->with('sectorFocus', $sectorFocus)->with('industryList', $industryList->toArray())->with('countryFocus', $countryFocus->toArray())->with('see_contacts', $can_see_contacts);
        }

        return redirect('User/addinvestorProfile');
    }

    public function viewiProfile($id) {
        if (1 == $this->checkUser()) {
            return redirect('User/index');
        }

        if (1 == $this->validUser()) {
            return redirect('User/fundraising');
        }
        $id = $id;
        $userid = Session::get('User.id');

        if ($id == $userid) {
            $invetorData = UserInvestor::with('regionFocus')->with('countryData')->with('cityData')->with('User')->with('investorType')->with('investmentType')->with('sectorType')->with('industry')->where('userid', $id)->where('status', 1)->first();

            if (!empty($invetorData)) {
                return view('frontend/myInvestorProfile')->with('data', $invetorData->toArray());
            }

            return redirect('User/addinvestorProfile');
        }

        return back();
    }

    // 	function to view profile by user himself as a company
    public function viewcProfile($id) {
        if (1 == $this->checkUser()) {
            return redirect('User/index');
        }

        if (1 == $this->validUser()) {
            return redirect('User/fundraising');
        }
        $id = $id;
        $userid = Session::get('User.id');

        if ($id == $userid) {
            $companyData = UserCompany::with('countryData')->with('cityData')->with('companyType')->with('User')->with('companyType')->with('TypeFunding')->with('industry')->with('sector')->where('userid', $id)->where('status', 1)->where('is_Public', 1)->first();
            // echo "<pre>"; print_r($companyData->toArray());exit;
            if (!empty($companyData)) {
                return view('frontend/myCompanyProfile')->with('data', @$companyData->toArray());
            }

            return redirect('User/addcompanyProfile');
        }

        return back();
    }

    //function to company profile by investors user
    public function viewCompanyProfile($id) {
        $can_see_contacts = 'not';

        if (Session::has('User')) {
            if (!$this->checkProfileLimit()) {
                return redirect('User/fundraising');
            }

            $user_id = Session::get('User.id');
            $user = User::where('id', $user_id)->first();
            $can_see_contacts = $user->toArray()['see_contacts'];
            $this->saveUserHistory('profile', $id);
        }
        $id = $id;

        $companyData = UserCompany::with('countryData')->with('cityData')->with('User')->where('userid', $id)->where('status', 1)->where('is_Public', 1)->first();

        $stype = SectorType::get();
        $city = CityList::orderBy('city_name', 'ASC')->get();
        $industry = Industry::orderBy('industryName', 'ASC')->get();
        $country = countryList::orderBy('country_name', 'ASC')->get();
        $regionFocus = RegionName::orderBy('regionName', 'ASC')->get();
        $cType = TypeCompanies::where('status', 1)->get();
        $tFunding = TypeFunding::where('status', 1)->get();

        if (!empty($companyData)) {
            return view('frontend/company-profile-view')
                ->with('data', @$companyData->toArray())
                ->with('sector', @$stype)
                ->with('stype', @$stype)
                ->with('industry', @$industry)
                ->with('country', @$country)
                ->with('city', $city)
                ->with('region', $regionFocus)
                ->with('ctype', $cType)
                ->with('tfunding', $tFunding)
                ->with('see_contacts', $can_see_contacts);
        }

        return redirect('User/addcompanyProfile');
    }

    // function to get data to edit company profile
    public function editCompanyProfile($id) {
        if (1 == $this->checkUser()) {
            return redirect('User/index');
        }

        if (1 == $this->validUser()) {
            return redirect('User/fundraising');
        }
        $id = $id;
        $userid = Session::get('User.id');

        if ($id == $userid) {
            $companyType = TypeCompanies::get();
            $tfunding = TypeFunding::get();
            $stype = SectorType::get();
            $industry = Industry::get();
            $country = countryList::orderBy('country_name', 'ASC')->get();

            $companyData = UserCompany::with('countryData')->with('cityData')->with('User')->with('companyType')->with('TypeFunding')/*->with('industry')->with('sector')*/->where('userid', $id)->first();
            $city = CityList::where('country_id', '=', $companyData->country)->orderBy('city_name', 'ASC')->get();

            $list = InterestedIn::where('follower_id', $userid)->pluck('following_id');

            $investorData = [];
            $investorData2 = [];

            if (count($list) > 0) {
                $investorData = UserInvestor::with('regionFocus')->with('investorType')->with('countryData')->with('cityData')->with('User')->whereIn('userid', $list)->get();
            }
            $list2 = InterestedIn::where('following_id', $userid)->pluck('follower_id');

            if (count($list2) > 0) {
                $investorData2 = UserInvestor::with('regionFocus')->with('investorType')->with('countryData')->with('cityData')->with('User')->whereIn('userid', $list2)->get();
            }

            if (!empty($companyData)) {
                return view('frontend/company-profile-edit')
                    ->with('data', @$companyData->toArray())
                    ->with('ctype', @$companyType->toArray())
                    ->with('tfunding', @$tfunding)
                    ->with('stype', @$stype)
                    ->with('industry', @$industry)
                    ->with('country', $country)
                    ->with('city', $city)
                    ->with('expressedInterest', @$investorData)
                    ->with('expressedInterest2', @$investorData2);
            }

            return redirect('User/addcompanyProfile');
        }

        return back();
    }

    // function to save updated company Data
    public function saveCompanyProfile(Request $request) {
        $v = true;
        $userid = Session::get('User.id');
        $arr_data = [];
        // $user_companies->userid = @$userid;
        if ($request->has('FilePayload')) {
            /*$image = $request->file('photo');
            $name=time().'_'.$userid.'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/images');
            $imagePath = $destinationPath. "/". $name;
            $image->move($destinationPath, $name);
            //$user_companies->image_name = $name;
                    $arr_data['image_name']=$name;*/
            $image = base64_decode($request->get('FilePayload'));
            $folderName = '/uploads/images/';
            $safeName = str_random(10).'.'.'png';
            $destinationPath = public_path().$folderName;
            $success = file_put_contents($destinationPath.$safeName, $image);
            $arr_data['image_name'] = $safeName;
        }
        //print_r($arr_data['image_name']);

        //die();
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name = time().'_'.$userid.'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/images');
            $imagePath = $destinationPath.'/'.$name;
            $image->move($destinationPath, $name);
            // $user_companies->banner_name = $name;
            $arr_data['banner_name'] = $name;
        }

        if ($request->has('fname')) {
            $arr_data['fname'] = @$request->get('fname');
            $arr_data['lname'] = @$request->get('lname');
            $arr_data['email'] = @$request->get('email');
            $arr_data['jobTitle'] = $request->get('job_title');
            $arr_data['phoneno'] = $request->get('phoneno');
            $arr_data['country'] = $request->get('country');
            $arr_data['city'] = @$request->get('city');
            $arr_data['companyUrl'] = @$request->get('cp_url');
            $arr_data['fundraisUrl'] = @$request->get('fr_url');
            $arr_data['slideshareUrl'] = @$request->get('sd_url');
            $arr_data['investorFirmvideo'] = @$request->get('fv_url');
            $arr_data['companyName'] = @$request->get('cp_name');
            $userupd = User::where('id', '=', $userid)->update(['firstname' => $request->get('fname'), 'lastname' => $request->get('lname')]);
        }

        if ($request->has('c_tagline')) {
            $arr_data['companyTagline'] = @$request->get('c_tagline');
            $arr_data['profileText'] = @$request->get('cp_text');
            $arr_data['personalBio'] = @$request->get('personalBio');
        }

        if ($request->has('ld_url')) {
            $arr_data['linkedinUrl'] = @$request->get('ld_url');
            $arr_data['fbUrl'] = @$request->get('fb_url');
            $arr_data['twitterUrl'] = @$request->get('tw_url');
        }

        if ($request->get('cp_type')) {
            $arr_data['companyType'] = @implode(',', $request->get('cp_type'));
            $arr_data['fundingType'] = @implode(',', $request->get('fd_type'));
            $arr_data['industry'] = @implode(',', $request->get('industry'));
            $arr_data['sector'] = @implode(',', $request->get('sector'));
        }

        if ($request->has('amt_raised')) {
            $arr_data['ammountRaised'] = @$request->get('amt_raised');
            $arr_data['fundingGoal'] = @$request->get('fd_goal');
            $arr_data['minReservation'] = @$request->get('min_reserve');
            $arr_data['maxReservation'] = @$request->get('max_reserve');
            $arr_data['equity'] = @$request->get('equity');
            $arr_data['openDate'] = @$request->get('open_date');
            $arr_data['closingDate'] = @$request->get('close_date');
            $masterFundingGoal = FundGoalValue::first();

            if ($masterFundingGoal['minValue'] > str_replace(',', '', $arr_data['fundingGoal']) || $masterFundingGoal['maxValue'] < str_replace(',', '', $arr_data['fundingGoal'])) {
                $v = false;

                if ($masterFundingGoal['minValue'] > str_replace(',', '', $arr_data['fundingGoal'])) {
                    $msg = 'Fund Goal is  lower than Minimum Fund Goal limit i.e.'.$masterFundingGoal['minValue'];
                }

                if ($masterFundingGoal['maxValue'] < str_replace(',', '', $arr_data['fundingGoal'])) {
                    $msg = 'Fund Goal is  higher than Maximum Fund Goal limit i.e.'.$masterFundingGoal['maxValue'];
                }
            } else {
                if (str_replace(',', '', $arr_data['ammountRaised']) > str_replace(',', '', $arr_data['fundingGoal'])) {
                    $v = false;
                    $msg = 'Fund raised must be lower than Fund Goal';
                }
            }
        }

        //$arr_data['isPublished'] = '0';
        if ($v) {
            $data = UserCompany::where('userid', $userid)->update($arr_data);

            if ($data) {
                $response = ['code' => 1, 'msg' => 'success'];
            } else {
                $response = ['code' => 2, 'msg' => 'Failed'];
            }
        } else {
            $response = ['code' => 2, 'msg' => $msg];
        }

        return $response;
    }

    public function changeToNoInvestment() {
        $arr_data = null;
        $userid = Session::get('User.id');
        $arr_data['fundingType'] = '7';
        $data = UserCompany::where('userid', $userid)->update($arr_data);

        if ($data) {
            $response = ['code' => 1, 'msg' => 'success'];
        } else {
            $response = ['code' => 2, 'msg' => 'Failed'];
        }

        return $response;
    }

    public function changeToNoInvestmentInv(Request $request) {
        $arr_data = null;
        $userid = Session::get('User.id');
        $arr_data['investmentType'] = '7';
        $data = UserInvestor::where('userid', $userid)->update($arr_data);

        if ($data) {
            $response = ['code' => 1, 'msg' => 'success'];
        } else {
            $response = ['code' => 2, 'msg' => 'Failed'];
        }

        return $response;
    }

    public function deleteCompany() {
        $arr_data = null;
        $userid = Session::get('User.id');
        $arr_data['status'] = '3';
        $data = User::where('id', $userid)->update($arr_data);

        if ($data) {
            $this->logout();
            $response = ['code' => 1, 'msg' => 'success'];
        } else {
            $response = ['code' => 2, 'msg' => 'Failed'];
        }

        return $response;
    }

    // function to get invetor profile data to edit
    public function editInvestorProfile($id) {
        if (1 == $this->checkUser()) {
            return redirect('User/index');
        }

        if (1 == $this->validUser()) {
            return redirect('User/fundraising');
        }

        $id = $id;
        $userid = Session::get('User.id');

        if ($id == $userid) {
            $InvestorType = InvestorType::where('status', 1)->get();
            $InvestmentType = InvestmentType::where('status', 1)->get();
            $stype = SectorType::get();
            $industry = Industry::orderBy('industryName', 'ASC')->get();
            $country = countryList::orderBy('country_name', 'ASC')->get();
            $regionFocus = RegionName::orderBy('regionName', 'ASC')->get();
            $investorData = UserInvestor::with('regionFocus')->with('countryData')->with('cityData')->with('User')->with('investorType')->with('investmentType')->with('sectorType')->with('industry')->where('userid', $id)->where('status', 1)->first();
            $regionFocusCountries = countryList::whereIn('region_id', explode(',', $investorData->regionFocus))->orderBy('country_name', 'ASC')->get();
            $city = CityList::where('country_id', '=', $investorData->country)->orderBy('city_name', 'ASC')->get();

            if (!empty($investorData)) {
                return view('frontend/investors-profile-edit')->with('data', $investorData->toArray())->with('investor', @$InvestorType)->with('investment', @$InvestmentType)->with('sector', @$stype)->with('industry', @$industry)->with('country', @$country)->with('city', $city)->with('region', $regionFocus)->with('regionFocusCountries', $regionFocusCountries->toArray());
            }

            return redirect('User/addinvestorProfile');
        }

        return back();
    }

    // function to save investor profile data
    // function to save updated company Data
    public function saveInvestorProfile(Request $request) {
        $v = true;
        $userid = Session::get('User.id');
        $arr_data = [];

        // $user_companies->userid = @$userid;

        if ($request->has('FilePayload')) {
            $image = base64_decode($request->get('FilePayload'));
            $folderName = '/uploads/images/';
            $safeName = str_random(10).'.'.'png';
            $destinationPath = public_path().$folderName;
            $success = file_put_contents($destinationPath.$safeName, $image);
            $arr_data['image_name'] = $safeName;

            /*$image = $request->file('photo');
            $name=time().'_'.$userid.'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/images');
            $imagePath = $destinationPath. "/". $name;
            $image->move($destinationPath, $name);
            //$user_companies->image_name = $name;
            $arr_data['image_name']=$name;*/
        }

        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name = time().'_'.$userid.'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/images');
            $imagePath = $destinationPath.'/'.$name;
            $image->move($destinationPath, $name);
            // $user_companies->banner_name = $name;
            $arr_data['banner_name'] = $name;
        }

        if ($request->has('firstname')) {
            $arr_data['firstname'] = @$request->get('firstname');
            $arr_data['lastname'] = @$request->get('lastname');
            $arr_data['email'] = @$request->get('email');
            $arr_data['jobTitle'] = @$request->get('jobTitle');
            $arr_data['phoneno'] = @$request->get('phoneno');
            $arr_data['country'] = @$request->get('country');
            $arr_data['city'] = @$request->get('city');
            $arr_data['investorfirmUrl'] = @$request->get('investorfirmUrl');
            $arr_data['fundraisUrl'] = @$request->get('fundraisUrl');
            $arr_data['slideshareUrl'] = @$request->get('slideshareUrl');
            $arr_data['investorFirmvideo'] = @$request->get('investorFirmvideo');
            $arr_data['firmName'] = @$request->get('firmName');
            $userupd = User::where('id', '=', $userid)->update(['firstname' => $request->get('firstname'), 'lastname' => $request->get('lastname')]);
        }

        if ($request->has('linkedinUrl')) {
            $arr_data['linkedinUrl'] = @$request->get('linkedinUrl');
            $arr_data['fbUrl'] = @$request->get('fbUrl');
            $arr_data['twitterUrl'] = @$request->get('twitterUrl');
        }

        if ($request->has('firmTagline')) {
            $arr_data['firmTagline'] = @$request->get('firmTagline');
            $arr_data['profileText'] = @$request->get('profileText');
            $arr_data['bioData'] = @$request->get('bioData');
        }

        if ($request->has('investorType')) {
            $investorFocus = implode(',', $request->get('investorType'));
            $arr_data['investorType'] = $investorFocus;
            $investmentFocus = implode(',', $request->get('investmentType'));
            $arr_data['investmentType'] = $investmentFocus;
            $sFocus = implode(',', $request->get('sectorFocus'));
            $iFocus = implode(',', $request->get('industryFocus'));
            $rFocus = implode(',', $request->get('regionFocus'));
            $cFocus = implode(',', $request->get('countryFocus'));
            $arr_data['industryFocus'] = $iFocus;
            $arr_data['sectorFocus'] = $sFocus;
            $arr_data['regionFocus'] = $rFocus;
            $arr_data['countryFocus'] = $cFocus;
            $arr_data['assetUndermgmt'] = @$request->get('assetUndermgmt');
            $arr_data['investmentRangefrm'] = @$request->get('investmentRangefrm');
            $arr_data['investmentRangeto'] = @$request->get('investmentRangeto');

            if (str_replace(',', '', $arr_data['investmentRangefrm']) > str_replace(',', '', $arr_data['investmentRangeto']) || str_replace(',', '', $arr_data['investmentRangefrm']) > str_replace(',', '', $arr_data['assetUndermgmt']) || str_replace(',', '', $arr_data['investmentRangeto']) > str_replace(',', '', $arr_data['assetUndermgmt'])) {
                $v = false;
            }
        }

        //$arr_data['isPublished'] = '0';
        if ($v) {
            $data = UserInvestor::where('userid', $userid)->update($arr_data);

            if ($data) {
                $response = ['code' => 1, 'msg' => 'success'];
            } else {
                $response = ['code' => 2, 'msg' => 'Failed'];
            }
        } else {
            $response = ['code' => 2, 'msg' => 'Please ensure that Investment Range From is lower than Investment Range To and that Investment Range To is lower than Assets Under Management'];
        }

        return $response;
    }

    public function searchCompanyRelevance() {
        $inputData = Input::all();
        $response = [];
        $resData = [];

        if (!empty($inputData)) {
            $searchType = $inputData['data'];
            $q = UserCompany::with('sector')->with('countryData')->with('cityData')->with('industry')->with('companyType')->with('User')->with('TypeFunding')->where('status', 1)->where('is_Public', 1);

            if ('Newest' == $searchType) {
                $q->orderby('created_at', 'DESC');
            } elseif ('EndDate' == $searchType) {
                $q->orderby('closingDate', 'DESC');
            } elseif ('Funding Goal' == $searchType) {
                //$q->orderby('fundingGoal','DESC');
                //$q->orderByRaw('LENGTH(fundingGoal) DESC');
                $q->orderByRaw('LENGTH(REPLACE(fundingGoal, ",", "")) DESC');
            }
            $data = $q->get();
            $resData = $data->toArray();
            $response = ['code' => 1, 'msg' => 'success', 'data' => $resData];
        }

        return $response;
    }

    public function searchInvestorRelevance() {
        $inputData = Input::all();
        $response = [];
        $resData = [];

        if (!empty($inputData)) {
            $searchType = $inputData['data'];
            $q = UserInvestor::with('regionFocus')->with('investorType')->with('countryData')->with('cityData')->with('User')->where('status', 1);

            if ('Newest' == $searchType) {
                $q->orderby('created_at', 'DESC');
            } elseif ('EndDate' == $searchType) {
                $q->orderby('updated_at', 'ASC');
            } elseif ('Funding Goal' == $searchType) {
                $q->orderby('investmentRangefrm', 'DESC');
            }
            $data = $q->get();
            $resData = $data->toArray();
            $response = ['code' => 1, 'msg' => 'success', 'data' => $resData];
        }

        return $response;
    }

    public function getSearchData(Request $request) {
        $queryString = Input::all();

        $arr = [];

        $is_proff = null;
        $show_featured = null;

        if (Session::has('User')) {
            $user_id = Session::get('User.id');
            $user = User::where('id', $user_id)->first()->toArray();

            $is_proff = $user['is_Professional'];
        } else {
            $show_featured = 1;
        }

        if ('0' == $is_proff) {
            $professional_values = [0];
        } else {
            if ('1' == $is_proff) {
                $professional_values = [1];
            } else {
                $professional_values = [0, 1];
            }
        }

        $company_name = null;
        $company_type = null;
        $funding_type = null;
        $industry = null;
        $country = null;
        $city = null;
        $sort_by = null;

        if (!empty($queryString['data'])) {
            $dataArray = urldecode($queryString['data']);
            parse_str($dataArray, $arr);

            if (!empty($arr['company_name'])) {
                $company_name = str_replace('"', '', $arr['company_name']);
            }

            if (!empty($arr['companytype'])) {
                $arr['companytype'] = str_replace('"', '', $arr['companytype']);
                $company_type = json_decode($arr['companytype']);
            }

            if (!empty($arr['fundtype'])) {
                $arr['fundtype'] = str_replace('"', '', $arr['fundtype']);
                $funding_type = json_decode($arr['fundtype']);
            }

            if (!empty($arr['industry'])) {
                $arr['industry'] = str_replace('"', '', $arr['industry']);
                $industry = json_decode($arr['industry']);
            }

            if (!empty($arr['country'])) {
                $arr['country'] = str_replace('"', '', $arr['country']);
                $country = json_decode($arr['country']);
            }

            if (!empty($arr['city'])) {
                $arr['city'] = str_replace('"', '', $arr['city']);
                $city = json_decode($arr['city']);
            }

            if (!empty($arr['sort_by'])) {
                $sort_by_param = str_replace('"', '', $arr['sort_by']);

                switch ($sort_by_param) {
                    case 'Relevance':
                        break;

                    case 'Newest':
                        $sort_by = 'user_companies.created_at';

                        break;

                    case 'FundingGoal':
                        $sort_by = 'user_companies.fundingGoal';

                        break;
                }
            }
        }

        $results = DB::table('user_companies')
            ->leftjoin('country_lists', 'user_companies.country', '=', 'country_lists.id')
            ->leftjoin('city_lists', 'user_companies.city', '=', 'city_lists.id')
            ->leftjoin('sector_types', 'user_companies.sector', '=', 'sector_types.id')
            ->leftjoin('industries', 'user_companies.industry', '=', 'industries.id')
            ->leftjoin('type_companies', 'user_companies.companyType', '=', 'type_companies.id')
            ->leftjoin('type_fundings', 'user_companies.fundingType', '=', 'type_fundings.id')
            ->leftjoin('users', 'user_companies.userid', '=', 'users.id')
            ->select(
                'user_companies.*',
                'country_lists.country_name',
                'city_lists.city_name',
                'sector_types.sectorName',
                'industries.industryName',
                'type_companies.typeCompanies',
                'type_fundings.typeFunding'
            )
            ->whereIn('users.is_Professional', $professional_values)
            ->where('users.status', '=', 1)
            ->when($company_name, function ($query, $company_name) {
                return $query->where('user_companies.companyName', 'LIKE', '%'.$company_name.'%');
            })
            ->when($show_featured, function ($query, $show_featured) {
                return $query->where('user_companies.is_featured', '=', $show_featured);
            })
            ->when($company_type, function ($query, $company_type) {
                return $query->whereIn('user_companies.companyType', $company_type);
            })
            ->when($funding_type, function ($query, $funding_type) {
                return $query->whereIn('user_companies.fundingType', $funding_type);
            })
            ->when($industry, function ($query, $industry) {
                return $query->whereIn('user_companies.industry', $industry);
            })
            ->when($country, function ($query, $country) {
                return $query->whereIn('user_companies.country', $country);
            })
            ->when($city, function ($query, $city) {
                return $query->whereIn('user_companies.city', $city);
            })
            ->when($sort_by, function ($query, $sort_by) {
                return $query->orderBy($sort_by, 'DESC');
            })
            ->paginate(40);

        $results->appends(request()->except(['page', '_token']));

        return $results->toJson();
    }

    public function getSearchDatainvestor(Request $request) {
        $queryString = Input::all();

        $arr = [];

        $is_proff = null;
        $show_featured = null;

        if (Session::has('User')) {
            $user_id = Session::get('User.id');
            $user = User::where('id', $user_id)->first()->toArray();

            $is_proff = $user['is_Professional'];
        } else {
            $show_featured = 1;
        }

        if ('0' == $is_proff) {
            $professional_values = [0];
        } else {
            if ('1' == $is_proff) {
                $professional_values = [1];
            } else {
                $professional_values = [0, 1];
            }
        }

        $firm_name = null;
        $investor_type = null;
        $investment_type = null;
        $industry = null;
        $country = null;
        $city = null;
        $sort_by = null;

        if (!empty($queryString['data'])) {
            $dataArray = urldecode($queryString['data']);
            parse_str($dataArray, $arr);

            if (!empty($arr['firm_name'])) {
                $firm_name = str_replace('"', '', $arr['firm_name']);
            }

            if (!empty($arr['investortype'])) {
                $arr['investortype'] = str_replace('"', '', $arr['investortype']);
                $investor_type = json_decode($arr['investortype']);
            }

            if (!empty($arr['investmenttype'])) {
                $arr['investmenttype'] = str_replace('"', '', $arr['investmenttype']);
                $investment_type = json_decode($arr['investmenttype']);
            }

            if (!empty($arr['industry'])) {
                $arr['industry'] = str_replace('"', '', $arr['industry']);
                $industry = json_decode($arr['industry']);
            }

            if (!empty($arr['country'])) {
                $arr['country'] = str_replace('"', '', $arr['country']);
                $country = json_decode($arr['country']);
            }

            if (!empty($arr['city'])) {
                $arr['city'] = str_replace('"', '', $arr['city']);
                $city = json_decode($arr['city']);
            }

            if (!empty($arr['sort_by'])) {
                $sort_by_param = str_replace('"', '', $arr['sort_by']);

                switch ($sort_by_param) {
                    case 'Relevance':
                        break;

                    case 'Newest':
                        $sort_by = 'user_investors.created_at';

                        break;
                }
            }
        }

        $results = DB::table('user_investors')
            ->leftjoin('users', 'user_investors.userid', '=', 'users.id')
            ->leftjoin('region_names', function ($query) {
                $query->whereRaw('find_in_set(region_names.id, user_investors.regionFocus)');
            })
            ->leftjoin('country_lists', 'user_investors.country', '=', 'country_lists.id')
            // ->leftjoin('country_lists', function ($query) {
            //     $query->whereRaw('find_in_set(country_lists.id, user_investors.countryFocus)');
            // })
            ->leftjoin('sector_types', function ($query) {
                $query->whereRaw('find_in_set(sector_types.id, user_investors.sectorFocus)');
            })
            ->leftjoin('industries', function ($query) {
                $query->whereRaw('find_in_set(industries.id, user_investors.industryFocus)');
            })
            ->leftjoin('country_lists as investor_country', 'user_investors.country', '=', 'investor_country.id')
            ->leftjoin('city_lists', 'user_investors.city', '=', 'city_lists.id')
            ->select(
                'user_investors.*',
                'investor_country.country_name',
                'city_lists.city_name',
                DB::raw('GROUP_CONCAT(DISTINCT region_names.regionName) as "grouped_regions"'),
                //DB::raw('GROUP_CONCAT(DISTINCT country_lists.country_name) as "grouped_countries"'),
                'country_lists.country_name',
                DB::raw('GROUP_CONCAT(DISTINCT sector_types.sectorName) as "grouped_sectors"'),
                DB::raw('GROUP_CONCAT(DISTINCT industries.industryName) as "grouped_industries"')
                    )
            ->whereIn('users.is_Professional', $professional_values)
            ->where('users.status', '=', 1)
            ->when($firm_name, function ($query, $firm_name) {
                return $query->where('user_investors.firmName', 'LIKE', '%'.$firm_name.'%');
            })
            ->when($show_featured, function ($query, $show_featured) {
                return $query->where('user_investors.is_featured', '=', $show_featured);
            })
            ->when($industry, function ($query, $industry) {
                $raw_query = '(';

                foreach ($industry as $industry_item) {
                    $raw_query .= " find_in_set('${industry_item}', user_investors.industryFocus) or";
                }

                $raw_query = rtrim($raw_query, 'or').')';

                return $query->whereRaw($raw_query);
            })
            ->when($investor_type, function ($query, $investor_type) {
                $raw_query = '(';

                foreach ($investor_type as $investor_type_item) {
                    $raw_query .= " find_in_set('${investor_type_item}', user_investors.investorType) or";
                }

                $raw_query = rtrim($raw_query, 'or').')';

                return $query->whereRaw($raw_query);
            })
            ->when($investment_type, function ($query, $investment_type) {
                $raw_query = '(';

                foreach ($investment_type as $investment_type_item) {
                    $raw_query .= " find_in_set('${investment_type_item}', user_investors.investmentType) or";
                }

                $raw_query = rtrim($raw_query, 'or').')';

                return $query->whereRaw($raw_query);
            })
            ->when($country, function ($query, $country) {
                $raw_query = '(';

                foreach ($country as $country_item) {
                    $raw_query .= " user_investors.country = '${country_item}' or";
                }

                $raw_query = rtrim($raw_query, 'or').')';

                return $query->whereRaw($raw_query);
            })
            ->when($city, function ($query, $city) {
                $raw_query = '(';

                foreach ($city as $city_item) {
                    $raw_query .= " user_investors.city = '${city_item}' or";
                }

                $raw_query = rtrim($raw_query, 'or').')';

                return $query->whereRaw($raw_query);
            })
            ->when($sort_by, function ($query, $sort_by) {
                return $query->orderBy($sort_by, 'DESC');
            })
            ->groupBy('user_investors.id')
            ->paginate(40);

        $results->appends(request()->except(['page', '_token']));

        return $results->toJson();
    }

    public function oldgetSearchDatainvestor() {
        $queryString = Input::all();
        $resData = [];
        $response = [];
        $arr = [];

        $is_proff = null;

        if (Session::has('User')) {
            $user_id = Session::get('User.id');
            $user = User::where('id', $user_id)->first()->toArray();
            $is_proff = $user['is_Professional'];
        }

        if ('0' == $is_proff) {
            $users = User::where('is_Professional', '0')->get('id');
        } else {
            if ('1' == $is_proff) {
                $users = User::where('is_Professional', '1')->get('id');
            } else {
                $users = User::get('id');
            }
        }

        $user_arr = $users->toArray();

        foreach ($user_arr as $usr) {
            $user_arr1[] = $usr['id'];
        }

        $in_users_id = implode(',', $user_arr1);

        if (!empty($queryString['data'])) {
            $dataArray = urldecode($queryString['data']);
            parse_str($dataArray, $arr);
            $q = '';
            $i = 0;

            if (isset($arr['investortype'])) {
                if (!empty($arr['investortype'])) {
                    $ind = str_replace('[', '', $arr['investortype']);
                    $ind = str_replace(']', '', $ind);
                    $ind = str_replace('"', '', $ind);

                    if (!empty($ind)) {
                        $Comls = array_keys($ind);
                        $Comlist = explode(',', @$Comls[0]);

                        if (!in_array('0', array_values($Comlist), true)) {
                            $q .= 'a.investorType in ('.implode(',', $Comlist).') ';

                            foreach ($Comlist as $vv) {
                                $q .= ' and find_in_set ('.$vv.', a.investorType )  ';
                            }
                            ++$i;
                        }
                    }
                }
            }

            if (isset($arr['investmenttype'])) {
                if (!empty($arr['investmenttype'])) {
                    $ind = str_replace('[', '', $arr['investmenttype']);
                    $ind = str_replace(']', '', $ind);
                    $ind = str_replace('"', '', $ind);

                    if (!empty($ind)) {
                        $Comls = $ind;
                        $Ftype = explode(',', $ind);

                        if (0 != $i) {
                            $q .= 'and ';
                        }

                        if (!in_array('0', array_values($Ftype), true)) {
                            $q .= 'a.investmentType in ('.implode(',', $Ftype).')  ';
                            ++$i;
                        }

                        foreach ($Ftype as $vv) {
                            $q .= ' and find_in_set ('.$vv.', a.investmentType )  ';
                        }
                    }
                }
            }

            if (isset($arr['industry'])) {
                if (!empty($arr['industry'])) {
                    $ind = str_replace('[', '', $arr['industry']);
                    $ind = str_replace(']', '', $ind);
                    $ind = str_replace('"', '', $ind);

                    if (!empty($ind)) {
                        if (0 != $i) {
                            $q .= 'and ';
                        }
                        $q .= ' find_in_set ( '.$ind.', a.industryFocus)  ';
                        ++$i;
                    }
                }
            }

            if (isset($arr['country'])) {
                if (!empty($arr['country'])) {
                    $ind = str_replace('[', '', $arr['country']);
                    $ind = str_replace(']', '', $ind);
                    $ind = str_replace('"', '', $ind);

                    if (!empty($ind)) {
                        if (0 != $i) {
                            $q .= 'and ';
                        }
                        $q .= 'a.country in ('.$ind.') ';
                        ++$i;
                    }
                }
            }

            if (isset($arr['city'])) {
                if (!empty($arr['city'])) {
                    $ind = str_replace('[', '', $arr['city']);
                    $ind = str_replace(']', '', $ind);
                    $ind = str_replace('"', '', $ind);

                    if (!empty($ind)) {
                        if (0 != $i) {
                            $q .= 'and ';
                        }

                        $q .= 'a.city in ('.$ind.') ';

                        ++$i;
                    }
                }
            }

            if ($i > 0) {
                $query = 'select  a.*,b.country_name,c.city_name,d.regionName, e.typeInvestor 
						from user_investors a 
						left join country_lists b 
						ON FIND_IN_SET(b.id, a.country) > 0
						left join  city_lists c
						ON FIND_IN_SET(c.id, a.city) > 0
						left join region_names d
						ON FIND_IN_SET(d.id, a.regionFocus) > 0
						left join investor_types e 
						ON FIND_IN_SET(e.id, a.investorType) > 0
						where  
						a.status=1 and ('.$q.') and a.userid in ('.$in_users_id.')
						GROUP by a.id';
            } else {
                $query = 'select  a.*,b.country_name,c.city_name,d.regionName, e.typeInvestor 
				from user_investors a 
				left join country_lists b 
				ON FIND_IN_SET(b.id, a.country) > 0
				left join  city_lists c
				ON FIND_IN_SET(c.id, a.city) > 0
				left join region_names d
				ON FIND_IN_SET(d.id, a.regionFocus) > 0
				left join investor_types e 
				ON FIND_IN_SET(e.id, a.investorType) > 0
				where  
				a.status=1 and a.userid in ('.$in_users_id.')
				GROUP by a.id';
            }

            $result = DB::select($query);
            $resData = $result;

            if (!empty($resData)) {
                $response = ['code' => 1, 'msg' => 'Success', 'data' => $resData];
            } else {
                $response = ['code' => 1, 'msg' => 'Failed', 'data' => 'Data Not Found'];
            }
        } else {
            $query = 'select a.*,b.country_name,c.city_name,d.regionName, e.typeInvestor
						from user_investors a, country_lists b, city_lists c, region_names d, 
						investor_types e where a.country=b.id and a.city = c.id and 
						a.regionFocus=d.id and a.investorType=e.id and a.status=1 and 
						a.userid in ('.$in_users_id.')';

            $result = DB::select($query);
            $resData = $result;
            $response = ['code' => 1, 'msg' => 'Success', 'data' => $resData];
        }

        return $response;
    }

    public function events() {
        return view('frontend/news-event');
    }

    public function termsofuse() {
        return view('frontend/termsofuse');
    }

    public function privacy_policy() {
        $page_data = StaticPage::where('url', 'privacy-policy')->first()->toArray();
        $page_id = $page_data['id'];
        $page_data['content'] = PageData::where('page_id', '=', $page_id)->first()->toArray();

        return view('frontend/page')->with('data', $page_data);
    }

    public function requestMeeting() {
        /*if($this->checkUser()==1){
        	return redirect('User/index');
        }*/
        $inputData = Input::all();
        $response = [];
        $sender_id = Session::get('User.id');

        if (!$this->checkMeetingLimit()) {
            return $response = ['code' => 2, 'msg' => 'meetinglimit'];
        }

        if (!$this->approve_check()) {
            return $response = ['code' => 2, 'msg' => 'notApproved'];
        }

        $todayMsg = Message::where('sender_id', '=', $sender_id)->whereDate('created_at', Carbon::today())->count();

        if ($todayMsg <= 100) {
            if (!empty($inputData)) {
                $reciever_user = $inputData['reciever_id'];
                $requestMeeting = new Message();
                $requestMeeting->sender_id = $sender_id;
                $requestMeeting->reciever_id = $inputData['reciever_id'];
                $requestMeeting->message = $inputData['message'];
                $requestMeeting->meeting_at = @$inputData['meeting'];
                $requestMeeting->reserve_amount = @$inputData['reserved_amount'];
                $status = '2';
                $requestMeeting->type = 1;
                $requestMeeting->notify = 1;
                $res = InterestedIn::where('follower_id', $sender_id)->where('following_id', $inputData['reciever_id'])->get();

                $sender = User::with('investorDetail')->with('companyDetail')->find($sender_id)->toArray();
                $reciver = User::with('investorDetail')->with('companyDetail')->find($inputData['reciever_id'])->toArray();

                if ('yes' == $reciver['message_meeting_approval']) {
                    $status = '1';
                }

                $requestMeeting->status = $status;

                if ($sender['investor_detail']) {
                    $investor_details = [];

                    $investor_details['sector_focus_details'] = SectorType::whereIn('id', explode(',', $sender['investor_detail']['sectorFocus']))->orderBy('sectorName')->pluck('sectorName')->toArray();
                    $investor_details['industry_focus_details'] = Industry::whereIn('id', explode(',', $sender['investor_detail']['industryFocus']))->orderBy('industryName')->pluck('industryName')->toArray();
                    $investor_details['country_focus_details'] = countryList::whereIn('id', explode(',', $sender['investor_detail']['countryFocus']))->orderBy('country_name')->pluck('country_name')->toArray();
                    $investor_details['region_focus_details'] = RegionName::whereIn('id', explode(',', $sender['investor_detail']['regionFocus']))->orderBy('regionName')->pluck('regionName')->toArray();

                    $sender['investor_details'] = $investor_details;

                    if ($reciver['company_detail']) {
                        $user_investor = UserInvestor::where('userid', '=', $sender_id)->first();

                        $sector_focus = implode(',', array_unique(explode(',', $user_investor->sectorFocus.','.$reciver['company_detail']['sector'])));
                        $industry_focus = implode(',', array_unique(explode(',', $user_investor->industryFocus.','.$reciver['company_detail']['industry'])));
                        $country_focus = implode(',', array_unique(explode(',', $user_investor->countryFocus.','.$reciver['company_detail']['country'])));
                        $country = countryList::find($reciver['company_detail']['country']);
                        $region_focus = implode(',', array_unique(explode(',', $user_investor->regionFocus.','.$country->region_id)));

                        $user_investor->sectorFocus = $sector_focus;
                        $user_investor->industryFocus = $industry_focus;
                        $user_investor->countryFocus = $country_focus;
                        $user_investor->regionFocus = $region_focus;

                        $user_investor->save();
                    }
                }

                if ('yes' == $reciver['email_notifications'] && 'yes' == $reciver['message_meeting_approval']) {
                    try {
                        $mailckk = Mail::send(
                            'frontend/email/req_meeting',
                            ['sender' => $sender, 'reciver' => $reciver, 'message_contant' => $inputData['message']],
                            function ($message) use ($reciver, $sender) {
                                $message->to($reciver['email'], $reciver['firstname'].' '.$reciver['lastname'])->subject('New Meeting Request - LondCap');
                            }
                        );
                    } catch (\Exception $e) {
                    }
                }

                if ($requestMeeting->save()) {
                    if ($res->isEmpty()) {
                        $intList = new InterestedIn();
                        $intList->follower_id = $sender_id;
                        $intList->following_id = $inputData['reciever_id'];
                        $intList->save();
                    }
                    $response = ['code' => 1, 'msg' => 'success'];
                } else {
                    $response = ['code' => 1, 'msg' => 'Sorry you can`t send message'];
                }
            }
        } else {
            $response = ['code' => 1, 'msg' => 'limitover'];
        }

        return $response;
    }

    public function requestMessage() {
        /*if($this->checkUser()==1){
        	return redirect('User/index');
        }*/

        $inputData = Input::all();
        $response = [];
        $sender_id = Session::get('User.id');

        if (!$this->checkMsgLimit()) {
            return $response = ['code' => 2, 'msg' => 'msglimit'];
        }

        if (!$this->approve_check()) {
            return $response = ['code' => 2, 'msg' => 'notApproved'];
        }

        // $todayMsg = Message::where('sender_id','=',$sender_id)->whereDate('created_at', Carbon::today())->count();
        // if($todayMsg<=100)
        // {
        if (!empty($inputData)) {
            $reciever_user = $inputData['reciever_id'];
            $requestMeeting = new Message();
            $requestMeeting->sender_id = $sender_id;
            $requestMeeting->reciever_id = $inputData['reciever_id'];
            $requestMeeting->message = $inputData['message'];
            //$requestMeeting->meeting_at = @$inputData['meeting'];

            $reciver = User::where('id', $inputData['reciever_id'])->first()->toArray();
            $status = '2';

            if ('yes' == $reciver['message_meeting_approval']) {
                $status = '1';
            }

            $requestMeeting->status = $status;
            $requestMeeting->type = 2;
            $requestMeeting->notify = 1;
            $res = InterestedIn::where('follower_id', $sender_id)->where('following_id', $inputData['reciever_id'])->get();

            if ($requestMeeting->save()) {
                $sender = User::with('investorDetail')->with('companyDetail')->find($sender_id)->toArray();
                $reciver = User::with('investorDetail')->with('companyDetail')->find($inputData['reciever_id'])->toArray();

                if ($sender['investor_detail'] && $reciver['company_detail']) {
                    $user_investor = UserInvestor::where('userid', '=', $sender_id)->first();

                    $sector_focus = $user_investor->sectorFocus.','.$reciver['company_detail']['sector'];
                    $industry_focus = $user_investor->industryFocus.','.$reciver['company_detail']['industry'];
                    $country_focus = $user_investor->countryFocus.','.$reciver['company_detail']['country'];
                    $country = countryList::find($reciver['company_detail']['country']);
                    $region_focus = $user_investor->regionFocus.','.$country->region_id;

                    $user_investor->sectorFocus = $sector_focus;
                    $user_investor->industryFocus = $industry_focus;
                    $user_investor->countryFocus = $country_focus;
                    $user_investor->regionFocus = $region_focus;

                    $user_investor->save();
                }

                if ('1' == $status && 'yes' == $reciver['email_notifications']) {
                    try {
                        $mailckk = Mail::send('frontend/email/message', ['sender' => $sender, 'reciver' => $reciver, 'message_contant' => $inputData['message']], function ($message) use ($sender,$reciver) {
                            $message->to($reciver['email'], $reciver['firstname'].' '.$reciver['lastname'])->subject('New Message - LondCap');
                        });
                    } catch (\Exception $e) {
                    }
                }

                if ($res->isEmpty()) {
                    $intList = new InterestedIn();
                    $intList->follower_id = $sender_id;
                    $intList->following_id = $inputData['reciever_id'];
                    $intList->save();
                }
                $response = ['code' => 1, 'msg' => 'success'];
            } else {
                $response = ['code' => 1, 'msg' => 'Sorry you can`t send message'];
            }
        }

        return $response;
    }

    public function reportAbuse() {
        $inputData = Input::all();
        $response = [];
        $sender_id = Session::get('User.id');

        if (!empty($inputData)) {
            $reciever_user = $inputData['reciever_id'];
            $reportAbuse = new Report();
            $reportAbuse->userid = $sender_id;
            $reportAbuse->for_user_id = $inputData['reciever_id'];
            $reportAbuse->description = $inputData['message'];

            if ($reportAbuse->save()) {
                $response = ['code' => 1, 'msg' => 'success'];
            } else {
                $response = ['code' => 1, 'msg' => 'Sorry you can`t send message'];
            }
        }

        return $response;
    }

    public function MessageLimits() {
        return view('frontend/messages_limits');
    }

    // function to delete msgs by user
    public function deleteMsgs() {
        if (1 == $this->checkUser()) {
            return redirect('User/index');
        }
        $inputData = Input::all();
        $response = [];

        if (!empty($inputData)) {
            $user_id_array = $inputData['id'];
            $user = Message::whereIn('id', $user_id_array);

            if ($user->delete()) {
                $response = ['code' => 1, 'msg' => 'Deleted'];
            } else {
                $response = ['code' => 1, 'msg' => 'Not Deleted'];
            }
        }

        return $response;
    }

    // function to signup using fb
    public function handleProviderCallback($provider) {
        $user = $this->createOrGetUser(Socialite::driver($provider)->stateless()->user(), $provider);

        Auth::login($user);

        return redirect()->to('/home');
    }

    // function to get cisty list dependent
    public function getcityList(Request $request) {
        $cid = $request->cid;
        
        if ($cid) {
            if ('array' == gettype($cid)) {
                $citylist = CityList::with('Country')
                    ->where('status', '=', 1)
                    ->whereIn('country_id', (array) $cid)
                    ->get();
            } else {
                $citylist = CityList::with('Country')
                    ->where('status', '=', 1)
                    ->where('country_id', '=', $cid)
                    ->get();
            }
        } else {
            $citylist = CityList::with('Country')
                ->where('status', '=', 1)
                ->get();
        }

        return json_encode($citylist);
    }

    public function findCityList() {
        $inputData = Input::all();
        $city_query = $inputData['term'];

        $cityListCollection = CityList::with('Country')
            ->where('status', '=', 1)
            ->where('city_name', 'LIKE', $city_query.'%')
            ->get();

        $cityList = [];

        foreach ($cityListCollection->toArray() as $city) {
            $cityList[] = [
                'label' => $city['city_name'].', '.$city['country']['country_name'],
                'value' => $city['city_name'].', '.$city['country']['country_name'],
            ];
        }

        return json_encode($cityList);
    }

    public function findNamelist() {
        $id = Session::get('User.id');
        $followingList = InterestedIn::where('follower_id', $id)->pluck('following_id');
        $followerList = InterestedIn::where('following_id', $id)->pluck('follower_id');
        $userlist = User::whereIn('id', array_merge($followingList->toArray(), $followerList->toArray()))->get();

        return json_encode($userlist);
    }

    public function fundraising() {
        $reason = null;

        $user_id = Session::get('User.id');
        $user = User::where('id', $user_id)->first()->toArray();
        $active_till = date('Y-m-d', strtotime($user['activation']));
        $today = date('Y-m-d');

        if ($today > $active_till) {
            $reason = 'Your trial period has been expired. Please renew your account to get unlimited access.';
        } else {
            if (!$this->checkMsgLimit()) {
                $reason = 'Your free trial message limit has been exceeded. Please renew your account to get unlimited access.';
            } else {
                if (!$this->checkMeetingLimit()) {
                    $reason = 'Your free trial meeting limit has been exceeded. Please renew your account to get unlimited access.';
                } else {
                    if (!$this->checkProfileLimit()) {
                        $reason = 'Your free trial profile visit limit has been exceeded. Please renew your account to get unlimited access.';
                    }
                }
            }
        }

        return view('frontend/fundraising')->with('reason', $reason);
    }

    public function userAccountInfo() {
        if (1 == $this->validUser()) {
            return redirect('User/fundraising');
        }

        if (!Session::has('User')) {
            return redirect('User/index');
        }
        $id = Session::get('User.id');
        $userData = User::where('id', '=', $id)->first();

        return view('frontend/user-account-my-info')->with('data', $userData);
    }

    public function userProfileCompany($id) {
        if (1 == $this->validUser()) {
            return redirect('User/fundraising');
        }
        $userid = Session::get('User.id');
        $id = $id;

        if ($userid == $id) {
            $userData = User::where('id', '=', $id)->first();
            $type = Session::get('User.usertype');
            $list = InterestedIn::where('follower_id', $userid)->pluck('following_id');
            $investorData = [];
            $investorData2 = [];
            $industry = Industry::orderBy('industryName', 'ASC')->pluck('industryName', 'id');
            $country = countryList::orderBy('country_name', 'ASC')->pluck('country_name', 'id');
            $regionFocus = RegionName::orderBy('regionName', 'ASC')->pluck('regionName', 'id');
            $sectors = SectorType::where('status', 1)->orderBy('sectorName')->pluck('sectorName', 'id');

            if (count($list) > 0) {
                $investorData = UserInvestor::with('regionFocus')->with('investorType')->with('countryData')->with('cityData')->with('User')->whereIn('userid', $list)->get();
            }
            $list2 = InterestedIn::where('following_id', $userid)->pluck('follower_id');

            if (count($list2) > 0) {
                $investorData2 = UserInvestor::with('regionFocus')->with('investorType')->with('countryData')->with('cityData')->with('User')->whereIn('userid', $list2)->get();
            }
            $compInfo = UserCompany::with('countryData')->with('cityData')->with('companyType')->with('User')->with('companyType')->with('TypeFunding')->with('industry')->with('sector')->where('userid', '=', $id)->first();

            if (!empty($compInfo)) {
                $inv = [];

                if (!empty($investorData)) {
                    $inv = @$investorData->toArray();
                }

                return view('frontend/user-profile-company')->with('data', @$userData)->with('comInfo', @$compInfo->toArray())->with('expressedInterest', $inv)->with('expressedInterest2', @$investorData2)->with('industryList', $industry->toArray())->with('countryList', $country->toArray())->with('regionList', $regionFocus->toArray())->with('sectorList', $sectors->toArray());
            }

            return redirect('User/addcompanyProfile');
        }

        return back();
    }

    public function userProfileInvestor($id) {
        if (1 == $this->validUser()) {
            return redirect('User/fundraising');
        }

        $id = $id;
        $userid = Session::get('User.id');

        if ($userid == $id) {
            $userData = User::where('id', '=', $id)->first();
            $type = Session::get('User.usertype');
            $list = InterestedIn::where('follower_id', $userid)->pluck('following_id');
            $companyData = [];
            $companyData2 = [];

            if (count($list) > 0) {
                $companyData = UserCompany::with('sector')->with('countryData')->with('cityData')->with('industry')->with('companyType')->with('User')->with('TypeFunding')->whereIn('userid', $list)->get();
            }
            $list2 = InterestedIn::where('following_id', $userid)->pluck('follower_id');

            if (count($list2) > 0) {
                $companyData2 = UserCompany::with('sector')->with('countryData')->with('cityData')->with('industry')->with('companyType')->with('User')->with('TypeFunding')->whereIn('userid', $list2)->get();
            }
            $investInfo = UserInvestor::with('countryData')->with('cityData')->with('User')->where('userid', '=', $id)->first();

            if (!empty($investInfo)) {
                $companyData2Tem = [];

                if (!empty($companyData2)) {
                    $companyData2Tem = $companyData2->toArray();
                }

                return view('frontend/user-profile-investor')->with('data', $userData)->with('comInfo', $investInfo->toArray())->with('compData', $companyData->toArray())->with('compData2', $companyData2Tem);
            }

            return redirect('User/addinvestorProfile');
        }

        return back();
    }

    public function ChangePasswordForm() {
        return view('frontend/ChangePasswordForm');
    }

    public function ChangeUserPassword() {
        $inputData = Input::all();
        $response = [];
        $userid = Session::get('User.id');

        if (!empty($inputData)) {
            $oldpassword = trim(md5($inputData['oldpassword']));
            $userData = User::where('id', '=', $userid)->where('password', '=', $oldpassword)->first();

            if (!empty($userData)) {
                $newpassword = trim($inputData['newpassword']);
                $confirmpassword = trim($inputData['confirmpassword']);

                if ($newpassword == $confirmpassword) {
                    $userData = User::find($userid);
                    $userData->password = md5($newpassword);

                    if ($userData->save()) {
                        $response = ['code' => 1, 'msg' => 'success'];
                    }
                } else {
                    $response = ['code' => 1, 'msg' => 'Cofirmed password do not matched'];
                }
            } else {
                $response = ['code' => 1, 'msg' => 'Old password do not matched'];
            }
        }

        return $response;
    }

    public function comapnyPublishData() {
        $userid = Session::get('User.id');
        $reponse = [];
        $companyData = UserCompany::where('userid', '=', $userid)->update(['isPublished' => 1]);
        $getData = UserCompany::where('userid', '=', $userid)->where('isPublished', '=', 1)->first();

        if (!empty($getData)) {
            $response = ['code' => 1, 'msg' => 'success'];
        } else {
            $response = ['code' => 2, 'msg' => 'failed'];
        }

        return json_encode($response);
    }

    public function investorPublishData() {
        $userid = Session::get('User.id');
        $reponse = [];
        $companyData = UserInvestor::where('userid', '=', $userid)->update(['isPublished' => 1]);
        $getData = UserInvestor::where('userid', '=', $userid)->where('isPublished', '=', 1)->first();

        if (!empty($getData)) {
            $response = ['code' => 1, 'msg' => 'success'];
        } else {
            $response = ['code' => 2, 'msg' => 'failed'];
        }

        return json_encode($response);
    }

    public function editUserInfo() {
        $inputData = Input::all();
        $response = [];

        if (!empty($inputData)) {
            $userid = Session::get('User.id');

            $userInfo = User::where('id', $userid)->first();
            $data = $userInfo->toArray();

            $usertype = $data['usertype'];
            $firstname = $inputData['firstname'];
            $lastname = $inputData['lastname'];
            $email = $inputData['email'];
            $email_notifications = isset($inputData['email_notifications']) ? 'yes' : 'no';

            $userdata = User::find($userid);
            $userdata->firstname = $firstname;
            $userdata->lastname = $lastname;
            $userdata->email = $email;
            $userdata->email_notifications = $email_notifications;

            if (1 == $usertype && $userdata->save()) {
                $saveData = UserCompany::where('id', $userid)->update(['fname' => $firstname, 'lname' => $lastname, 'email' => $email]);
                $response = ['code' => 1, 'msg' => 'success'];
            } elseif (2 == $usertype && $userdata->save()) {
                $saveData = UserInvestor::where('id', $userid)->update(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email]);
                $response = ['code' => 1, 'msg' => 'success'];
            }
        }

        return $response;
    }

    public function deleteAccount() {
        $userid = Session::get('User.id');
        $response = [];
        $userData = User::find($userid);
        $userData->status = 3;

        if ($userData->save()) {
            $response = ['code' => 1, 'msg' => 'success'];
        } else {
            $response = ['code' => 1, 'msg' => 'failed'];
        }

        return $response;
    }

    public function userCompanyIntrestedIn($id) {
        if (1 == $this->validUser()) {
            return redirect('User/fundraising');
        }
        $userid = Session::get('User.id');
        $id = $id;

        if ($userid == $id) {
            $userData = User::where('id', '=', $id)->first();
            $type = Session::get('User.usertype');
            $list = InterestedIn::where('following_id', $userid)->pluck('follower_id');
            $investorData = [];

            if (count($list) > 0) {
                $investorData = UserInvestor::with('regionFocus')->with('investorType')->with('countryData')->with('cityData')->with('User')->whereIn('userid', $list)->get();
            }
            $industry = Industry::orderBy('industryName', 'ASC')->pluck('industryName', 'id');
            $country = countryList::orderBy('country_name', 'ASC')->pluck('country_name', 'id');
            $regionFocus = RegionName::orderBy('regionName', 'ASC')->pluck('regionName', 'id');
            $sectors = SectorType::where('status', 1)->orderBy('sectorName')->pluck('sectorName', 'id');
            //$investorData = UserInvestor::with('regionFocus')->with('investorType')->with('countryData')->with('cityData')->with('User')->get();
            $compInfo = UserCompany::with('countryData')->with('cityData')->with('companyType')->with('User')->with('companyType')->with('TypeFunding')->with('industry')->with('sector')->where('userid', '=', $id)->first();

            if (!empty($compInfo)) {
                return view('frontend/User-Company-IntrestedIn')->with('data', @$userData)->with('comInfo', @$compInfo->toArray())->with('expressedInterest', @$investorData->toArray())->with('industryList', $industry->toArray())->with('countryList', $country->toArray())->with('regionList', $regionFocus->toArray())->with('sectorList', $sectors->toArray());
            }

            return redirect('User/addcompanyProfile');
        }

        return back();
    }

    public function userInvestorIntrestedIn($id) {
        if (1 == $this->validUser()) {
            return redirect('User/fundraising');
        }

        $id = $id;
        $userid = Session::get('User.id');

        if ($userid == $id) {
            $userData = User::where('id', '=', $id)->first();
            $type = Session::get('User.usertype');
            $list = InterestedIn::where('following_id', $userid)->pluck('follower_id');
            $companyData = [];

            if (count($list) > 0) {
                $companyData = UserCompany::with('sector')->with('countryData')->with('cityData')->with('industry')->with('companyType')->with('User')->with('TypeFunding')->whereIn('userid', $list)->get();
            }
            $companyDataTem = [];

            if (!empty($companyData)) {
                $companyDataTem = $companyData->toArray();
            }

            $investInfo = UserInvestor::with('countryData')->with('cityData')->with('User')->where('userid', '=', $id)->first();

            if (!empty($investInfo)) {
                return view('frontend/User-Investor-IntrestedIn')->with('data', $userData)->with('comInfo', $investInfo->toArray())->with('compData', $companyDataTem);
            }

            return redirect('User/addinvestorProfile');
        }

        return back();
    }

    public function sendUserMessage() {
        if (1 == $this->checkUser()) {
            return redirect('User/index');
        }

        $inputData = Input::all();
        $reciever_id = $inputData['to'];
        $data = explode(':', $reciever_id);
        $rec_data = $data[0];
        $response = [];

        if (!empty($inputData)) {
            $userid = Session::get('User.id');
            $messageData = new Message();
            $messageData->sender_id = $userid;
            $messageData->message = $inputData['msg'];
            $messageData->subject = $inputData['sub'];
            $messageData->reciever_id = $rec_data;
            $messageData->type = 2;
            $messageData->notify = 1;

            $status = '2';

            $reciver = User::where('id', $rec_data)->first()->toArray();

            if ('yes' == $reciver['message_meeting_approval']) {
                $status = '1';
            }

            $messageData->status = $status;

            if ($messageData->save()) {
                if (isset($inputData['interested'])) {
                    $int = new InterestedIn();
                    $int->follower_id = $userid;
                    $int->following_id = $rec_data;
                    $int->save();
                }

                $sender = User::with('investorDetail')->with('companyDetail')->find($userid)->toArray();

                if ('yes' == $reciver['email_notifications'] && 'yes' == $reciver['message_meeting_approval']) {
                    try {
                        $mailckk = Mail::send(
                            'frontend/email/message',
                            ['sender' => $sender, 'reciver' => $reciver, 'message_contant' => $inputData['msg']],
                            function ($message) use ($sender, $reciver) {
                                $message->to($reciver['email'], $reciver['firstname'].' '.$reciver['lastname'])->subject('New Message - LondCap');
                            }
                        );
                    } catch (\Exception $e) {
                    }
                }

                $response = ['code' => 1, 'msg' => 'Success'];
            } else {
                $response = ['code' => 2, 'msg' => 'Failed'];
            }
        }

        return $response;
    }

    public function getNotification() {
        $id = Session::get('User.id');
        $cnt = 0;

        $user_result = User::where('id', $id)->first();

        if ($user_result) {
            $user = $user_result->toArray();

            if (!empty($id) && (1 != $this->validUser()) && ('yes' == $user['message_meeting_approval'])) {
                $result = Message::where('reciever_id', $id)->where('notify', '1')->count();
                $cnt = $result;
            }
        }

        return $cnt;
    }

    public function MeInterestedIn() {
        $userid = Session::get('User.id');
        $usertype = Session::get('User.usertype');
        $list = InterestedIn::where('follower_id', $userid)->pluck('following_id');
        $cnt = 0;

        if (count($list) > 0) {
            if (1 == $usertype) {
                //me as company search for investors
                $cnt = UserInvestor::whereIn('userid', $list)->count();
            } else {
                //me as investor searchec for company
                $cnt = UserCompany::whereIn('userid', $list)->count();
            }
        }

        return $cnt;
    }

    public function MeExpressedIn() {
        $userid = Session::get('User.id');
        $usertype = Session::get('User.usertype');
        $list = InterestedIn::where('following_id', $userid)->pluck('follower_id');
        $cnt = 0;

        if (count($list) > 0) {
            if (1 == $usertype) {
                //me as company search for investors
                $cnt = UserInvestor::whereIn('userid', $list)->count();
            } else {
                //me as investor searchec for company
                $cnt = UserCompany::whereIn('userid', $list)->count();
            }
        }

        return $cnt;
    }

    public function GetLastMessage($otherId) {
        $userId = Session::get('User.id');

        $m = Message::where(function ($query) use ($userId, $otherId) {
            $query->where('sender_id', $userId)->where('reciever_id', $otherId);
        })->orWhere(function ($query) use ($userId, $otherId) {
            $query->where('reciever_id', $userId)->where('sender_id', $otherId);
            //})->orderBy('created_at', 'desc')->where('status','1')->latest()->first();
        })->orderBy('created_at', 'desc')->latest()->first();

        return json_encode($m);
    }

    public function GetMessageHistory($otherId) {
        $userId = Session::get('User.id');

        Message::where('reciever_id', $userId)
            ->where('sender_id', $otherId)
            ->update(['notify' => 0]);

        $requestMaster = ['1' => 'Meet During Conference', '3' => 'Meet in Investors Office', '2' => 'Conference Call', '4' => 'Meet in Fundraiser Office'];

        $m = Message::where(function ($query) use ($userId, $otherId) {
            $query->where('sender_id', $userId)->where('reciever_id', $otherId);
        })->orWhere(function ($query) use ($userId, $otherId) {
            $query->where('reciever_id', $userId)->where('sender_id', $otherId);
        })->orderBy('created_at', 'asc')->get();

        $sender = User::with('investorDetail')->with('companyDetail')->find($userId)->toArray();
        $reciever = User::with('investorDetail')->with('companyDetail')->find($otherId)->toArray();

        $senderImg = !empty($sender['investor_detail']) ? $sender['investor_detail']['image_name'] : $sender['company_detail']['image_name'];

        $str = '';

        if ('' == $senderImg) {
            $senderImg = '../images/user.png';
        } else {
            $senderImg = '../uploads/images/user.png';
        }

        $my = 'no';
        $my2 = 'no';

        $_msgs = $m->toArray();
        $isLastMy = 'no';

        if (end($_msgs)['sender_id'] == Session::get('User.id')) {
            $isLastMy = 'yes';
        }

        foreach ($_msgs as $key => $value) {
            if ($value['sender_id'] == $userId) {
                $profileImg = !empty($sender['investor_detail']) ? $sender['investor_detail']['image_name'] : $sender['company_detail']['image_name'];
                $name = $sender['firstname'].' '.$sender['lastname'];
            } else {
                if ($value['sender_id'] == $otherId) {
                    $profileImg = !empty($reciever['investor_detail']) ? $reciever['investor_detail']['image_name'] : $reciever['company_detail']['image_name'];
                    $name = $reciever['firstname'].' '.$reciever['lastname'];
                }
            }

            if ('' != $profileImg && false !== @getimagesize('./uploads/images/'.$profileImg)) {
                $profileImg = url('/').'/uploads/images/'.$profileImg;
            } else {
                $profileImg = url('/').'/images/user.png';
            }

            $msg = '';

            if ($value['sender_id'] == Session::get('User.id')) {
                if ('1' == $value['status']) {
                    $status = '<span class="text-success">Approved</span>';
                } else {
                    $status = '<span class="text-danger">Not Approved</span>';
                }

                if ('1' == $value['type']) {
                    $msg .= '<p><b>Meeting Request</b><br>Reserved Amount : '.@$value['reserve_amount'].'<br>Message  : '.@$value['message'].'<br>Meeting Type  : '.$requestMaster[$value['meeting_at']].'</p>';
                } else {
                    $msg .= '<p>'.@$value['message'].'</p>';
                }
            } else {
                if ('1' == $value['type'] && '1' == $value['status']) {
                    if ('1' == $value['status']) {
                        $status = '<span class="text-success">Approved</span>';
                    } else {
                        $status = '<span class="text-danger">Not Approved</span>';
                    }
                    $msg .= '<p><b>Meeting Request</b><br>Reserved Amount : '.@$value['reserve_amount'].'<br>Message  : '.@$value['message'].'<br>Meeting Type  : '.$requestMaster[$value['meeting_at']].'</p>';
                } else {
                    if ('1' == $value['status']) {
                        $msg .= '<p>'.@$value['message'].'</p>';
                    }
                }
            }

            $msg = wordwrap($msg, 50, ' ', true);

            $created_date = date('m/d/Y', strtotime($value['created_at']));

            $today_date = date('m/d/Y');

            if ($created_date != $today_date) {
                $data = $created_date;
            } else {
                $data = '';
            }

            if ($value['sender_id'] != Session::get('User.id')) {
                if ('1' == $value['status']) {
                    $str .= '<tr>';

                    if ('no' === $my2) {
                        $str .= '<td class="avatar">
							<img class="view-message other-user" rel="177391" src="'.$profileImg.'" alt="User">
						</td>';
                    } else {
                        $str .= '<td class="avatar"></td>';
                    }

                    $str .= '<td class="envelope view-message" rel="">';

                    if ('no' === $my2) {
                        $str .= '<a href="javascript:;" class="view-message" rel="">
								<span class="sender">'.$name.'</span>
							</a>';
                    }

                    $str .= $msg;
                    $str .= '</td>';

                    if ('no' === $my2) {
                        $str .= '<td class="meta">
							<span class="timestamp">
								'.$data.'
								'.date('h:i A', strtotime($value['created_at'])).'
							</span>
						</td>';
                    } else {
                        $str .= '<td class="meta"></td>';
                    }

                    $str .= '</tr>';
                    $my2 = 'yes';
                } else {
                    $str .= '';
                    $my2 = 'no';
                }

                $my = 'no';
            } else {
                $str .= '<tr>';

                if ('no' === $my) {
                    $str .= '<td class="avatar">
						<img class="view-message" rel="177391" src="'.$profileImg.'" alt="User">
					</td>';
                } else {
                    $str .= '<td class="avatar"></td>';
                }

                $str .= '<td class="envelope view-message" rel="">';

                if ('no' === $my) {
                    $str .= '<a href="javascript:;" class="view-message" rel="">
							<span class="sender">'.$name.'</span>
						</a>';
                }

                $str .= $msg;

                $str .= ' </td>';

                if ('no' === $my) {
                    $str .= '<td class="meta">
							<span class="timestamp">
								'.$data.'
								'.date('h:i A', strtotime($value['created_at'])).'
							</span>
						</td>';
                } else {
                    $str .= '<td class="meta"></td>';
                }

                $str .= '</tr>';
                $my = 'Yes';
                $my2 = 'no';
            }
        }

        $box = '<tr>
				<!--td class="avatar">
					<img class="view-message" rel="177391" src="'.$senderImg.'" alt="User">
				</td-->
				<td class="envelope view-message" rel="">
					<input type="hidden" name="last_my" value="'.$isLastMy.'" >
					<textarea class="form-control message_box" placeholder="Enter Your Message" name="message_box" rows="2"></textarea>
					<input type="hidden" name="recipient" value="'.$otherId.'">
				</td>
				<td class="meta">
					<div class="signup_btn"><a class="nav-link" href="">Send</a></div>
				</td>
				
			</tr>';

        $resp = ['messages' => $str, 'sendbox' => $box];

        return json_encode($resp);
    }

    public function MessageNew() {
        if (1 == $this->validUser()) {
            return redirect('User/fundraising');
        }

        $userId = Session::get('User.id');

        $list = InterestedIn::where('follower_id', $userId)->orWhere('following_id', $userId)->pluck('following_id', 'follower_id');
        $ul = [];

        foreach ($list as $key => $value) {
            if (!in_array($key, $ul) && $key != $userId) {
                array_push($ul, $key);
            }

            if (!in_array($value, $ul) && $value != $userId) {
                array_push($ul, $value);
            }
        }

        $UserList = User::with('investorDetail')->with('companyDetail')->whereIn('id', $ul)->get();

        return view('frontend/MessageNew')->with('UserList', $UserList->toArray());
    }

    public function postMsg() {
        if (1 == $this->checkUser()) {
            return redirect('User/index');
        }

        if (!$this->checkMsgLimit()) {
            return $response = ['code' => 2, 'msg' => 'msglimit'];
        }

        if (!$this->approve_check()) {
            return $response = ['code' => 2, 'msg' => 'notApproved'];
        }

        $inputData = Input::all();
        $response = [];

        if (!empty($inputData)) {
            $userid = Session::get('User.id');
            $messageData = new Message();
            $messageData->sender_id = $userid;
            $messageData->message = $inputData['message_box'];
            $messageData->reciever_id = $inputData['recipient'];
            $reciver = User::where('id', $inputData['recipient'])->first()->toArray();
            $status = '2';

            if ('yes' == $reciver['message_meeting_approval']) {
                $status = '1';
            }

            $messageData->status = $status;
            $messageData->type = 2;
            $messageData->notify = 1;

            if ($messageData->save()) {
                $res = InterestedIn::where('follower_id', $userid)->where('following_id', $inputData['recipient'])->get();

                if ($res->isEmpty()) {
                    $intList = new InterestedIn();
                    $intList->follower_id = $userid;
                    $intList->following_id = $inputData['recipient'];
                    $intList->save();
                }

                $sender = User::with('investorDetail')->with('companyDetail')->find($userid)->toArray();

                if ('1' == $status && 'yes' == $reciver['email_notifications']) {
                    try {
                        $mailckk = Mail::send(
                            'frontend/email/message',
                            ['sender' => $sender, 'reciver' => $reciver, 'message_contant' => $inputData['message_box']],
                            function ($message) use ($sender, $reciver) {
                                $message->to($reciver['email'], $reciver['firstname'].' '.$reciver['lastname'])->subject('New Message - LondCap');
                            }
                        );
                    } catch (\Exception $e) {
                    }
                }

                $profileImg = !empty($sender['investor_detail']) ? $sender['investor_detail']['image_name'] : $sender['company_detail']['image_name'];

                if (!empty($profileImg) && file_exists('uploads/images/'.$profileImg)) {
                    $profileImg = '../uploads/images/'.$profileImg;
                } else {
                    $profileImg = '../images/user.png';
                }

                $name = $sender['firstname'].' '.$sender['lastname'];
                $last_my = $inputData['last_my'];
                $msg = '<tr>';

                if ('no' == $last_my) {
                    $msg .= '<td class="avatar">
						<img class="view-message" rel="177391" src="'.$profileImg.'" alt="User">
					</td>';
                } else {
                    $msg .= '<td class="avatar"></td>';
                }

                $msg .= '<td class="envelope view-message" rel="">';

                if ('no' == $last_my) {
                    $msg .= '<a href="javascript:;" class="view-message" rel="">
								<span class="sender">'.$name.'</span>
						</a>';
                }

                $msg .= '<p>'.$inputData['message_box'].'</p>';
                $msg .= '</td>';

                if ('no' == $last_my) {
                    $msg .= '<td class="meta">
							<span class="timestamp">
								<!--- '.date('m/d/Y').' -->
								'.date('h:i A').'
							</span>
						</td>';
                } else {
                    $msg .= '<td class="meta"></td>';
                }

                $msg .= '</tr>';
                $response = ['code' => 1, 'msg' => 'Success', 'data' => $msg];
            } else {
                $response = ['code' => 2, 'msg' => 'Failed'];
            }
        }

        return $response;
    }

    public function saveUserHistory($type, $visitId) {
        if (Session::has('User')) {
            $url = (isset($_SERVER['HTTPS']) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http')."://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
            $userid = Session::get('User.id');
            $saveHistory = new UserHistory();
            $saveHistory->userid = $userid;
            $saveHistory->type = $type;
            $saveHistory->visit_id = $visitId;
            $saveHistory->visit_url = $url;
            $saveHistory->save();
        }
    }

    public function getSectorIndustry() {
        $sectorId = $_GET['sector_id'];

        if ('' != $sectorId) {
            $sectors = explode(',', $sectorId);

            if (in_array('0', $sectors)) {
                $data = Industry::get()->toArray();
            } else {
                $dataQuery = DB::table('industries');
                $dataQuery->whereIn('sector', $sectors);
                $data = $dataQuery->get()->toArray();
            }

            print_r(json_encode($data));
        } else {
            print_r(null);
        }
    }

    public function getRegionCountries() {
        $region_id = $_GET['region_id'];

        if ('' != $region_id) {
            $region_ids = explode(',', $region_id);

            if (in_array('0', $region_ids)) {
                $data = countryList::get()->toArray();
            } else {
                $dataQuery = DB::table('country_lists');
                $dataQuery->whereIn('region_id', $region_ids);
                $data = $dataQuery->get()->toArray();
            }

            print_r(json_encode($data));
        } else {
            print_r(null);
        }
    }

    public function pending_reg_popup() {
        ?>
    	<html>
    		<hrad>
    			<link rel="stylesheet" href="<?php echo asset('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.css'); ?>">
    			<script src="<?php echo url('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js'); ?>"></script>
    		</hrad>
    		<body>
    			<script>
			        swal({
			            title: "Your registration is pending to be approved in next 24 hours.",
			            text: "",
			            type: "warning",
			            showCancelButton: false,
			            showConfirmButton : false,
			            confirmButtonColor: "#DD6B55",
			            confirmButtonText: "ok!",
			            },function(){

			        })
			    </script>
    		</body>
    	</html>
    <?php
    }

    /**
     * Create or get a user based on provider id.
     *
     * @param mixed $providerUser
     * @param mixed $provider
     *
     * @return object $user
     */
    private function createOrGetUser($providerUser, $provider) {
        $account = SocialAccount::where('provider', $provider)
            ->where('provider_user_id', $providerUser->getId())
            ->first();

        if ($account) {
            //Return account if found
            return $account->user;
        }

        //Check if user with same email address exist
        $user = User::where('email', $providerUser->getEmail())->first();

        //Create user if dont'exist
        if (!$user) {
            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
            ]);
        }

        //Create social account
        $user->social_accounts()->create([
            'provider_user_id' => $providerUser->getId(),
            'provider' => $provider,
        ]);

        return $user;
    }
}
