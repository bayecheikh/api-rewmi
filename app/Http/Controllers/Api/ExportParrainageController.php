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

class ExportParrainageController extends Controller
{
    /**
     * Store a newly created resource in storagrolee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportCSV(Request $request){

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

        $validator = Validator::make($input, ['annee' => '','monnaie' => '','region' => '','dimension' => '','pilier' => '','axe' => '','source' => '','type_source' => '','structure' => '','departement' => '']);
        if ($validator->fails())
        {
            return response()
            ->json($validator->errors());
        }
        else{ 
            $Parrainages = Parrainage::where('status', 'like', '%actif%');
           
            if (!$request->user()->hasRole('super_admin')) {
                $user_id = $request->user()->id;
                $Parrainages = $Parrainages
                ->where('user_id', $user_id);
            }

            if($numero_cedeao!=null){               
                $Parrainages = $Parrainages
                ->where('numero_cedeao','like', '%'.$numero_cedeao.'%');                  
            }
            if($prenom!=null){               
                $Parrainages = $Parrainages
                ->where('prenom','like', '%'.$prenom.'%');                  
            }
            if($nom!=null){               
                $Parrainages = $Parrainages
                ->where('nom','like', '%'.$nom.'%');                  
            }
            if($date_naissance!=null){               
                $Parrainages = $Parrainages
                ->where('date_naissance','like', '%'.$date_naissance.'%');                  
            }
            if($lieu_naissance!=null){               
                $Parrainages = $Parrainages
                ->where('lieu_naissance','like', '%'.$lieu_naissance.'%');                  
            }
            if($taille!=null){               
                $Parrainages = $Parrainages
                ->where('taille','like', '%'.$taille.'%');                  
            }
            if($sexe!=null){               
                $Parrainages = $Parrainages
                ->where('sexe','like', '%'.$sexe.'%');                  
            }
            if($numero_electeur!=null){               
                $Parrainages = $Parrainages
                ->where('numero_electeur','like', '%'.$numero_electeur.'%');                  
            }
            if($centre_vote!=null){               
                $Parrainages = $Parrainages
                ->where('centre_vote','like', '%'.$centre_vote.'%');                  
            }
            if($bureau_vote!=null){               
                $Parrainages = $Parrainages
                ->where('bureau_vote','like', '%'.$bureau_vote.'%');                  
            }
            if($numero_cin!=null){               
                $Parrainages = $Parrainages
                ->where('numero$numero_cin','like', '%'.$numero_cin.'%');                  
            }
            if($telephone!=null){               
                $Parrainages = $Parrainages
                ->where('telephone','like', '%'.$telephone.'%');                  
            }
            if($prenom_responsable!=null){               
                $Parrainages = $Parrainages
                ->where('prenom$prenom_responsable','like', '%'.$prenom_responsable.'%');                  
            }
            if($nom_responsable!=null){               
                $Parrainages = $Parrainages
                ->where('nom$nom_responsable','like', '%'.$nom_responsable.'%');                  
            }
            if($telephone_responsable!=null){               
                $Parrainages = $Parrainages
                ->where('telephone_responsable','like', '%'.$telephone_responsable.'%');                  
            }
            if($region!=null){               
                $Parrainages = $Parrainages
                ->where('region','like', '%'.$region.'%');                  
            }
            if($departement!=null){               
                $Parrainages = $Parrainages
                ->where('departement','like', '%'.$departement.'%');                  
            }
            if($commune!=null){               
                $Parrainages = $Parrainages
                ->where('commune','like', '%'.$commune.'%');                  
            }

            $Parrainages = $Parrainages->orderBy('created_at', 'DESC');

            $fileName = 'Parrainages.csv';
        // these are the headers for the csv file. Not required but good to have one incase of system didn't recongize it properly
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );


        //adding the first row

        $columns = array(
            'numero_cedeao',
            'prenom',
            'nom',
            'date_naissance',
            'lieu_naissance',
            'taille',
            'sexe',
            'numero_electeur',
            'centre_vote',
            'bureau_vote',
            'numero_cin',
            'telephone',
            'region',
            'departement',
            'commune',
            'prenom_responsable',
            'nom_responsable',
            'telephone_responsable',
            
        );

        $callback = function() use($Parrainages, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,';');

            foreach ($Parrainages as $Parrainage) {   
                
                $row['numero_cedeao']  = $Parrainage->numero_cedeao;
                $row['prenom']  = $Parrainage->prenom;
                $row['nom']  = $Parrainage->nom;
                $row['date_naissance']  = $Parrainage->date_naissance;
                $row['lieu_naissance']  = $Parrainage->lieu_naissance;
                $row['taille']  = $Parrainage->taille;
                $row['sexe']  = $Parrainage->sexe;
                $row['numero_electeur']  = $Parrainage->numero_electeur;
                $row['centre_vote']  = $Parrainage->centre_vote;
                $row['bureau_vote']  = $Parrainage->bureau_vote;
                $row['numero_cin']  = $Parrainage->numero_cin;
                $row['telephone']  = $Parrainage->telephone;
                $row['region']  = $Parrainage->region;
                $row['departement']  = $Parrainage->departement;
                $row['commune']  = $Parrainage->commune;
                $row['prenom_responsable']  = $Parrainage->prenom;
                $row['nom_responsable']  = $Parrainage->nom;
                $row['telephone_responsable']  = $Parrainage->telephone;

                fputcsv($file, array( 
                    $row['numero_cedeao'],
                    $row['prenom'],
                    $row['nom'],
                    $row['date_naissance'],
                    $row['lieu_naissance'],
                    $row['taille'],
                    $row['sexe'],
                    $row['numero_electeur'],
                    $row['centre_vote'],
                    $row['bureau_vote'],
                    $row['numero_cin'],
                    $row['telephone'],
                    $row['region'],
                    $row['departement'],
                    $row['commune'],
                    $row['prenom_responsable'],
                    $row['nom_responsable'],
                    $row['telephone_responsable'] 
                ),';');
            }

            fclose($file);
        };


        //download command
        return response()->stream($callback, 200, $headers);
        }
    }

    public function exportPDF(){

    }
}
