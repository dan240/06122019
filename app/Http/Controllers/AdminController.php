<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Validation;
use App\Admin;
use Session;
use App\User;
use App\UserCompany;
use App\InvestorType;
use App\InvestmentType;
use App\Message;
use App\UserProfessional;
use App\UserType;
use App\UserInvestor;
use App\Contact;
use App\TypeCompanies;
use App\TypeFunding;
use App\Industry;
use App\countryList;
use App\CityList;
use App\FundGoalValue;
use App\StaticPage;
use App\PageData;
use App\SectorType;
use App\RegionName;
use App\Report;
use App\Config;
use Excel;
use App\Exports\UsersExport;
use App\Exports\CompanyExport;
use App\Exports\InvestorExport;
use App\Imports\UsersImport;
use App\Imports\CompanyImport;
use App\Imports\InvestorImport;
use App\UserHistory;
use Mail;
use Illuminate\Support\Facades\Redirect;
//use Maatwebsite\Excel\Facades\Excel;




class AdminController extends Controller
{

    public function checkLogin()
    {
        if(!Session::has('Admin')){
            return 1;
        }
    }
    public function index()
    {
        return view('backend/login');
    }
    public function adminLogin(){
        $inputData = Input::all();
        $reponse = array();
        if(!empty($inputData)){
            $rules = array(
                'username'=>'required',
                'password'=>'required',
            );
            $validator = Validator::make($inputData, $rules);
            if($validator->fails()){
                $errors = $validator->getMessageBag()->toArray();
                $erMsg ="";
                foreach($errors as $error){
                    $erMsg .= $error[0]."<br> ";
                }
                $response = array('code' => 2, 'msg' => $erMsg);
            }else{
                $inputData['username'] = strtolower($inputData['username']);
                $ckkLogin = Admin::where('username', $inputData['username'])->where('password', md5($inputData['password']))->first();
                $userId = $ckkLogin['id'];
                if(empty($ckkLogin)){
                    $response = array('code' => 2, 'msg' => 'Username or password is incorrect');
                }else{
                    Session::put('Admin',$ckkLogin->toArray());
                    $response = array('code' => 1, 'msg' => 'success', 'data'=>$ckkLogin);
                }
            }
        }
        return $response;       
    }
    public function dashboard()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $CompanyUser = User::where('userType',1)->where('status','!=',2)->count();
        $InvestorUser = User::where('userType',2)->where('status','!=',2)->count();
        $prof = User::where('is_Professional','1')->where('status','!=',2)->count();
        $unprof = User::where('is_Professional','0')->where('status','!=',2)->count();
        $c_pending = UserCompany::where('is_Public','0')->count();
        $i_pending = UserInvestor::where('is_Public','0')->count();
        $pending = $c_pending + $i_pending;
        return view('backend/dashboard')
                ->with('c_user',$CompanyUser)
                ->with('i_user',$InvestorUser)
                ->with('prof',$prof)
                ->with('unprof',$unprof)
                ->with('pending',$pending);
    }
    public function User()
    {
        
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }

        $que = User::with('UserProfessional')->with('UserType')->where('status','!=',2);
        
            if (isset($_GET['u'])) {
                $que->where('usertype','=',$_GET['u']);
            }
            if (isset($_GET['t'])) {
                $que->where('is_Professional','=',$_GET['t']);
            }
            if (isset($_GET['p'])) {
                $que->whereHas('investorDetail', function ($query) {
                    $query->where('is_Public', $_GET['p']);
                });
                $que->orWhereHas('companyDetail', function ($query) {
                    $query->where('is_Public', $_GET['p']);
                });
            }
            $que->with('investorDetail')->with('companyDetail');
        $userData =$que->get();
        
        
        
        //echo"<pre>";print_r($userData->toArray()); exit;
        
        foreach ($userData->toArray() as $user) {
                
            $user['visit_count'] = UserHistory::where('userid',$user['id'])->count();
            $user['msg_sent'] = Message::where('sender_id',$user['id'])->where('type','2')->count();
            $user['meeting_req'] = Message::where('sender_id',$user['id'])->where('type','1')->count();
            $userData1[] = $user;
        }
        
        return view('backend/user')->with('data',@$userData1);

    }
    public function logout()
    {
        Session::flush();
        return redirect('Admin/index');
    }

    // function to do user inactive

    public function InactiveUser()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $response = array();
        $inputData = Input::all();
        $id = $inputData['id'];
        $userData = User::where('id',$id)->first();
        $data = $userData->toArray();
        $utype = $data['usertype'];
        if($utype==1){
            $userInfo = User::find($id);
            $userInfo->status = 3;
            $userInfo->save();
            $companyInfo = UserCompany::where('userid',$id)->update(['is_Public' => 2]);
            $checkInfo = UserCompany::where('userid',$id)->where('is_Public','=',2)->first();
            if(!empty($checkInfo))
            {
                $response = array('code'=>1, 'msg'=>'success');
            }else{
                $response = array('code'=>1, 'msg'=>'failed');
            }
        }else if($utype==2){
            $userInfo = User::find($id);
            $userInfo->status = 3;
            $userInfo->save();
            $userData = UserInvestor::where('userid',$id)->update(['is_Public' => 2]);
            $checkInfo = UserInvestor::where('userid',$id)->where('is_Public','=',2)->first();
            if(!empty($checkInfo))
            {
                $response = array('code'=>1, 'msg'=>'success');
            }else{
                $response = array('code'=>1, 'msg'=>'failed');
            }
        }
        return $response;
    }
    // function to approve user profile for public search
    public function ApprovedProfile()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $response = array();
        $inputData = Input::all();
        $id = $inputData['id'];
        $userData = User::where('id',$id)->first();
        $data = $userData->toArray();
        $utype = $data['usertype'];
        if($utype==1){
            $userInfo = User::find($id);
            $userInfo->status = 1;
            $userInfo->save();
            $companyInfo = UserCompany::where('userid',$id)->update(['is_Public' => 1]);
                $response = array('code'=>1, 'msg'=>'success');
        }else if($utype==2){
            $userInfo = User::find($id);
            $userInfo->status = 1;
            $userInfo->save();
            $userData = UserInvestor::where('userid',$id)->update(['is_Public' => 1]);
                $response = array('code'=>1, 'msg'=>'success');
        }
        return $response;
    }

    // function to view users meeting request
    public function viewMeetings()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $userData = Message::with('sender')->with('reciever')->get();
        return view('backend/meeting_lists')->with('data',$userData);
    }
    public function DeleteUser()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $inputData = Input::all();
        $response = array();
        $id = $inputData['id'];
        if(!empty($inputData))
        {
            $userData = User::where('id',$id)->first();
            $data = $userData->toArray();
            $utype = $data['usertype'];
            if($utype==1){
                $userInfo = User::find($id);
                $userInfo->status = 2;
                $userInfo->save();
                $companyInfo = UserCompany::where('userid',$id)->update(['is_Public' => 2]);
                    $response = array('code'=>1, 'msg'=>'success');
            }else if($utype==2){
                $userInfo = User::find($id);
                $userInfo->status = 2;
                $userInfo->save();
                $userData = UserInvestor::where('userid',$id)->update(['is_Public' => 2]);
                    $response = array('code'=>1, 'msg'=>'success');
            }
        }
        return $response;
    }

    // function to get data from contact us form
    public function contactus()
    {
        $contactusData = Contact::get();
        return view('backend/contactus')->with('data',$contactusData);
    }
    public function report()
    {
        
        $contactusData = Report::with('user')
            ->with('investorDetail')
            ->with('investorDetail')
            ->with('companyDetail')

            ->get();
        return view('backend/report')->with('data',$contactusData->toArray());
    }

    // function to delete contact message
    public function deleteContactMessage()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $inputData = Input::all();
        $response = array();
        $id = $inputData['id'];
        $msgData = Contact::findOrFail($id);
        if($msgData->delete())
        {
            $response = array('code'=>1, 'msg'=>'success');
        }else{
            $response = array('code'=>2, 'msg'=>'failed');
        }
        return $response;

    }

    public function deleteReportAbuse()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $inputData = Input::all();
        $response = array();
        $id = $inputData['id'];
        $reportData = Report::findOrFail($id);
        if($reportData->delete())
        {
            $response = array('code'=>1, 'msg'=>'success');
        }else{
            $response = array('code'=>2, 'msg'=>'failed');
        }
        return $response;

    }

    // function to view message
    public function viewContactMessage($id)
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $id=$id;
        $msgData = Contact::where('id',$id)->first();
        return view('backend/viewContactMessage')->with('data',$msgData);
    }
    public function editUser($id)
    {
        /*if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }*/
        $inputData = Input::all();
        $response = array();
        $id = $id;
        $userInfo = User::where('id',$id)->first();
        $InvestorType = InvestorType::where('status', 1)->get();
        $InvestmentType = InvestmentType::where('status', 1)->get();
        $stype = SectorType::get();
        $city = CityList::orderBy('city_name','ASC')->get();
        $industry = Industry::orderBy('industryName','ASC')->get();
        $country = countryList::orderBy('country_name','ASC')->get();
        $regionFocus = RegionName::orderBy('regionName','ASC')->get();
        $cType = TypeCompanies::where('status',1)->get();
        $tFunding = TypeFunding::where('status',1)->get();
        if(!empty($userInfo) && @$userInfo['usertype']==2){
            
            $investorData = UserInvestor::with('regionFocus')
                            ->with('countryData')
                            ->with('cityData')
                            ->with('User')
                            ->with('investorType')
                            ->with('investmentType')
                            ->with('sectorType')
                            ->with('industry')
                            ->where('userid',$id)
                            ->where('status',1)
                            ->first();
            return view('backend/updateUserData')
                ->with('data',$userInfo)
                ->with('InvestorData',$investorData->toArray())
                ->with('investor',@$InvestorType)
                ->with('investment',@$InvestmentType)
                ->with('sector',@$stype)
                ->with('industry',@$industry)
                ->with('country',@$country)
                ->with('city',$city)
                ->with('region',$regionFocus);
                
        }else if(!empty($userInfo) && @$userInfo['usertype']==1){

            $companyData = UserCompany::with('countryData')
                            ->with('cityData')
                            ->with('User')
                            //->with('industry')
                            ->where('userid',$id)
                            //->where('status',1)
                            ->first();

            if(empty($companyData)){
                $companyData = null;
            }else{
                $companyData = $companyData->toArray();
            }
            
            return view('backend/updateUserData')
                ->with('data',$userInfo)
                ->with('CompanyData',$companyData)
                ->with('stype',@$stype)
                ->with('industry',@$industry)
                ->with('country',@$country)
                ->with('city',$city)
                ->with('ctype', $cType)
                ->with('tfunding',$tFunding);
        }
    }
    public function SaveUser()
    {
        $inputData = Input::all();
        $response = array();

        if($inputData['userType'] == '1'){
            // company user update
            $id = $inputData['id'];
            $firstname = $inputData['firstname'];
            $lastname = $inputData['lastname'];
            $email = $inputData['email'];
            $userData = User::find($id);
            $userData->firstname = $firstname;
            $userData->lastname =  $lastname;
            //$userData->email =  $email;

            if(!$userData->save()){
                return $response = array('code'=>2,'msg'=>'failed');
            }
            $jobTitle = $inputData['jobTitle'];
            $companyName = $inputData['companyName'];
            $phone = $inputData['phone'];
            $country = $inputData['country'];
            $city = $inputData['city'];
            $cp_url = $inputData['cp_url'];
            $fr_url = $inputData['fr_url'];
            
            $sd_url = $inputData['sd_url'];
            $c_tagline = $inputData['c_tagline'];
            $cp_text = $inputData['cp_text'];
            $personalBio = $inputData['personalBio'];
            
            $cp_type = implode(',',$inputData['cp_type']);
            $fd_type = implode(',',$inputData['fd_type']);
            $sector = implode(',',$inputData['sector']);
            $industry = implode(',',$inputData['industry']);
            
            $amt_raised = $inputData['amt_raised'];
            $fd_goal = $inputData['fd_goal'];
            $min_reserve = $inputData['min_reserve'];
            $max_reserve = $inputData['max_reserve'];
            $equity = $inputData['equity'];
            $open_date = $inputData['open_date'];
            $close_date = $inputData['close_date'];
            $fv_url = $inputData['fv_url'];

            $linkedinUrl  = $inputData['linkedinUrl'];
            $fbUrl = $inputData['fbUrl'];
            $twitterUrl = $inputData['twitterUrl'];


            $UserCompanyUpdate = UserCompany::where('userid',$id);

            $UserCompany['fname'] = $firstname;
            $UserCompany['lname'] = $lastname;
            $UserCompany['email'] = $email;

           


            $UserCompany['phoneno'] = $phone;
            $UserCompany['jobTitle'] = $jobTitle;
            $UserCompany['country'] = $country;
            $UserCompany['city'] = $city;
            $UserCompany['companyUrl'] = $cp_url;
            $UserCompany['fundraisUrl'] = $fr_url;
            
            $UserCompany['linkedinUrl'] = $linkedinUrl;
            $UserCompany['fbUrl'] = $fbUrl;
            $UserCompany['twitterUrl'] = $twitterUrl;
            
            $UserCompany['slideshareUrl'] = $sd_url;
            $UserCompany['investorFirmvideo'] = $fv_url;
            $UserCompany['companyTagline'] = $c_tagline;
            $UserCompany['profileText'] = $cp_text;
            $UserCompany['personalBio'] = $personalBio;
            $UserCompany['companyName'] = $companyName;
            $UserCompany['companyType'] = $cp_type;
            $UserCompany['fundingType'] = $fd_type;
            $UserCompany['industry'] = $industry;
            $UserCompany['sector'] = $sector;
            $UserCompany['ammountRaised'] = $amt_raised;
            $UserCompany['fundingGoal'] = $fd_goal;
            $UserCompany['minReservation'] = $min_reserve;
            $UserCompany['maxReservation'] = $max_reserve;
            $UserCompany['equity'] = $equity;
            $UserCompany['openDate'] = $open_date;
            $UserCompany['closingDate'] = $close_date;


            if(!$UserCompanyUpdate->update($UserCompany)){
                return $response = array('code'=>2,'msg'=>'failed');
            }else{
                return $response = array('code'=>1,'msg'=>'success');
            }
            return $response = array('code'=>2,'msg'=>'failed');

        }else if($inputData['userType'] == '2'){



                $id = $inputData['id'];
                
                $firstname = $inputData['firstname'];
                $lastname = $inputData['lastname'];
                $email = $inputData['email'];


                $userData = User::find($id);
                $userData->firstname = $firstname;
                $userData->lastname =  $lastname;
                //$userData->email =  $email;

                if(!$userData->save()){
                    return $response = array('code'=>2,'msg'=>'failed');
                }

                $phone = $inputData['phone'];
                $jobTitle = $inputData['jobTitle'];
                $firm_name = $inputData['firm_name'];
                $country = $inputData['country'];
                $city = $inputData['city'];
                $firm_url = $inputData['firm_url'] ;
                $fundraising_url = $inputData['fundraising_url'] ;
                $firm_video = $inputData['firm_video'];
                $slideshare_url = $inputData['slideshare_url'] ;
                $investorType = implode(',',$inputData['investorType']);
                $investmentType = implode(',',$inputData['investmentType']);
                $sectorFocus = implode(',',$inputData['sectorFocus']);
                $industryFocus = implode(',',$inputData['industryFocus']);
                $regionFocus = implode(',',$inputData['regionFocus']);
                $countryFocus = implode(',',$inputData['countryFocus']);
                $assets = $inputData['assets'];
                $range_from = $inputData['range_from'];
                $range_to = $inputData['range_to'];
                $firm_tagline = $inputData['firm_tagline'];
                $firm_profile = $inputData['firm_profile'];
                $bio_data = $inputData['bio_data'];
                $linkedin = $inputData['linkedin'];
                $facebook = $inputData['facebook'];
                $twitter = $inputData['twitter'];

                $UserInvestorUpdate = UserInvestor::where('userid',$id);


                    $UserInvestor['firstname'] = $firstname;
                    $UserInvestor['lastname'] = $lastname;
                    $UserInvestor['email'] = $email;
                    $UserInvestor['phoneno'] = $phone;
                    $UserInvestor['firmName'] = $firm_name;
                    $UserInvestor['firmTagline'] = $firm_tagline;
                    $UserInvestor['profileText'] = $bio_data;
                    $UserInvestor['jobTitle'] = $jobTitle;
                    $UserInvestor['country'] = $country;
                    $UserInvestor['city'] = $city;
                    $UserInvestor['investorfirmUrl'] = $firm_url;
                    $UserInvestor['linkedinUrl'] = $linkedin;
                    $UserInvestor['fbUrl'] = $facebook;
                    $UserInvestor['twitterUrl'] = $twitter;
                    $UserInvestor['slideshareUrl'] = $slideshare_url;
                    $UserInvestor['investorFirmvideo'] = $firm_video;
                    $UserInvestor['investorType'] = $investorType;
                    $UserInvestor['investmentType'] = $investmentType;
                    $UserInvestor['sectorFocus'] = $sectorFocus;
                    $UserInvestor['industryFocus'] = $industryFocus;
                    $UserInvestor['regionFocus'] = $regionFocus;
                    $UserInvestor['countryFocus'] = $countryFocus;
                    $UserInvestor['investmentRangefrm'] = $range_from;
                    $UserInvestor['investmentRangeto'] = $range_to;

                    

                if(!$UserInvestorUpdate->update($UserInvestor)){

                    return $response = array('code'=>2,'msg'=>'failed');
                }else{
                    return $response = array('code'=>1,'msg'=>'success');
                }
                return $response = array('code'=>2,'msg'=>'failed');



        }else{
            $response = array('code'=>1,'msg'=>'success');
        }
        return $response;

        // if($inputData){
        //     $id = $inputData['id'];
        //     $userData = User::find($id);
        //     $userData->firstname = $inputData['firstname'];
        //     $userData->lastname =  $inputData['lastname'];
        //     $userData->email =  $inputData['email'];
        //     $userData->location =  $inputData['location'];
            
        //     if($userData->save()){
        //         $response = array('code'=>1,'msg'=>'success');
        //     }else{
        //         $response = array('code'=>2,'msg'=>'failed');
        //     }
        // }
        // return $response;
    }
    public function addUserForm(){

        $InvestorType = InvestorType::where('status', 1)->get();
        $InvestmentType = InvestmentType::where('status', 1)->get();
        $stype = SectorType::get();
        $city = CityList::orderBy('city_name','ASC')->get();
        $industry = Industry::orderBy('industryName','ASC')->get();
        $country = countryList::orderBy('country_name','ASC')->get();
        $regionFocus = RegionName::orderBy('regionName','ASC')->get();
        $cType = TypeCompanies::where('status',1)->get();
        $tFunding = TypeFunding::where('status',1)->get();

        return view('backend/addUser')
                ->with('investor',@$InvestorType)
                ->with('investment',@$InvestmentType)
                ->with('sector',@$stype)
                ->with('stype',@$stype)
                ->with('industry',@$industry)
                ->with('country',@$country)
                ->with('city',$city)
                ->with('region',$regionFocus)
                ->with('ctype', $cType)
                ->with('tfunding',$tFunding);;
    }
    public function addNewUser()
    {
        /*if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }*/
        $inputData = Input::all();
        $response = array();

        if($inputData['userType'] == 1){
            /////// add company
            $isUser = User::where('email','=',$inputData['email'])->first();

            if(empty($isUser)){
                if(!empty($inputData)) {

                    $password = $inputData['password'];
                    $c_password = $inputData['c_password'];

                    if($password !== $c_password ){
                        $response = array('code'=>2,'msg'=>'Password not matching');
                    }else{

                        $userInput = new User();
                        $userInput->firstname = $inputData['firstname'];
                        $userInput->lastname = $inputData['lastname'];
                        $userInput->email = $inputData['email'];
                        $userInput->password = md5($inputData['password']);
                        $userInput->usertype = $inputData['userType'];
                        $userInput->status = 3;
                        $userInput->activation = null;

                        if(!$userInput->save()){
                            $response = array('code'=>1,'msg'=>'success');
                        }

                        $firstname = $inputData['firstname'];
                        $lastname = $inputData['lastname'];
                        $email = $inputData['email'];


                        $jobTitle = $inputData['jobTitle'];
                        $companyName = $inputData['companyName'];
                        $phone = $inputData['phone'];
                        $country = $inputData['country'];
                        $city = $inputData['city'];
                        $cp_url = $inputData['cp_url'];
                        $fr_url = $inputData['fr_url'];
                        
                        $sd_url = $inputData['sd_url'];
                        $c_tagline = $inputData['c_tagline'];
                        $cp_text = $inputData['cp_text'];
                        $personalBio = $inputData['personalBio'];
                        
                        $cp_type = null;
                        $fd_type = null;
                        $sector = null;
                        $industry = null;

                        if(isset($inputData['cp_type'])){
                            $cp_type = implode(',',$inputData['cp_type']);
                        }
                        if(isset($inputData['fd_type'])){
                            $fd_type = implode(',',$inputData['fd_type']);
                        }
                        if(isset($inputData['sector'])){
                            $sector = implode(',',$inputData['sector']);
                        }
                        if(isset($inputData['industry'])){
                            $industry = implode(',',$inputData['industry']);
                        }
                        
                        
                        
                        
                        
                        $amt_raised = $inputData['amt_raised'];
                        $fd_goal = $inputData['fd_goal'];
                        $min_reserve = $inputData['min_reserve'];
                        $max_reserve = $inputData['max_reserve'];
                        $equity = $inputData['equity'];
                        $open_date = $inputData['open_date'];
                        $close_date = $inputData['close_date'];
                        $fv_url = $inputData['fv_url'];

                        $linkedinUrl  = $inputData['linkedinUrl'];
                        $fbUrl = $inputData['fbUrl'];
                        $twitterUrl = $inputData['twitterUrl'];


                        $UserCompany = new UserCompany();
                        
                        $UserCompany->userid = $userInput->id;

                        $UserCompany->fname = $firstname;
                        $UserCompany->lname = $lastname;
                        $UserCompany->email = $email;

                        $UserCompany->phoneno = $phone;
                        $UserCompany->jobTitle = $jobTitle;
                        $UserCompany->country = $country;
                        $UserCompany->city = $city;
                        $UserCompany->companyUrl = $cp_url;
                        $UserCompany->fundraisUrl = $fr_url;
                        
                        $UserCompany->linkedinUrl = $linkedinUrl;
                        $UserCompany->fbUrl = $fbUrl;
                        $UserCompany->twitterUrl = $twitterUrl;
                        
                        $UserCompany->slideshareUrl = $sd_url;
                        $UserCompany->investorFirmvideo = $fv_url;
                        $UserCompany->companyTagline = $c_tagline;
                        $UserCompany->profileText = $cp_text;
                        $UserCompany->personalBio = $personalBio;
                        $UserCompany->companyName = $companyName;
                        $UserCompany->companyType = $cp_type;
                        $UserCompany->fundingType = $fd_type;
                        $UserCompany->industry = $industry;
                        $UserCompany->sector = $sector;
                        $UserCompany->ammountRaised = $amt_raised;
                        $UserCompany->fundingGoal = $fd_goal;
                        $UserCompany->minReservation = $min_reserve;
                        $UserCompany->maxReservation = $max_reserve;
                        $UserCompany->equity = $equity;
                        $UserCompany->openDate = $open_date;
                        $UserCompany->closingDate = $close_date;
                        $UserCompany->is_Public = '1';
                        $UserCompany->status = '1';


                        if(!$UserCompany->save()){
                             $response = array('code'=>2,'msg'=>'failed');
                        }else{
                             $response = array('code'=>1,'msg'=>'success');
                        }
                         
                    }
                }            
            }else{
                $response = array('code'=>3,'msg'=>'Email already registered');
            }
            return $response;

        }else if($inputData['userType'] == 2){
            /////  add investor

            $isUser = User::where('email','=',$inputData['email'])->first();

            if(empty($isUser)){
                if(!empty($inputData)) {

                    $userInput = new User();
                    $userInput->firstname = $inputData['firstname'];
                    $userInput->lastname = $inputData['lastname'];
                    $userInput->email = $inputData['email'];
                    $userInput->password = md5($inputData['password']);
                    $userInput->usertype = $inputData['userType'];
                    $userInput->status = 3;
                    $userInput->activation = null;

                    if(!$userInput->save()){
                        $response = array('code'=>1,'msg'=>'success');
                    }

                    $firstname = $inputData['firstname'];
                    $lastname = $inputData['lastname'];
                    $email = $inputData['email'];


                    $phone = $inputData['phone'];
                    $jobTitle = $inputData['jobTitle'];
                    $firm_name = $inputData['firm_name'];
                    $country = $inputData['country'];
                    $city = $inputData['city'];
                    $firm_url = $inputData['firm_url'] ;
                    $fundraising_url = $inputData['fundraising_url'] ;
                    $firm_video = $inputData['firm_video'];
                    $slideshare_url = $inputData['slideshare_url'] ;
                    $investorType = null;
                    $investmentType = null;
                    $sectorFocus = null;
                    $industryFocus = null;
                    $regionFocus = null;
                    $countryFocus = null;
                    if (isset($inputData['investorType'])) {
                        $investorType = implode(',',$inputData['investorType']);
                    }
                    if (isset($inputData['investmentType'])) {
                        $investmentType = implode(',',$inputData['investmentType']);
                    }
                    if (isset($inputData['sectorFocus'])) {
                        $sectorFocus = implode(',',$inputData['sectorFocus']);
                    }
                    if (isset($inputData['industryFocus'])) {
                        $industryFocus = implode(',',$inputData['industryFocus']);
                    }
                    if (isset($inputData['regionFocus'])) {
                        $regionFocus = implode(',',$inputData['regionFocus']);
                    }
                    if (isset($inputData['countryFocus'])) {
                        $countryFocus = implode(',',$inputData['countryFocus']);
                    }
                    


                    $assets = $inputData['assets'];
                    $range_from = $inputData['range_from'];
                    $range_to = $inputData['range_to'];
                    $firm_tagline = $inputData['firm_tagline'];
                    $firm_profile = $inputData['firm_profile'];
                    $bio_data = $inputData['bio_data'];
                    $linkedin = $inputData['linkedin'];
                    $facebook = $inputData['facebook'];
                    $twitter = $inputData['twitter'];

                    $UserInvestor = new UserInvestor();

                    $UserInvestor->userid = $userInput->id;


                    $UserInvestor->firstname = $firstname;
                    $UserInvestor->lastname = $lastname;
                    $UserInvestor->email = $email;
                    $UserInvestor->phoneno = $phone;
                    $UserInvestor->firmName = $firm_name;
                    $UserInvestor->firmTagline = $firm_tagline;
                    $UserInvestor->profileText = $bio_data;
                    $UserInvestor->jobTitle = $jobTitle;
                    $UserInvestor->country = $country;
                    $UserInvestor->city = $city;
                    $UserInvestor->investorfirmUrl = $firm_url;
                    $UserInvestor->linkedinUrl = $linkedin;
                    $UserInvestor->fbUrl = $facebook;
                    $UserInvestor->twitterUrl = $twitter;
                    $UserInvestor->slideshareUrl = $slideshare_url;
                    $UserInvestor->investorFirmvideo = $firm_video;
                    $UserInvestor->investorType = $investorType;
                    $UserInvestor->investmentType = $investmentType;
                    $UserInvestor->sectorFocus = $sectorFocus;
                    $UserInvestor->industryFocus = $industryFocus;
                    $UserInvestor->regionFocus = $regionFocus;
                    $UserInvestor->countryFocus = $countryFocus;
                    $UserInvestor->investmentRangefrm = $range_from;
                    $UserInvestor->investmentRangeto = $range_to;
                    $UserInvestor->status = '1';
                    $UserInvestor->isPublished = '1';
                    
                        

                    if(!$UserInvestor->save()){

                         $response = array('code'=>2,'msg'=>'failed');
                    }else{
                         $response = array('code'=>1,'msg'=>'success');
                    }
                    
                }
            }else{
                $response = array('code'=>3,'msg'=>'Email already registered');
            }
            return $response;
        }
    }
    
    public function ApprovedMeeting()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $inputData = Input::all();
        $response = array();
        $id = $inputData['id'];
        if(!empty($inputData))
        {
            Message::where('id','=',$id)->update(['status' => "1"]);
                $response= array('code'=>1, 'msg'=>'success');
        }
        return $response;
    }

    public function approveAllMeetings()
    {
        $response = array();
        $meetingData = Message::where('type','1')->update(['status' => '1']);
        $response = array('code'=>1,'msg'=>'success');
        return $response;
    }

    public function InactiveMeeting()
    {
        $inputData = Input::all();
        $response = array();
        $id = $inputData['id'];
        $meetingData = Message::find($id);
        $meetingData->status=2;
        if($meetingData->save())
        {
            $response = array('code'=>'1','msg'=>'success');
        }else{
            $response = array('code'=>'2','msg'=>'failed');
        }
        return $response;
    }
    //function to load companytype form
    public function AddCompanyTypeForm()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        return view('backend/AddCompanyTypeForm');        
    }

    public function AddCompanyType()
    {
        /*print_r($inputData); exit;*/
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $companyData = new TypeCompanies();
            $companyData->typeCompanies = $inputData['typeCompanies'];
            $companyData->status = $inputData['status'];
            if($companyData->save())
            {
                $response= array('code'=>1, 'msg'=>'success');
            } else{
                $response = array('code'=>2,'msg'=>'failed');
            }
        }
        return $response;
        
    }

    public function viewCompanyType()
    {
        $companyData = TypeCompanies::where('status',1)->get();
        return view('backend/typeCompanies')->with('data',$companyData);

    }
    public function EditCompanyType($id)
    {
        $id = base64_decode($id);
        $CompanyTypeData = TypeCompanies::where('id','=',$id)->first();
        /*print_r($CompanyTypeData->toArray()); exit;*/
        return view('backend/EditCompanyType')->with('data',$CompanyTypeData);

    }
    public function DeleteCompanyType()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = base64_decode($inputData['id']);
            $CompanyData = TypeCompanies::find($id);
            $CompanyData->status = 2;
            if($CompanyData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>1,'msg'=>'failed');
            }
        }
        return $response;
    }
    // function to save edited company type
    public function SaveCompanyType()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = $inputData['id'];
            $companyData = TypeCompanies::find($id);
            $companyData->typeCompanies = $inputData['companytype'];
            if($companyData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }
        }
        return $response;
    }

    // function to view funding type search category
    public function viewFundingType()
    {
        $fundingData = TypeFunding::where('status','=',1)->get();
        /*print_r($fundingData->toArray()); exit;*/
        return view('backend/viewFundingType')->with('data',$fundingData);
    }
    // fundtion to add new funding type form 
    public function AddFundingTypeForm()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        return view('backend/AddFundingTypeForm');        
    }

    // add funding type 
    public function AddFundingType()
    {
        /*print_r($inputData); exit;*/
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $companyData = new TypeFunding();
            $companyData->typefunding = $inputData['typeFunding'];
            $companyData->status = $inputData['status'];
            if($companyData->save())
            {
                $response= array('code'=>1, 'msg'=>'success');
            } else{
                $response = array('code'=>2,'msg'=>'failed');
            }
        }
        return $response;
        
    }

    // function to delete funding type
    public function DeleteFundingType()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = base64_decode($inputData['id']);
            $CompanyData = TypeFunding::find($id);
            $CompanyData->status = 2;
            if($CompanyData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>1,'msg'=>'failed');
            }
        }
        return $response;
    }
    // function to edit Funding Type

    public function EditFundingType($id)
    {
        $id = base64_decode($id);
        $FundingTypeData = TypeFunding::where('id','=',$id)->first();
        /*print_r($CompanyTypeData->toArray()); exit;*/
        return view('backend/EditFundingType')->with('data',$FundingTypeData);
    }

    // function to save edited company type
    public function SaveFundingType()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = $inputData['id'];
            $fundingData = TypeFunding::find($id);
            $fundingData->typeFunding = $inputData['fundingtype'];
            if($fundingData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }
        }
        return $response;
    }

        // function to view funding type search category
    public function viewIndustryType()
    {
        $industryData = Industry::where('status','=',1)->get();
        /*print_r($fundingData->toArray()); exit;*/
        return view('backend/viewIndustryType')->with('data',$industryData);
    }
    // fundtion to add new funding type form 
    public function AddIndustryTypeForm()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        return view('backend/AddIndustryTypeForm');        
    }

    // add funding type 
    public function AddIndustryType()
    {
        /*print_r($inputData); exit;*/
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $companyData = new Industry();
            $companyData->industryName = $inputData['industrytype'];
            $companyData->status = $inputData['status'];
            if($companyData->save())
            {
                $response= array('code'=>1, 'msg'=>'success');
            } else{
                $response = array('code'=>2,'msg'=>'failed');
            }
        }
        return $response;
        
    }

    // function to delete funding type
    public function DeleteIndustryType()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = base64_decode($inputData['id']);
            $industryData = Industry::find($id);
            $industryData->status = 2;
            if($industryData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>1,'msg'=>'failed');
            }
        }
        return $response;
    }
    // function to edit Funding Type

    public function EditIndustryType($id)
    {
        $id = base64_decode($id);
        $industryTypeData = Industry::where('id','=',$id)->first();
        /*print_r($CompanyTypeData->toArray()); exit;*/
        return view('backend/EditIndustryType')->with('data',$industryTypeData);
    }

    // function to save edited company type
    public function SaveIndustryType()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = $inputData['id'];
            $industryData = Industry::find($id);
            $industryData->industryName = $inputData['industrytype'];
            if($industryData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }
        }
        return $response;
    }


    // function to view Country search category
    public function viewCountry()
    {
        $countryData = countryList::where('status','=',1)->get();
        return view('backend/viewCountry')->with('data',$countryData);
    }
    // fundtion to add new Country form 
    public function AddCountryForm()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        return view('backend/AddCountryForm');        
    }

    // add Country 
    public function AddCountry()
    {
        /*print_r($inputData); exit;*/
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $countryData = new countryList();
            $countryData->country_name = $inputData['country_name'];
            $countryData->status = $inputData['status'];
            if($countryData->save())
            {
                $response= array('code'=>1, 'msg'=>'success');
            } else{
                $response = array('code'=>2,'msg'=>'failed');
            }
        }
        return $response;
        
    }

    // function to delete Country
    public function DeleteCountry()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = base64_decode($inputData['id']);
            $countryData = countryList::find($id);
            $countryData->status = 2;
            if($countryData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>1,'msg'=>'failed');
            }
        }
        return $response;
    }
    // function to edit Country

    public function EditCountry($id)
    {
        $id = base64_decode($id);
        $countryData = countryList::where('id','=',$id)->first();
        return view('backend/EditCountry')->with('data',$countryData);
    }

    // function to save edited country type
    public function SaveCountry()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = $inputData['id'];
            $countryData = countryList::find($id);
            $countryData->country_name = $inputData['country_name'];
            if($countryData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }
        }
        return $response;
    }

    // function to view InvestorType search category
    public function viewInvestorType()
    {
        $countryData = InvestorType::where('status','=',1)->get();
        return view('backend/viewInvestorType')->with('data',$countryData);
    }
    // fundtion to add new InvestorType form 
    public function AddInvestorTypeForm()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        return view('backend/AddInvestorTypeForm');        
    }

    // add InvestorType 
    public function AddInvestorType()
    {
        /*print_r($inputData); exit;*/
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $investorData = new InvestorType();
            $investorData->typeInvestor = $inputData['typeInvestor'];
            $investorData->status = $inputData['status'];
            if($investorData->save())
            {
                $response= array('code'=>1, 'msg'=>'success');
            } else{
                $response = array('code'=>2,'msg'=>'failed');
            }
        }
        return $response;
        
    }

    // function to delete InvestorType
    public function DeleteInvestorType()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = base64_decode($inputData['id']);
            $investorData = InvestorType::find($id);
            $investorData->status = 2;
            if($investorData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>1,'msg'=>'failed');
            }
        }
        return $response;
    }
    // function to edit InvestorType

    public function EditInvestorType($id)
    {
        $id = base64_decode($id);
        $investorData = InvestorType::where('id','=',$id)->first();
        return view('backend/EditInvestorType')->with('data',$investorData);
    }

    // function to save edited InvestorType
    public function SaveInvestorType()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = $inputData['id'];
            $investorData = InvestorType::find($id);
            $investorData->typeInvestor = $inputData['typeInvestor'];
            if($investorData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }
        }
        return $response;
    }

    // function to view InvestmentType search category
    public function viewInvestmentType()
    {
        $investmentData = InvestmentType::where('status','=',1)->get();
        return view('backend/viewInvestmentType')->with('data',$investmentData);
    }
    // fundtion to add new InvestmentType form 
    public function AddInvestmentTypeForm()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        return view('backend/AddInvestmentTypeForm');        
    }

    // add InvestorType 
    public function AddInvestmentType()
    {
        /*print_r($inputData); exit;*/
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $investmentData = new InvestmentType();
            $investmentData->typeInvestment = $inputData['typeInvestment'];
            $investmentData->status = $inputData['status'];
            if($investmentData->save())
            {
                $response= array('code'=>1, 'msg'=>'success');
            } else{
                $response = array('code'=>2,'msg'=>'failed');
            }
        }
        return $response;
        
    }

    // function to delete InvestorType
    public function DeleteInvestmentType()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = base64_decode($inputData['id']);
            $investmentData = InvestmentType::find($id);
            $investmentData->status = 2;
            if($investmentData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>1,'msg'=>'failed');
            }
        }
        return $response;
    }
    // function to edit InvestorType

    public function EditInvestmentType($id)
    {
        $id = base64_decode($id);
        $investmentData = InvestmentType::where('id','=',$id)->first();
        return view('backend/EditInvestmentType')->with('data',$investmentData);
    }

    // function to save edited InvestorType
    public function SaveInvestmentType()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = $inputData['id'];
            $investmentData = InvestmentType::find($id);
            $investmentData->typeInvestment = $inputData['typeInvestment'];
            if($investmentData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }
        }
        return $response;
    }

        // function to view InvestmentType search category
    public function viewCity()
    {
        $cityData = CityList::where('status','=',1)->get();
        return view('backend/viewCity')->with('data',$cityData);
    }
    // fundtion to add new InvestmentType form 
    public function AddCityForm()
    {
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $countryList = countryList::where('status','=',1)->orderby('country_name','ASC')->get();
        return view('backend/AddCityForm')->with('data',$countryList);        
    }

    // add InvestorType 
    public function AddCity()
    {
        /*print_r($inputData); exit;*/
        if($this->checkLogin() == 1){
            return redirect('/Admin/index');
        }
        $inputData = Input::all();
        $response = array();
        //print_r($inputData); exit;
        if(!empty($inputData))
        {
            $cityData = new CityList();
            $cityData->country_id = $inputData['country_id'];
            $cityData->city_name = $inputData['city_name'];
            $cityData->status = $inputData['status'];
            if($cityData->save())
            {
                $response= array('code'=>1, 'msg'=>'success');
            } else{
                $response = array('code'=>2,'msg'=>'failed');
            }
        }
        return $response;
        
    }

    // function to delete InvestorType
    public function DeleteCity()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = base64_decode($inputData['id']);
            $cityData = CityList::find($id);
            $cityData->status = 2;
            if($cityData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>1,'msg'=>'failed');
            }
        }
        return $response;
    }
    // function to edit InvestorType

    public function EditCity($id)
    {
        $id = base64_decode($id);
        $countryList = countryList::where('status','=',1)->get(); 
        $cityList = CityList::where('id','=',$id)->first();
        /*echo "<pre>"; print_r($cityList->toArray()); exit;*/
        return view('backend/EditCity')->with('data',$cityList)->with('country',$countryList);
    }

    // function to save edited InvestorType
    public function SaveCity()
    {
        $inputData = Input::all();
        $response = array();
        /*print_r($inputData); exit;*/
        if(!empty($inputData))
        {
            $id = $inputData['id'];
            $cityData = CityList::find($id);
            $cityData->country_id = $inputData['country_id'];
            $cityData->city_name = $inputData['city_name'];
            if($cityData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }
        }
        return $response;
    }

    // function to fundinggoal Value
    public function viewFundGoalValue()
    {
        $fundgoalData = FundGoalValue::get();
        return view('backend/viewFundGoalValue')->with('data',$fundgoalData);
    }

    // function to edit fund goal
    public function EditFundGoal($id)
    {
        $id = base64_decode($id);
        $fundgoalData = FundGoalValue::where('id',$id)->first();
        /*print_r($fundgoalData->toArray()); exit;*/
        return view('backend/EditFundGoalValue')->with('data',$fundgoalData);
    }

    // function to save changed data for save fund goal
    public function SaveFundGoal()
    {
        $inputData = Input::all();
        $response = array();
        /*print_r($inputData); exit;*/
        if(!empty($inputData))
        {
            $id = $inputData['id'];
            $saveGoalData = FundGoalValue::find($id);
            $saveGoalData->minValue = $inputData['minValue'];
            $saveGoalData->maxValue = $inputData['maxValue'];
            if($saveGoalData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>2,'msg'=>'failed');
            }            
        }
        return $response;
    }

    public function StaticPages()
    {
        $pageData = StaticPage::get();
        return view('backend/viewPages')->with('data',$pageData->toArray());
    }
    public function StaticPageData($id)
    {
        /*$inputData = Input::all();*/
        $pageId = base64_decode($id);
        $pageData = PageData::with('PageInfo')->where('page_id','=',$pageId)->first();
        /*print_r($pageData->toArray()); exit;*/
        return view('backend/EditPageData')->with('data',$pageData);
    }
    public function AddStaticPageForm()
    {
        return view('backend/AddStaticPageForm');
    }
    public function AddStaticPageData()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $page_name = $inputData['page_name'];
            $page_content = $inputData['editor1'];
            $pageInfo =new StaticPage();
            $pageInfo->page_name = $page_name;
            if($pageInfo->save())
            {
                $id = $pageInfo->id;
                $pageData = new PageData();
                $pageData->page_id = $id;
                $pageData->page_content = $page_content;
                if($pageData->save())
                {
                    $response = array('code'=>1,'msg'=>'success');
                }else{
                    $response = array('code'=>1,'msg'=>'failed');
                }
            }
        }
        return $response;
    }

    public function SaveStaticPageData()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            
            $id = $inputData['id'];
            $page_content = $inputData['data'];
            $page_name = $inputData['page_name'];
            $page_id = $inputData['page_id'];
            /*print_r($inputData); exit;*/
            $pageData = PageData::find($id);
            $pageData->page_content = $page_content;
            if($pageData->save())
            {
                $sPage = StaticPage::find($page_id);
                $sPage->page_name = $page_name;
                if($sPage->save()){
                    $response = array('code'=>1,'msg'=>'success');
                }else{
                    $response = array('code'=>1,'msg'=>'failed');
                }
                
            }else{
                $response = array('code'=>1,'msg'=>'failed');
            }
        }
        return $response;
    }

    public function ViewCompanyCampaign()
    {
        $compaignsData = UserCompany::where('status','!=',3)->get();
        /*echo"<pre>"; print_r($compaignsData->toArray()); exit;*/
        return view('backend/ViewCompanyCampaign')->with('data',$compaignsData);
    } 
    public function SuspendCompanyCampaign()
    {
        $inputData = Input::all();
        if(!empty($inputData))
        {
            $id = base64_decode($inputData['id']);
            $compData = UserCompany::find($id);
            $compData->status = 2;
            if($compData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>1,'msg'=>'failed');
            }
        }
        return $response;
    }
    public function ActivateCompanyCampaign()
    {
        $inputData = Input::all();
        if(!empty($inputData))
        {
            $id = base64_decode($inputData['id']);
            $compData = UserCompany::find($id);
            $compData->status = 1;
            if($compData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>1,'msg'=>'failed');
            }
        }
        return $response;
    }
    public function DeleteCompanyCampaign()
    {
        $inputData = Input::all();
        if(!empty($inputData))
        {
            $id = base64_decode($inputData['id']);
            $compData = UserCompany::find($id);
            $compData->status = 3;
            if($compData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>1,'msg'=>'failed');
            }
        }
        return $response;
    }
    public function EditCompanyCampaign($id)
    {
        $id = base64_decode($id);
        $companytypes = TypeCompanies::where('status', 1)->orderBy('typeCompanies','ASC')->get();
        $fundingtype = TypeFunding::where('status', 1)->orderBy('typeFunding','ASC')->get();
        $industry = Industry::where('status', 1)->orderBy('industryName','ASC')->get();
        $sectors = SectorType::where('status', 1)->orderBy('sectorName')->get();
        $country = countryList::orderBy('country_name','ASC')->get();
        $city = CityList::orderBy('city_name','ASC')->get();
        $compaignsData = UserCompany::where('id',$id)->first();
        return view('backend/EditCompanyCampaign')->with('companyTypes',$companytypes)->with('fundType',$fundingtype)->with('sector',$sectors)->with('industry',$industry)->with('data',$compaignsData);
    }
    public function SaveEditCompanyCampaign()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $id = $inputData['id'];
            $companyData = UserCompany::find($id);
            $companyData->jobTitle = $inputData['jobTitle'];
            $companyData->companyName = $inputData['companyName'];
            $companyData->country = $inputData['country'];
            $companyData->city = $inputData['city'];
            $companyData->companyUrl = $inputData['companyUrl'];
            $companyData->fundraisUrl = $inputData['fundraisUrl'];
            $companyData->slideshareUrl = $inputData['slideshareUrl'];
            $companyData->companyTagline = $inputData['companyTagline'];
            $companyData->profileText = $inputData['profileText'];
            $companyData->personalBio = $inputData['personalBio'];
            $companyData->companyType = $inputData['companyType'];
            $companyData->fundingType = $inputData['fundingType'];
            $companyData->sector = $inputData['sector'];
            $companyData->industry = $inputData['industry'];
            $companyData->ammountRaised = $inputData['ammountRaised'];
            $companyData->fundingGoal = $inputData['fundingGoal'];
            $companyData->minReservation = $inputData['minReservation'];
            $companyData->maxReservation = $inputData['maxReservation'];
            $companyData->equity = $inputData['equity'];
            $companyData->openDate = $inputData['openDate'];
            $companyData->closingDate = $inputData['closingDate'];
            if($companyData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>2,'msg'=>'failed');
            }
        }
        return $response;
    }

    //function to load add Company Campagins form
    public function AddCompanyCampaignForm()
    {
        $companytypes = TypeCompanies::where('status', 1)->orderBy('typeCompanies','ASC')->get();
        $fundingtype = TypeFunding::where('status', 1)->orderBy('typeFunding','ASC')->get();
        $industry = Industry::where('status', 1)->orderBy('industryName','ASC')->get();
        $sectors = SectorType::where('status', 1)->orderBy('sectorName')->get();
        $country = countryList::orderBy('country_name','ASC')->get();
        $city = CityList::orderBy('city_name','ASC')->get();
        return view('backend/AddCompanyCampaignForm')->with('companyTypes',$companytypes)->with('fundType',$fundingtype)->with('sector',$sectors)->with('industry',$industry)->with('country',$country);
    }

    // function to get cisty list dependent
    public function getcityList()
    {
        $inputData = Input::all();
        $cid = $inputData['cid'];
        $citylist = CityList::where('country_id','=',$cid)->get();
        $data = json_encode($citylist);
        return $data;
    }
    //function to add Company Compaigns
    public function AddCompanyCampaign()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $companyData = new UserCompany();
            $companyData->fname = $inputData['firstname'];
            $companyData->lname = $inputData['lastname'];
            $companyData->jobTitle = $inputData['jobTitle'];
            $companyData->companyName = $inputData['companyName'];
            $companyData->email = $inputData['email'];
            $companyData->phoneno = $inputData['phoneno'];
            $companyData->country = $inputData['country'];
            $companyData->city = $inputData['city'];
            $companyData->companyUrl = $inputData['companyUrl'];
            $companyData->fundraisUrl = $inputData['fundraisUrl'];
            $companyData->slideshareUrl = $inputData['slideshareUrl'];
            $companyData->companyTagline = $inputData['companyTagline'];
            $companyData->profileText = $inputData['profileText'];
            $companyData->personalBio = $inputData['personalBio'];
            $companyData->companyType = $inputData['companyType'];
            $companyData->fundingType = $inputData['fundingType'];
            $companyData->sector = $inputData['sector'];
            $companyData->industry = $inputData['industry'];
            $companyData->ammountRaised = $inputData['ammountRaised'];
            $companyData->fundingGoal = $inputData['fundingGoal'];
            $companyData->minReservation = $inputData['minReservation'];
            $companyData->maxReservation = $inputData['maxReservation'];
            $companyData->equity = $inputData['equity'];
            $companyData->openDate = $inputData['openDate'];
            $companyData->closingDate = $inputData['closingDate'];
            if($companyData->save())
            {
                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>2,'msg'=>'failed');
            }
        }
        return $response;        
    }

        public function ViewInvestorCampaign()
        {
            $compaignsData = UserInvestor::where('status','!=',3)->get();
            /*echo"<pre>"; print_r($compaignsData->toArray()); exit;*/
            return view('backend/ViewInvestorCampaign')->with('data',$compaignsData);
        } 
        public function SuspendInvestorCampaign()
        {
            $inputData = Input::all();
            if(!empty($inputData))
            {
                $id = base64_decode($inputData['id']);
                $compData = UserInvestor::find($id);
                $compData->status = 2;
                if($compData->save())
                {
                    $response = array('code'=>1,'msg'=>'success');
                }else{
                    $response = array('code'=>1,'msg'=>'failed');
                }
            }
            return $response;
        }
        public function ActivateInvestorCampaign()
        {
            $inputData = Input::all();
            if(!empty($inputData))
            {
                $id = base64_decode($inputData['id']);
                $compData = UserInvestor::find($id);
                $compData->status = 1;
                if($compData->save())
                {
                    $response = array('code'=>1,'msg'=>'success');
                }else{
                    $response = array('code'=>1,'msg'=>'failed');
                }
            }
            return $response;
        }
        public function DeleteInvestorCampaign()
        {
            $inputData = Input::all();
            if(!empty($inputData))
            {
                $id = base64_decode($inputData['id']);
                $compData = UserInvestor::find($id);
                $compData->status = 3;
                if($compData->save())
                {
                    $response = array('code'=>1,'msg'=>'success');
                }else{
                    $response = array('code'=>1,'msg'=>'failed');
                }
            }
            return $response;
        }
        public function EditInvestorCampaign($id)
        {
            $id = base64_decode($id);
            $investorType = InvestorType::where('status', 1)->orderBy('typeInvestor')->get();
            $investmentType = InvestmentType::where('status', 1)->orderBy('typeInvestment')->get();
            $industry = Industry::where('status', 1)->orderBy('industryName')->get();
            $sectors = SectorType::where('status', 1)->orderBy('sectorName')->get();
            $regions = RegionName::where('status', 1)->orderBy('regionName')->get();
            $investorData = UserInvestor::with('User')->get();
            $country = countryList::orderBy('country_name')->get();
            $city = CityList::orderBy('city_name')->get();
            $compaignsData = UserInvestor::where('id',$id)->first();
            /*print_r($sectors->toArray()); exit;*/
            return view('backend/EditInvestorCampaign')->with('investortype',$investorType)->with('investmentType',$investmentType)->with('sector',$sectors)->with('industry',$industry)->with('investorData',$investorData)->with('data',$compaignsData)->with('region',$regions)->with('country',$country);
        }

        public function SaveEditInvestorCampaign()
        {
            $inputData = Input::all();
            if(!empty($inputData))
            {
                $id = $inputData['id'];
                $investorData = UserInvestor::find($id);
                $investorData->jobTitle = $inputData['jobTitle'];
                $investorData->firmName = $inputData['firmName'];
                $investorData->country = $inputData['country'];
                $investorData->city = $inputData['city'];
                $investorData->investorfirmUrl = $inputData['investorfirmUrl'];
                $investorData->fundraisUrl = $inputData['fundraisUrl'];
                $investorData->firmTagline = $inputData['firmTagline'];
                $investorData->profileText = $inputData['profileText'];
                $investorData->bioData = $inputData['bioData'];
                $investorData->investorType = $inputData['investorType'];
                $investorData->investmentType = $inputData['investmentType'];
                $investorData->sectorFocus = $inputData['sectorFocus'];
                $investorData->industryFocus = $inputData['industryFocus'];
                $investorData->regionFocus = $inputData['regionFocus'];
                $investorData->countryFocus = $inputData['countryFocus'];
                $investorData->assetUndermgmt = $inputData['assetUndermgmt'];
                $investorData->investmentRangefrm = $inputData['investmentRangefrm'];
                $investorData->investmentRangeto = $inputData['investmentRangeto'];
                if($investorData->save())
                {
                    $response = array('code'=>1,'msg'=>'success');
                }else{
                    $response = array('code'=>2,'msg'=>'failed');
                }
            }
            return $response;
        }

        public function AddInvestorCampaignForm()
        {
            $investorType = InvestorType::where('status', 1)->orderBy('typeInvestor')->get();
            $investmentType = InvestmentType::where('status', 1)->orderBy('typeInvestment')->get();
            $industry = Industry::where('status', 1)->orderBy('industryName')->get();
            $sectors = SectorType::where('status', 1)->orderBy('sectorName')->get();
            $regions = RegionName::where('status', 1)->orderBy('regionName')->get();
            $investorData = UserInvestor::with('User')->get();
            $country = countryList::orderBy('country_name')->get();
            $city = CityList::orderBy('city_name')->get();
            /*print_r($sectors->toArray()); exit;*/
            return view('backend/AddInvestorCampaignForm')->with('investortype',$investorType)->with('investmentType',$investmentType)->with('sector',$sectors)->with('industry',$industry)->with('investorData',$investorData)->with('region',$regions)->with('country',$country);
        }

        public function importExport(){
            return view('backend/exportExcel');
        }
        public function downloadExcelUser($type)
        {

            return Excel::download(new UsersExport, 'users.'.$type);
            /*$user = User::->get()->toArray();*/
        }

        public function downloadExcelUserCompany($type)
        {

            return Excel::download(new CompanyExport, 'company.'.$type);
            /*$user = User::->get()->toArray();*/
        }
        public function downloadExcelUserInvestor($type)
        {

            return Excel::download(new InvestorExport, 'investor.'.$type);
            /*$user = User::->get()->toArray();*/
        }

        public function importExcelForm(){
            return view('backend/importExcel');
        }

        //function to import excel
        public function importExcel(Request $request){
            /*$request->validate([
                'import_file' => 'required'
            ]);*/
            $path = $request->file('import')->getRealPath();
            

            try {
                Excel::import(new UsersImport, $path);
                \Session::flash('success', 'Users uploaded successfully.');
                return Redirect::back()->with('excel_resp', array('error' => 'success','msg' => 'Insert Record successfully.'));;
            } catch (\Exception $e) {
                \Session::flash('error', $e->getMessage());
                return Redirect::back()->with('excel_resp', array('error' => 'error','msg' => $e->getMessage()));;
            }
            return back()->with('success', 'Insert Record successfully.');
        }
        public function userTrail()
        {
            $userData = User::with('UserType')->where('status','!=',2)->get();
            return view('backend/userTrail')->with('data',$userData);
        }
        public function editSubscriptionForm($id)
        {
            $id = base64_decode($id);
            $userData = User::where('id','=',$id)->first();
            return view('backend/updateSubscriptionDate')->with('data',$userData);
        }

        public function submitSubscriptonDate()
        {
            $inputData = Input::all();
            $response = array();
            if(!empty($inputData))
            {
                $plan = '1';
                if ($inputData['subscription_plan'] == 'trial') {
                    $plan = '1';
                }else if($inputData['subscription_plan'] == 'unlimited'){
                    $plan = '2';
                }

                $id = $inputData['id'];
                $userData = User::find($id);
                $userData->activation = $inputData['activation'];
                $userData->subscription_plan = $plan;
                if($userData->save())
                {
                    $response = array('code'=>'1','msg'=>'success');
                }else{
                    $response = array('code'=>'2','msg'=>'failed');
                }
            }
            return $response;
        }
    public function CreateMessage()
    {
        $userlist = User::get();
        return view('backend/CreateMessage')->with('data',$userlist);
    }
    public function getUserList()
    {
        $inputData = Input::all();
        $id = $inputData['senderid'];
        $userData = User::where('id','!=',$id)->get();
        return json_encode($userData);
    }
    public function sendMessage()
    {
        $inputData = Input::all();
        $response = array();
        if(!empty($inputData))
        {
            $messageData = new Message;
            $messageData->sender_id = $inputData['sender'];
            $messageData->reciever_id = $inputData['reciever'];
            $messageData->message = $inputData['message'];
            $messageData->status = 2;
            $messageData->type = 1;
            if($messageData->save())
            {
                $sender = User::with('investorDetail')->with('companyDetail')->find($inputData['sender'])->toArray();
                $reciver = User::with('investorDetail')->with('companyDetail')->find($inputData['reciever'])->toArray();
                $mailckk = Mail::send('frontend/email/req_meeting', ['sender' => $sender,'reciver' => $reciver,'message_contant' => $inputData['message']], function ($message) use($inputData){
                    $message->to('harendra@nextolive.com', 'Lond Cap - Admin')->subject('New Meeting - LondCap');
                    
                    });
                    

                $response = array('code'=>1,'msg'=>'success');
            }else{
                $response = array('code'=>2,'msg'=>'failed');
            }
        }
        return $response;
    }


    public function ChangeFeatured(){
        $inputData = Input::all();
        $response = array('code'=>2,'msg'=>'failed');
        if(!empty($inputData))
        {
            $userid = @$inputData['userId'];
            $action = @$inputData['action'];
            $userType = @$inputData['userType'];

            if(!empty($userType)){
                if($userType==2){
                    //investor
                    $array = [];
                    if($action == 0){
                        $array = ['is_featured' => 0];
                        $data ='No <span class="featuredAction" data-action="1" data-type="2" data-id="'.$userid.'">Show</span>';
                    }else if($action == 1){
                        $array = ['is_featured' => 1];
                        $data ='Yes <span class="featuredAction" data-action="0" data-type="2" data-id="'.$userid.'">Hide</span>';
                    }
                    if(!empty($array)){
                        UserInvestor::where('userid',$userid)->update($array);
                        $response = array('code'=>1,'msg'=>'success', 'data'=>$data);
                    }
                }else if($userType==1){
                    //comp
                    $array = [];
                    if($action == 0){
                        $array = ['is_featured' => 0];
                        $data ='No <span class="featuredAction" data-action="1" data-type="1" data-id="'.$userid.'">Show</span>';
                    }else if($action == 1){
                        $array = ['is_featured' => 1];
                        $data ='Yes <span class="featuredAction" data-action="0" data-type="1" data-id="'.$userid.'">Hide</span>';
                    }
                    if(!empty($array)){
                        UserCompany::where('userid',$userid)->update($array);
                        $response = array('code'=>1,'msg'=>'success', 'data'=>$data);
                    }
                }
            }
        }
        return $response;   
    }

    public function changeVisablity(){
        
        $user_id = $_POST['id'];
        $current = $_POST['current'];
        $contact_status = null;
        if($current == 'not'){
            $contact_status = '2';
        }else{
            $contact_status = '1';
        }
        
        $resp = User::where('id',$user_id)->update(['see_contacts' => $contact_status]);
        return $resp;
    }

    public function changePublicStatus(){
        $user_id = $_POST['userid'];
        $userType = $_POST['usertype'];
        $current = $_POST['current'];

        $is_Public = null;
        if($current == '1'){
            $is_Public = '0';
        }else{
            $is_Public = '1';
        }
        $resp = null;
        

        if($userType == 1){
            $resp = UserCompany::where('userid',$user_id)->update(['is_Public' => $is_Public]);
            
        }else{
            $resp = UserInvestor::where('userid',$user_id)->update(['is_Public' => $is_Public]);
        }

        if( $is_Public == '1'){
            //send email that your account has been approved
            $userdata = User::where('id',$user_id)->first()->toArray();
            
            try{
                $mailckk = Mail::send('backend/email/user_approved', ['userData' => $userdata], 
                function ($message) use($userdata){
                    $message->to($userdata['email'], $userdata['firstname']." ".$userdata['lastname'])
                    ->subject('LondCap - Account Approved');
                    //
                 //	$message->from('optimus@nextolive.com','Optimus');
                });
            } catch(\Exception $e){
                
            }
            if( count(Mail::failures()) > 0 ) {

               foreach(Mail::failures as $email_address) {
                   $response = array('code'=>1,'msg'=>'Mail Not Sent');
                }

            } else {
                $response = array('code'=>1,'msg'=>'Success');
            }

        }
        

        
        return $resp;
    }

    public function changeProfStatus(){
        $user_id = $_POST['userid'];
        
        $current = $_POST['current'];

        $is_Prof = null;
        if($current == '1'){
            $is_Prof = '0';
        }else{
            $is_Prof = '1';
        }

        $resp = User::where('id',$user_id)->update(['is_Professional'=>$is_Prof]);

        // if($userType == 1){
        //     $resp = UserCompany::where('userid',$user_id)->update(['is_Public' => $is_Public]);
        // }else{
        //     $resp = UserInvestor::where('userid',$user_id)->update(['is_Public' => $is_Public]);
        // }
        
        return $resp;
    }


    public function changeMessageMeetingApproval_(){
        $user_id = $_POST['userid'];
        $current = $_POST['current'];
        $is_Approved = null;
        if($current === 'yes'){
            $is_Approved = '2';
        }else{
            $is_Approved = '1';
        }
        $resp = User::where('id',$user_id)->update(['message_meeting_approval'=>$is_Approved]);
        return $resp;
    }

    public function config(){
        $data = Config::orderBy('display_order','asc')->get()->toArray();
        return view('backend/config')->with('configs',$data);
    }

    public function updateConfig(){
        $inputData = Input::all();
        $id = $inputData['id'];
        $value = $inputData['value'];
        if (empty($value)) {
            $resp = array('status' => "error", 'msg' => 'Value is empty.');
        }else{
           $resp = Config::where('id',$id)->update(['value' => $value]);
            if($resp){
                $resp = array('status' => "success", 'msg' => 'Configuration updated');
            }else{
                $resp = array('status' => "error", 'msg' => 'Configuration not updated! Something went wrong. Please try again.');
            } 
        }
        
        echo json_encode($resp);
    }

    public function UserHistory(){
        $visits = UserHistory::with('user')->with('investorDetail')->with('companyDetail')->get()->toArray();
        return view('backend/user_visit')->with('visits',$visits);
    }

    public function userGroupSubscriptions(){
        return view('backend/userGroupSubscriptions');
    }
    public function updateGroupSubscriptions(){
        $inputData = Input::all();
        $response = array();
        $group = $inputData['group'];
        $date = $inputData['date'];

        if (empty($group)) {
            $response = array('status' => "error", 'msg' => 'Group is empty');
        }else if(empty($date)){
            $response = array('status' => "error", 'msg' => 'Date is empty');
        }else{
            if ($group === '1') {
                //  company professional
                $u_type = '1';
                $is_prof = '1';
            }else if ($group === '2') {
                //  company non professional
                $u_type = '1';
                $is_prof = '0';
            }else if ($group === '3') {
                //  investor professional
                $u_type = '2';
                $is_prof = '1';
            }else if ($group === '4') {
                //  investor non professional
                $u_type = '2';
                $is_prof = '2';
            }
            
            $resp = User::where('usertype',$u_type)->where('is_Professional',$is_prof)->update(['activation' => $date]);
            if($resp){
                $response = array('status' => "success", 'msg' => 'Records updated');
            }else{
                $response = array('status' => "error", 'msg' => 'Records not updated! Something went wrong. Please try again.');
            }
        }
        
        
        return $response;

    }
    
}

