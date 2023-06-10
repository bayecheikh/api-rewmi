<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;

use App\Models\Role;
use App\Models\Permission;

use App\Models\Annuaire;
use App\Models\User;
use Twilio\Rest\Client;

class SmsAnnuaireController extends Controller
{
    /**
     * Store a newly created resource in storagrolee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendSms(Request $request)
    {
        $input = $request->all();
        $prenom = $input['prenom'];
        $nom = $input['nom'];
        $telephone = $input['telephone'];
        $type_militant = $input['type_militant'];     
        $region = $input['region'];
        $departement = $input['departement'];
        $commune = $input['commune'];
        $message = $input['message'];

        $validator = Validator::make($input, []);
        if ($validator->fails())
        {
            return response()
            ->json($validator->errors());
        }
        else{ 
            if ($request->user()->hasRole('super_admin') || $request->user()->hasRole('admin')) {
                $Annuaires = Annuaire::where('status','actif');
            }
            else{           
                $user_id = $request->user()->id;
                $Annuaires = Annuaire::where('user_id', $user_id)->where('status','like', '%actif%');                      
            }
            if($prenom!=''){               
                $Annuaires = $Annuaires
                ->where('prenom','like', '%'.$prenom.'%');                  
            }
            if($nom!=''){               
                $Annuaires = $Annuaires
                ->where('nom','like', '%'.$nom.'%');                  
            }
            
            if($telephone!=''){               
                $Annuaires = $Annuaires
                ->where('telephone','like', '%'.$telephone.'%');                  
            }
            if($type_militant!=''){               
                $Annuaires = $Annuaires
                ->where('type_militant','like', '%'.$type_militant.'%');                  
            }
            
            if($region!=''){               
                $Annuaires = $Annuaires
                ->where('region','like', '%'.$region.'%');
                                 
            }
            if($departement!=''){               
                $Annuaires = $Annuaires
                ->where('departement','like', '%'.$departement.'%');                  
            }
            if($commune!=''){               
                $Annuaires = $Annuaires
                ->where('commune','like', '%'.$commune.'%');                  
            }

            $Annuaires = $Annuaires->get();

            //send sms

            /* $this->validate($request, [
                'receiver' => 'required|max:15',
                'message' => 'required|min:5|max:155',
            ]); */
     
            try {
                $accountSid = getenv("TWILIO_SID");
                $authToken = getenv("TWILIO_TOKEN");
                $twilioNumber = getenv("TWILIO_FROM");
     
                $client = new Client($accountSid, $authToken);
     
                $client->messages->create("+221778688784", [
                    'from' => $twilioNumber,
                    'body' => $request->message
                ]);
     
                return back()
                ->with('success','Sms has been successfully sent.');
     
            } catch (\Exception $e) {
                dd($e->getMessage());
                return back()
                ->with('error', $e->getMessage());
            }

            return response()->json(["success" => true, "message" => "Liste des Annuaires", "data" =>$Annuaires]);
        }
    }
    public function AnnuaireByNumTelephone(Request $request)
    {
        $input = $request->all();

        $telephone = $input['telephone'];
        

        $validator = Validator::make($input, []);
        if ($validator->fails())
        {
            return response()
            ->json($validator->errors());
        }
        else{ 
            $Annuaires = Annuaire::where('status', 'like', '%actif%');

            if($telephone!=''){               
                $Annuaires = $Annuaires
                ->where('telephone','like', '%'.$telephone.'%');                  
            }
            $Annuaires = $Annuaires->get();
            return response()->json(["success" => true, "message" => "Liste des Annuaires", "data" =>$Annuaires]);
        }
    }

    
}
