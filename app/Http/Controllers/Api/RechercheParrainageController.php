<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Validator;

use App\Models\Role;
use App\Models\Permission;

use App\Models\Parrainage;
use App\Models\User;

class RechercheParrainageController extends Controller
{
    /**
     * Store a newly created resource in storagrolee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recherche(Request $request)
    {
        $input = $request->all();

        $numero_cedeao = $input['numero_cedeao'];
        $prenom = $input['prenom'];
        $nom = $input['nom'];
        $date_naissance = $input['date_naissance'];
        $lieu_naissance = $input['lieu_naissance'];
        $taille = $input['taille'];
        $sexe = $input['sexe'];
        $numero_electeur = $input['numero_electeur'];
        $centre_vote = $input['centre_vote'];
        $bureau_vote = $input['bureau_vote'];
        $numero_cin = $input['numero_cin'];
        $telephone = $input['telephone'];
        $prenom_responsable = $input['prenom_responsable'];
        $nom_responsable = $input['nom_responsable'];
        $telephone_responsable = $input['telephone_responsable'];
        $created_at = $input['created_at'];
        $region = $input['region'];
        $departement = $input['departement'];
        $commune = $input['commune'];

        $validator = Validator::make($input, []);
        if ($validator->fails())
        {
            return response()
            ->json($validator->errors());
        }
        else{ 
            if ($request->user()->hasRole('super_admin') || $request->user()->hasRole('admin')) {
                $Parrainages = Parrainage::where('status','actif');
            }
            else{           
                $user_id = $request->user()->id;
                $Parrainages = Parrainage::where('user_id', $user_id)->where('status','like', '%actif%');                      
            }
            if(isset($input['user_id'])){
                $Parrainages = $Parrainages
                ->where('user_id','like', '%'.$input['user_id'].'%');   
            }
            if($numero_cedeao!=''){               
                $Parrainages = $Parrainages
                ->where('numero_cedeao','like', '%'.$numero_cedeao.'%');                  
            }
            if($prenom!=''){               
                $Parrainages = $Parrainages
                ->where('prenom','like', '%'.$prenom.'%');                  
            }
            if($nom!=''){               
                $Parrainages = $Parrainages
                ->where('nom','like', '%'.$nom.'%');                  
            }
            if($date_naissance!=''){               
                $Parrainages = $Parrainages
                ->where('date_naissance','like', '%'.$date_naissance.'%');                  
            }
            if($lieu_naissance!=''){               
                $Parrainages = $Parrainages
                ->where('lieu_naissance','like', '%'.$lieu_naissance.'%');                  
            }
            if($taille!=''){               
                $Parrainages = $Parrainages
                ->where('taille','like', '%'.$taille.'%');                  
            }
            if($sexe!=''){               
                $Parrainages = $Parrainages
                ->where('sexe','like', '%'.$sexe.'%');                  
            }
            if($numero_electeur!=''){               
                $Parrainages = $Parrainages
                ->where('numero_electeur','like', '%'.$numero_electeur.'%');                  
            }
            if($centre_vote!=''){               
                $Parrainages = $Parrainages
                ->where('centre_vote','like', '%'.$centre_vote.'%');                  
            }
            if($bureau_vote!=''){               
                $Parrainages = $Parrainages
                ->where('bureau_vote','like', '%'.$bureau_vote.'%');                  
            }
            if($numero_cin!=''){               
                $Parrainages = $Parrainages
                ->where('numero_cin','like', '%'.$numero_cin.'%');                  
            }
            if($telephone!=''){               
                $Parrainages = $Parrainages
                ->where('telephone','like', '%'.$telephone.'%');                  
            }
            if($prenom_responsable!=''){               
                $Parrainages = $Parrainages
                ->where('prenom_responsable','like', '%'.$prenom_responsable.'%');                  
            }
            if($nom_responsable!=''){               
                $Parrainages = $Parrainages
                ->where('nom_responsable','like', '%'.$nom_responsable.'%');                  
            }
            if($telephone_responsable!=''){               
                $Parrainages = $Parrainages
                ->where('telephone_responsable','like', '%'.$telephone_responsable.'%');                  
            }
            if($created_at!=''){               
                $Parrainages = $Parrainages
                ->where('created_at','like', '%'.$created_at.'%');                  
            }
            if($region!=''){               
                $Parrainages = $Parrainages
                ->where('region','like', '%'.$region.'%');
                                 
            }
            if($departement!=''){               
                $Parrainages = $Parrainages
                ->where('departement','like', '%'.$departement.'%');                  
            }
            if($commune!=''){               
                $Parrainages = $Parrainages
                ->where('commune','like', '%'.$commune.'%');                  
            }

            $Parrainages = $Parrainages->get();

            return response()->json(["success" => true, "message" => "Liste des Parrainages", "data" =>$Parrainages,"REGION" =>$region]);
        }
    }
    public function parrainageByNumCedeao(Request $request)
    {
        $input = $request->all();

        $numero_cedeao = $input['numero_cedeao'];
        

        $validator = Validator::make($input, []);
        if ($validator->fails())
        {
            return response()
            ->json($validator->errors());
        }
        else{ 
            $Parrainages = Parrainage::where('status', 'like', '%actif%');

            if($numero_cedeao!=''){               
                $Parrainages = $Parrainages
                ->where('numero_cedeao','like', '%'.$numero_cedeao.'%');                  
            }
            $Parrainages = $Parrainages->get();
            return response()->json(["success" => true, "message" => "Liste des Parrainages", "data" =>$Parrainages]);
        }
    }

    public function parrainageByNumElecteur(Request $request)
    {
        $input = $request->all();
        $numero_electeur = $input['numero_electeur'];
        

        $validator = Validator::make($input, []);
        if ($validator->fails())
        {
            return response()
            ->json($validator->errors());
        }
        else{ 
            $Parrainages = Parrainage::where('status', 'like', '%actif%');
           
            if($numero_electeur!=''){               
                $Parrainages = $Parrainages
                ->where('numero_electeur','like', '%'.$numero_electeur.'%');                  
            }

            $Parrainages = $Parrainages->get();
            return response()->json(["success" => true, "message" => "Liste des Parrainages", "data" =>$Parrainages]);
        }
    }

    public function parrainageByNumCin(Request $request)
    {
        $input = $request->all();

        $numero_cin = $input['numero_cin'];

        $validator = Validator::make($input, []);
        if ($validator->fails())
        {
            return response()
            ->json($validator->errors());
        }
        else{ 
            $Parrainages = Parrainage::where('status', 'like', '%actif%');
            
            if($numero_cin!=null){               
                $Parrainages = $Parrainages
                ->where('numero_cin','like', '%'.$numero_cin.'%');                  
            }

            $Parrainages = $Parrainages->get();
            return response()->json(["success" => true, "message" => "Liste des Parrainages", "data" =>$Parrainages]);
        }
    }

    
    public function doublonCedeao(Request $request)
    {
        
            $Parrainages = DB::table('parrainages')
                ->groupBy('numero_cedeao')
                ->havingRaw('COUNT(numero_cedeao) > 1')
                ->get();
       
        return response()->json(["success" => true, "message" => "Parrainage List en doublon", "data" =>$Parrainages]);
    }

    public function doublonCin(Request $request)
    {
        
            $Parrainages = DB::table('parrainages')
                ->groupBy('numero_cin')
                ->havingRaw('COUNT(id) > 1')
                ->get();
       
        return response()->json(["success" => true, "message" => "Parrainage List en doublon", "data" =>$Parrainages]);
    }

    public function doublonNumElecteur(Request $request)
    {
        
            $Parrainages = DB::table('parrainages')
                ->groupBy('numero_electeur')
                ->havingRaw('COUNT(id) > 1')
                ->get();
       
        return response()->json(["success" => true, "message" => "Parrainage List en doublon", "data" =>$Parrainages]);
    }


}
