<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Characters;
use App\Models\Origin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\Return_;

class CharacterController extends Controller
{
    /* INTERFAZ */
    public function IndexCharacter()
    {
        $charactedb = Characters::paginate(20);
        return view('character', compact('charactedb'));
    }
    /* API */
    public function ConsumirApixPage($id)
    {
        $BaseUrl = env('API_ENDPOINT');
        $characterfull = array();
        $response = Http::get($BaseUrl . 'character/?page=' . $id);
        $data = $response->json();
        $character = $data['results'];
        return response()->json(['data' => $character]);
    }
    public function ConsumirApixDetail($id)
    {
        $BaseUrl = env('API_ENDPOINT');
        $response = Http::get($BaseUrl . 'character/' . $id);
        $data = $response->json();
        return response()->json(['detail' => $data]);
    }
    /* BD */
    public function StoreBd(Request $request)
    {
        $id = $request->id;
        $BaseUrl = env('API_ENDPOINT');
        $response = Http::get($BaseUrl . 'character/?page=' . $id);
        $data = $response->json();
        $dats = $data['results'];
        $characterBulk = array();
        $originbulk = array();
        $i = 0;
        $countCha = Characters::count();
        $countOri = Origin::count();
        if ($countCha == 0 ||$countCha <=100 ) {
            if ($countOri == 0||$countOri <=100) {
                do {
                    $bulkcha = [
                        'id_api' => $dats[$i]['id'],
                        'name' => $dats[$i]['name'],
                        'species' => $dats[$i]['species'],
                        'status' => $dats[$i]['status'],
                        'type' => $dats[$i]['type'],
                        'gender' => $dats[$i]['gender'],
                        'image' => $dats[$i]['image'],
                    ];
                    $bulkori = [
                        'id_chararcter' => $dats[$i]['id'],
                        'name' => $dats[$i]['origin']['name'],
                        'url' => $dats[$i]['origin']['url'],
                    ];

                    array_push($characterBulk, $bulkcha);
                    array_push($originbulk, $bulkori);

                    $i++;
                } while ($i < count($dats));
            }
            Characters::insert($characterBulk);
            Origin::insert($originbulk);
            return response()->json('Se ingresaron los 100 registros');

        } else {
            return response()->json('No se pudo ingresar los 100 registros');
        }

    }
    public function UpdateCharacter(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $species = $request->species;
        $status = $request->status;
        $type = $request->type;
        $gender = $request->gender;

        if ($name == "" || $species == "" || $status == "" || $type == "" || $gender == "") {
            if ($name == "") {
                Characters::where('id_api', $id)->update(
                    [
                        'name' => "",
                        'species' => $species,
                        'status' => $status,
                        'type' => $type,
                        'gender' => $gender,
                    ]
                );
            }
            if ($species == "") {
                Characters::where('id_api', $id)->update(
                    [
                        'name' => $name,
                        'species' => "",
                        'status' => $status,
                        'type' => $type,
                        'gender' => $gender,
                    ]
                );}
            if ($status == "") {
                Characters::where('id_api', $id)->update(
                    [
                        'name' => $name,
                        'species' => $species,
                        'status' => "",
                        'type' => $type,
                        'gender' => $gender,
                    ]
                );}
            if ($type == "") {
                Characters::where('id_api', $id)->update(
                    [
                        'name' => $name,
                        'species' => $species,
                        'status' => $status,
                        'type' => "",
                        'gender' => $gender,
                    ]
                );}
            if ($gender == "") {
                Characters::where('id_api', $id)->update(
                    [
                        'name' => $name,
                        'species' => $species,
                        'status' => $status,
                        'type' => $type,
                        'gender' => "",
                    ]
                );
            }

        } else {
            Characters::where('id_api', $id)->update(
                [
                    'name' => $name,
                    'species' => $species,
                    'status' => $status,
                    'type' => $type,
                    'gender' => $gender,
                ]
            );
        }

    }
    public function UpdateOrigin(Request $request)
    {
        $id = $request->id;
        $nameo = $request->nameo;
        $url = $request->url;
        if ($nameo == "" || $url == "") {
            if ($nameo == "") {
                Origin::where('id_chararcter', $id)->update(
                    [
                        'name' => "",
                        'url' => $url,
                    ]
                );
            }if ($url == "") {
                Origin::where('id_chararcter', $id)->update(
                    [
                        'name' => $nameo,
                        'url' => "",
                    ]
                );
            }
        } else {

            Origin::where('id_chararcter', $id)->update(
                [
                    'name' => $nameo,
                    'url' => $url,
                ]
            );
        }

    }

}
