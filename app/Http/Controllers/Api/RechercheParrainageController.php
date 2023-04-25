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
                $Parrainages = Parrainage::all();
            }
            else{           
                $user_id = $request->user()->id;
                $Parrainages = Parrainage::where('user_id', $user_id);                      
            }

            if($numero_cedeao!=''){               
                $Parrainages = $Parrainages
                ->where('numero_cedeao','LIKE', '%'.$numero_cedeao.'%');                  
            }
            if($prenom!=''){               
                $Parrainages = $Parrainages
                ->where('prenom','LIKE', '%'.$prenom.'%');                  
            }
            if($nom!=''){               
                $Parrainages = $Parrainages
                ->where('nom','LIKE', '%'.$nom.'%');                  
            }
            if($date_naissance!=''){               
                $Parrainages = $Parrainages
                ->where('date_naissance','LIKE', '%'.$date_naissance.'%');                  
            }
            if($lieu_naissance!=''){               
                $Parrainages = $Parrainages
                ->where('lieu_naissance','LIKE', '%'.$lieu_naissance.'%');                  
            }
            if($taille!=''){               
                $Parrainages = $Parrainages
                ->where('taille','LIKE', '%'.$taille.'%');                  
            }
            if($sexe!=''){               
                $Parrainages = $Parrainages
                ->where('sexe','LIKE', '%'.$sexe.'%');                  
            }
            if($numero_electeur!=''){               
                $Parrainages = $Parrainages
                ->where('numero_electeur','LIKE', '%'.$numero_electeur.'%');                  
            }
            if($centre_vote!=''){               
                $Parrainages = $Parrainages
                ->where('centre_vote','LIKE', '%'.$centre_vote.'%');                  
            }
            if($bureau_vote!=''){               
                $Parrainages = $Parrainages
                ->where('bureau_vote','LIKE', '%'.$bureau_vote.'%');                  
            }
            if($numero_cin!=''){               
                $Parrainages = $Parrainages
                ->where('numero$numero_cin','LIKE', '%'.$numero_cin.'%');                  
            }
            if($telephone!=''){               
                $Parrainages = $Parrainages
                ->where('telephone','LIKE', '%'.$telephone.'%');                  
            }
            if($prenom_responsable!=''){               
                $Parrainages = $Parrainages
                ->where('prenom$prenom_responsable','LIKE', '%'.$prenom_responsable.'%');                  
            }
            if($nom_responsable!=''){               
                $Parrainages = $Parrainages
                ->where('nom$nom_responsable','LIKE', '%'.$nom_responsable.'%');                  
            }
            if($telephone_responsable!=''){               
                $Parrainages = $Parrainages
                ->where('telephone_responsable','LIKE', '%'.$telephone_responsable.'%');                  
            }
            if($region!=''){               
                $Parrainages = $Parrainages
                ->where('region','LIKE', '%'.$region.'%');                  
            }
            if($departement!=''){               
                $Parrainages = $Parrainages
                ->where('departement','LIKE', '%'.$departement.'%');                  
            }
            if($commune!=''){               
                $Parrainages = $Parrainages
                ->where('commune','LIKE', '%'.$commune.'%');                  
            }

            //$Parrainages = $Parrainages->orderBy('created_at', 'DESC');
            return response()->json(["success" => true, "message" => "Liste des Parrainages", "data" =>$Parrainages]);
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
            $Parrainages = Parrainage::where('status', 'LIKE', '%actif%');

            if($numero_cedeao!=null){               
                $Parrainages = $Parrainages
                ->where('numero_cedeao','LIKE', '%'.$numero_cedeao.'%');                  
            }
            $Parrainages = $Parrainages->orderBy('created_at', 'DESC');
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
            $Parrainages = Parrainage::where('status', 'LIKE', '%actif%');
           
            if($numero_electeur!=null){               
                $Parrainages = $Parrainages
                ->where('numero_electeur','LIKE', '%'.$numero_electeur.'%');                  
            }

            $Parrainages = $Parrainages->orderBy('created_at', 'DESC');
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
            $Parrainages = Parrainage::where('status', 'LIKE', '%actif%');
            
            if($numero_cin!=null){               
                $Parrainages = $Parrainages
                ->where('numero$numero_cin','LIKE', '%'.$numero_cin.'%');                  
            }

            $Parrainages = $Parrainages->orderBy('created_at', 'DESC');
            return response()->json(["success" => true, "message" => "Liste des Parrainages", "data" =>$Parrainages]);
        }
    }
}
