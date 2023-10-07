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

use App\Models\Votant;
use App\Models\User;
class VotantController extends Controller
{
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
           
            if($numero_electeur!=''){               
                $Electeurs = Votant::where('numero_electeur','like', '%'.$numero_electeur.'%');                  
            }

            $Electeurs = $Electeurs->get();
            return response()->json(["success" => true, "message" => "Liste des Electeurs", "data" =>$Electeurs]);
        }
    }
}
