<?php

namespace App\Imports;

use App\User;
use App\countryList;
use App\cityList;
use App\UserCompany;
use App\UserInvestor;
use App\TypeCompanies;
use App\TypeFunding;
use App\InvestorType;
use App\SectorType;
use App\Industry;
use App\RegionName;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Session;

class UsersImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    public $count = 0;

    public function model(array $row)
    {
        ++$this->count;

        if(isset($row[0]) && isset($row[1]) && isset($row[2]) && isset($row[3]) && isset($row[4]) 
            && isset($row[5]) && isset($row[6]) && isset($row[7]) && isset($row[8]) && isset($row[9]) 
            && isset($row[10]) && isset($row[11]) && isset($row[12]) && isset($row[13]) && isset($row[14])){


            if ($row[3] == 'Investor') { $userType = '2'; }else{ $userType = '1'; }
            if ($row[5] == 'Inactive') { $status = '2'; }else{ $status = '1'; }

            if ($row[6] == 'No') { $is_Professional = '0'; }else{ $is_Professional = '1';  }
            if ($row[7] == 'Not Verified') { $email_verification = '2'; }else{ $email_verification = '1'; }

            if ($row[8] == 'No') { $see_contacts = '1'; }else{ $see_contacts = '2'; }
            if ($row[9] == 'Unlimited') { $subscription_plan = '2'; }else{ $subscription_plan = '1'; }

            $firstname          = $row[0];
            $lastname           = $row[1];
            $email              = $row[2];
            $activation         = $row[4];
            $subscription_plan  = $row[9];
            $country            = $row[12];
            $city               = $row[13];
                
            // $userCheck = User::where('email',$email)->first();
            // if(!empty($userCheck)){
            //     \Session::flash('excel_resp', 
            //     array(  'error' => 'error','msg' => 
            //             'Email "'.$email.'" is already registered with us.',
            //             'address' => 'Row ->'.$this->count,
            //     ));
            //     header('Location: ' . $_SERVER['HTTP_REFERER']);
            // }

            $user = new User;
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->email = $email;
            $user->usertype = $userType;
            $user->activation= $activation;
            $user->status = $status;
            $user->is_Professional = $is_Professional;
            $user->email_verification = $email_verification;
            $user->see_contacts = $see_contacts;
            $user->subscription_plan = $subscription_plan;
            $user->country = $country;
            $user->city = $city;
            $user->save();
            $user_id = $user->id;
            if(isset($row[10])){ $phone = $row[10]; }else{ $phone = null; }
            if(isset($row[11])){ $jobTitle = $row[11]; }else{ $jobTitle = null; }
            if(isset($row[12])){ 
                $country_name = $row[12];
                $country = countryList::where('country_name',$country_name)->first();
                if(!empty($country)){
                    $country_id = $country['id'];
                }else{ $country_id = null; } 
            }else{ 
                $country_id = null; 
            }

            if(isset($row[13])){ 
                $city_name = $row[13];
                $city = CityList::where('city_name',$city_name)->where('country_id',$country_id)->first();
                if(!empty($city)){
                    $city_id = $city['id'];
                }else{ $city_id = null; } 
            }else{ 
                $city_id = null; 
            }

            if(isset($row[14])){ $linkedinUrl = $row[14]; }else{ $linkedinUrl = null; }
            if(isset($row[15])){ $facebookUrl = $row[15]; }else{ $facebookUrl = null; }
            if(isset($row[16])){ $twitterUrl = $row[16]; }else{ $twitterUrl = null; }
            if(isset($row[17])){ $slideshareUrl = $row[17]; }else{ $slideshareUrl = null; }
            if(isset($row[18])){ $investorFirmVideo = $row[18]; }else{ $investorFirmVideo = null; }
            $cistatus = $status;
            

            if(isset($row[19]) && $row[19] == 'Yes'){ 
                $published = '1';
            }else{ 
                $published = '0'; 
            }

            if(isset($row[20]) && $row[20] == 'Show'){ 
                $featured = '1';
            }else{ 
                $featured = '0'; 
            }

            if(isset($row[21])){ $fundraisingUrl = $row[21]; }else{ $fundraisingUrl = null; }

            if(isset($row[26])){ $companyName = $row[26]; }else{ $companyName = null; }


            if(isset($row[22])){ $companyUrl = $row[22]; }else{ $companyUrl = null; }

            if(isset($row[23])){ $companyTagLine  = $row[23]; }else{ $companyTagLine = null; }

            if(isset($row[24])){ $companyProfileText = $row[24]; }else{ $companyProfileText = null; }
            
            if(isset($row[25])){ $companyPersonalBio = $row[25]; }else{ $companyPersonalBio = null; }
            
            if(isset($row[38])){ 
                
                $ctype = TypeCompanies::where('typeCompanies',$row[38])->first();
                
                if(!empty($ctype)){
                    $compInvType = $ctype->toArray()['id'];
                }else{
                    $invType = InvestorType::where('typeInvestor',$row[38])->first();
                    
                    if(!empty($invType)){
                        $compInvType = $invType->toArray()['id'];
                    }else{
                        $compInvType = null;
                    }
                }
            }else{ 
                $compInvType = null; 
            }
            
            if(isset($row[39])){
                
                $fType = TypeFunding::where('typeFunding',$row[39])->first();
                if(!empty($fType)){
                    $investmentFundingType = $fType->toArray()['id']; 
                }else{
                    $investmentFundingType = null;
                }
            }else{ 
                $investmentFundingType = null; 
            }

            if(isset($row[40])){
                
                $sType = SectorType::where('sectorName',$row[40])->first();
                if(!empty($sType)){
                    $sectorFocus = $sType->toArray()['id'];
                }else{
                    $sectorFocus = null;
                }
            }else{
                $sectorFocus = null; 
            }

            if(isset($row[41])){ 
                
                $iType = Industry::where('industryName',$row[41])->first();
                if(!empty($iType)){
                    $industryFocus = $iType->toArray()['id'];
                }else{
                    $industryFocus = null;
                }
            }else{
                $industryFocus = null; 
            }

            

            
            if($userType == '1'){
                // add company data
                if(isset($row[27])){ $companyAmountRaised = number_format($row[27]); }else{ $companyAmountRaised = null; }

                if(isset($row[28])){ $companyFundingGoal = number_format($row[28]); }else{ $companyFundingGoal = null; }

                if(isset($row[29])){ $companyMinReservation = number_format($row[29]); }else{ $companyMinReservation = null; }

                if(isset($row[30])){ $companyMaxReservation = number_format($row[30]); }else{ $companyMaxReservation = null; }
                
                if(isset($row[31])){ $companyEquity = $row[31]; }else{ $companyEquity = null; }

                if(isset($row[32])){ $openDate = $row[32]; }else{ $openDate = null; }

                if(isset($row[33])){ $closingDate = $row[33]; }else{ $closingDate = null; }

                $companyData = new UserCompany;
                $companyData->userid = $user_id;
                $companyData->fname = $firstname;
                $companyData->lname = $lastname;
                $companyData->email = $email;
                $companyData->phoneno = $phone;
                $companyData->jobTitle = $jobTitle;
                $companyData->country = $country_id;
                $companyData->city = $city_id;
                $companyData->companyUrl = $companyUrl;
                $companyData->fundraisUrl = $fundraisingUrl;
                $companyData->linkedinUrl = $linkedinUrl;
                $companyData->fbUrl = $facebookUrl;
                $companyData->twitterUrl = $twitterUrl;
                $companyData->slideshareUrl = $slideshareUrl;
                $companyData->investorFirmvideo =$investorFirmVideo ;
                $companyData->companyTagline = $companyTagLine;
                $companyData->profileText = $companyProfileText;
                $companyData->personalBio = $companyPersonalBio;
                $companyData->companyName = $companyName;
                $companyData->companyType = $compInvType;
                $companyData->fundingType = $investmentFundingType;
                $companyData->industry = $industryFocus;
                $companyData->sector = $sectorFocus;
                $companyData->ammountRaised = $companyAmountRaised;
                $companyData->fundingGoal = $companyFundingGoal;
                $companyData->minReservation = $companyMinReservation;
                $companyData->maxReservation = $companyMaxReservation;
                $companyData->equity = $companyEquity;
                $companyData->openDate = $openDate;
                $companyData->closingDate = $closingDate;
                $companyData->is_Public = $cistatus;
                $companyData->status = $status;
                $companyData->isPublished = $published;
                $companyData->is_featured = $featured;
                $companyData->save();
            }else if($userType == '2'){
                if(isset($row[34])){ $investorAssetUndermgmt = $row[34]; }else{ $investorAssetUndermgmt = null; }
                if(isset($row[35])){ $investorRangeFrom = $row[35]; }else{ $investorRangeFrom = null; }
                if(isset($row[36])){ $investorRangeTo = $row[36]; }else{ $investorRangeTo = null; }
                if(isset($row[37])){ $investorBioData = $row[37]; }else{ $investorBioData = null; }

                if(isset($row[42])){ 
                
                    $rType = RegionName::where('regionName',$row[42])->first();
                    if($rType){
                        $regionFocus = $rType->toArray()['id'];
                    }else{
                        $regionFocus = null;
                    }
                }else{ 
                    $regionFocus = null; 
                }
    
                if(isset($row[43])){ 
                    
                    $cont = countryList::where('country_name',$row[43])->first();
                    if(!empty($cont)){
                        $countryFocus = $cont->toArray()['id'];
                    }else{
                        $countryFocus = null;
                    }
                }else{ 
                    $countryFocus = null; 
                }

                    $investorData = new UserInvestor;
                    $investorData->userid = $user_id;
                    $investorData->firstname = $firstname;
                    $investorData->lastname = $lastname;
                    $investorData->email = $email;
                    $investorData->phoneno = $phone;
                    $investorData->firmName = $companyName;
                    $investorData->firmTagline = $companyTagLine;
                    $investorData->profileText = $companyProfileText;
                    $investorData->jobTitle = $jobTitle;
                    $investorData->country = $country_id;
                    $investorData->city = $city_id;
                    $investorData->investorfirmUrl = $companyUrl;
                    $investorData->linkedinUrl = $linkedinUrl;
                    $investorData->fbUrl = $facebookUrl;
                    $investorData->twitterUrl = $twitterUrl;
                    $investorData->slideshareUrl = $slideshareUrl;
                    $investorData->investorFirmvideo = $investorFirmVideo;
                    $investorData->investorType = $compInvType;
                    $investorData->investmentType = $investmentFundingType;
                    $investorData->sectorFocus = $sectorFocus;
                    $investorData->industryFocus = $industryFocus;
                    $investorData->is_Public = $cistatus;
                    $investorData->regionFocus = $regionFocus;
                    $investorData->countryFocus = $countryFocus;
                    $investorData->assetUndermgmt = $investorAssetUndermgmt;
                    $investorData->investmentRangefrm = $investorRangeFrom;
                    $investorData->investmentRangeto = $investorRangeTo;
                    $investorData->status = $status;
                    
                    $investorData->fundraisUrl = $fundraisingUrl;
                    $investorData->bioData = $investorBioData;
                    $investorData->isPublished = $published;
                    $investorData->is_featured = $featured;

                    $investorData->save();
            }   
        }  
    }
}
