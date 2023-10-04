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

use App\Models\Electeur;
use App\Models\User;

class RechercheElecteurController extends Controller
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
                $Electeurs = Electeur::where('status','like', '%actif%');
            }
            else{           
                $user_id = $request->user()->id;
                $Electeurs = Electeur::where('user_id', $user_id)->where('status','like', '%actif%');                      
            }
            if(isset($input['user_id'])){
                $Electeurs = $Electeurs
                ->where('user_id','like', '%'.$input['user_id'].'%');   
            }
            if($numero_cedeao!=''){               
                $Electeurs = $Electeurs
                ->where('numero_cedeao','like', '%'.$numero_cedeao.'%');                  
            }
            if($prenom!=''){               
                $Electeurs = $Electeurs
                ->where('prenom','like', '%'.$prenom.'%');                  
            }
            if($nom!=''){               
                $Electeurs = $Electeurs
                ->where('nom','like', '%'.$nom.'%');                  
            }
            if($date_naissance!=''){               
                $Electeurs = $Electeurs
                ->where('date_naissance','like', '%'.$date_naissance.'%');                  
            }
            if($lieu_naissance!=''){               
                $Electeurs = $Electeurs
                ->where('lieu_naissance','like', '%'.$lieu_naissance.'%');                  
            }
            if($taille!=''){               
                $Electeurs = $Electeurs
                ->where('taille','like', '%'.$taille.'%');                  
            }
            if($sexe!=''){               
                $Electeurs = $Electeurs
                ->where('sexe','like', '%'.$sexe.'%');                  
            }
            if($numero_electeur!=''){               
                $Electeurs = $Electeurs
                ->where('numero_electeur','like', '%'.$numero_electeur.'%');                  
            }
            if($centre_vote!=''){               
                $Electeurs = $Electeurs
                ->where('centre_vote','like', '%'.$centre_vote.'%');                  
            }
            if($bureau_vote!=''){               
                $Electeurs = $Electeurs
                ->where('bureau_vote','like', '%'.$bureau_vote.'%');                  
            }
            if($numero_cin!=''){               
                $Electeurs = $Electeurs
                ->where('numero_cin','like', '%'.$numero_cin.'%');                  
            }
            if($telephone!=''){               
                $Electeurs = $Electeurs
                ->where('telephone','like', '%'.$telephone.'%');                  
            }
            if($prenom_responsable!=''){               
                $Electeurs = $Electeurs
                ->where('prenom_responsable','like', '%'.$prenom_responsable.'%');                  
            }
            if($nom_responsable!=''){               
                $Electeurs = $Electeurs
                ->where('nom_responsable','like', '%'.$nom_responsable.'%');                  
            }
            if($telephone_responsable!=''){               
                $Electeurs = $Electeurs
                ->where('telephone_responsable','like', '%'.$telephone_responsable.'%');                  
            }
            if($created_at!=''){               
                $Electeurs = $Electeurs
                ->where('created_at','like', '%'.$created_at.'%');                  
            }
            if($region!=''){               
                $Electeurs = $Electeurs
                ->where('region','like', '%'.$region.'%');
                                 
            }
            if($departement!=''){               
                $Electeurs = $Electeurs
                ->where('departement','like', '%'.$departement.'%');                  
            }
            if($commune!=''){               
                $Electeurs = $Electeurs
                ->where('commune','like', '%'.$commune.'%');                  
            }

            $Electeurs = $Electeurs->get();

            return response()->json(["success" => true, "message" => "Liste des Electeurs", "data" =>$Electeurs,"REGION" =>$region]);
        }
    }
    public function ElecteurByNumCedeao(Request $request)
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
            $Electeurs = Electeur::where('status', 'like', '%actif%');

            if($numero_cedeao!=''){               
                $Electeurs = $Electeurs
                ->where('numero_cedeao','like', '%'.$numero_cedeao.'%');                  
            }
            $Electeurs = $Electeurs->get();
            return response()->json(["success" => true, "message" => "Liste des Electeurs", "data" =>$Electeurs]);
        }
    }

    public function ElecteurByNumElecteur(Request $request)
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
            $Electeurs = Electeur::where('status', 'like', '%actif%');
           
            if($numero_electeur!=''){               
                $Electeurs = $Electeurs
                ->where('numero_electeur','like', '%'.$numero_electeur.'%');                  
            }

            $Electeurs = $Electeurs->get();
            return response()->json(["success" => true, "message" => "Liste des Electeurs", "data" =>$Electeurs]);
        }
    }

    public function ElecteurByNumCin(Request $request)
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
            $Electeurs = Electeur::where('status', 'like', '%actif%');
            
            if($numero_cin!=null){               
                $Electeurs = $Electeurs
                ->where('numero_cin','like', '%'.$numero_cin.'%');                  
            }

            $Electeurs = $Electeurs->get();
            return response()->json(["success" => true, "message" => "Liste des Electeurs", "data" =>$Electeurs]);
        }
    }

    
    public function doublonCedeao(Request $request)
    {
        
            /* $Electeurs = DB::table('Electeurs')
                ->select('*')
                ->orderBy('numero_cedeao', 'desc')
                ->groupBy('numero_cedeao')
                ->havingRaw('COUNT(id) > 1')
                ->get(); */
                /* $Electeurs = Electeur::whereIn('id', function ( $query ) {
                    $query->select('id')->from('Electeurs')->groupBy('numero_cedeao')->havingRaw('count(*) > 1');
                })->get(); */

        if ($request->user()->hasRole('super_admin') || $request->user()->hasRole('admin')) {
            $Electeurs = Electeur::where('status','like', '%actif%')->get();
        }
        else{           
            $user_id = $request->user()->id;
            $Electeurs = Electeur::where('user_id', $user_id)->where('status','like', '%actif%')->get();                      
        }

        
        $ElecteursUnique = $Electeurs->unique(['numero_cedeao']);
        $ElecteurDuplicates = $Electeurs->diff($ElecteursUnique);
       
        return response()->json(["success" => true, "message" => "Electeur List en doublon", "data" =>$ElecteurDuplicates]);
    }

    public function doublonCin(Request $request)
    {
        
        if ($request->user()->hasRole('super_admin') || $request->user()->hasRole('admin')) {
            $Electeurs = Electeur::where('status','like', '%actif%')->get();
        }
        else{           
            $user_id = $request->user()->id;
            $Electeurs = Electeur::where('user_id', $user_id)->where('status','like', '%actif%')->get();                      
        }

        $ElecteursUnique = $Electeurs->unique(['numero_cin']);
        $ElecteurDuplicates = $Electeurs->diff($ElecteursUnique);
       
        return response()->json(["success" => true, "message" => "Electeur List en doublon", "data" =>$ElecteurDuplicates]);
    }

    public function doublonNumElecteur(Request $request)
    {
        
        if ($request->user()->hasRole('super_admin') || $request->user()->hasRole('admin')) {
            $Electeurs = Electeur::where('status','like', '%actif%')->get();
        }
        else{           
            $user_id = $request->user()->id;
            $Electeurs = Electeur::where('user_id', $user_id)->where('status','like', '%actif%')->get();                      
        }

        $ElecteursUnique = $Electeurs->unique(['numero_electeur']);
        $ElecteurDuplicates = $Electeurs->diff($ElecteursUnique);
       
        return response()->json(["success" => true, "message" => "Electeur List en doublon", "data" =>$ElecteurDuplicates]);
    }

    public function sansDoublon(Request $request)
    {
        
        if ($request->user()->hasRole('super_admin') || $request->user()->hasRole('admin')) {
            $Electeurs = Electeur::where('status','like', '%actif%')->get();
        }
        else{           
            $user_id = $request->user()->id;
            $Electeurs = Electeur::where('user_id', $user_id)->where('status','like', '%actif%')->get();                      
        }

        $ElecteursUnique = $Electeurs->unique(['numero_electeur']);
        
       
        return response()->json(["success" => true, "message" => "Electeur List sans doublon", "data" =>$ElecteursUnique]);
    }

    public function electeurByRegion(Request $request)
    {         
        if ($request->user()->hasRole('super_admin') || $request->user()->hasRole('admin')) {
            $ElecteursUnique = DB::table("parrainages")
            ->select("region", "count (*)")
            ->whereNotNull("region")
            ->groupBy("region")
            ->get();
        }
        else{           
            $user_id = $request->user()->id;            
            $ElecteursUnique = DB::table("parrainages")
            ->select("region", "count (*)")
            ->where('user_id', $user_id)
            ->whereNotNull("region")
            ->groupBy("region")
            ->get();
        }                    

        
        
       
        return response()->json(["success" => true, "message" => "Electeur List sans doublon", "data" =>$ElecteursUnique]);
    }


}
