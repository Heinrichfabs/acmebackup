<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\diseaseInjuryRequest;
use App\Models\DiseaseInjury;
use App\Models\Animal;

class diseaseInjuryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disease_injuries = DiseaseInjury::leftJoin(
            "animal_disease_injury",
            "disease_injuries.id",
            "=",
            "animal_disease_injury.disease_injury_id"
        )
            ->leftJoin(
                "animals",
                "animals.id",
                "=",
                "animal_disease_injury.animals_id"
            )
            ->select(
                "disease_injuries.id",
                "disease_injuries.classify",
                "disease_injuries.deleted_at",
                "animals.animal_name"
            )
            ->orderBy("disease_injuries.id", "ASC")
            ->withTrashed()
            ->paginate(6);
        return view("disease_injuries.index", [
            "disease_injuries" => $disease_injuries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals = Animal::pluck("animal_name", "id");
        return view("disease_injuries.create", ["animals" => $animals]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(diseaseInjuryRequest $request)
    {
        $disease_injuries = DiseaseInjury::create($request->all());
        if ($request->animals_id) {
            foreach ($request->animals_id as $animals_id) {
                DB::table("animal_disease_injury")->insert([
                    "animals_id" => $animals_id,
                    "disease_injury_id" => $disease_injuries->id,
                ]);
            }
        }
        return Redirect::to("/diseaseinjury")->with(
            "success",
            "Disease/Injury has been added!"
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disease_injuries = DiseaseInjury::find($id);

        $animal_disease_injury = DB::table("animal_disease_injury")
            ->where("disease_injury_id", $id)
            ->pluck("animals_id")
            ->toArray();

        $animals = Animal::pluck("animal_name", "id");

        return view("disease_injuries.edit", [
            "animals" => $animals,
            "disease_injuries" => $disease_injuries,
            "animal_disease_injury" => $animal_disease_injury,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $disease_injuries = DiseaseInjury::find($id);
        $animals_id = $request->animals_id;

        if (empty($animals_id)) {
            DB::table("animal_disease_injury")
                ->where("disease_injury_id", $id)
                ->delete();
        } else {
            DB::table("animal_disease_injury")
                ->where("disease_injury_id", $id)
                ->delete();
            foreach ($animals_id as $animal_id) {
                DB::table("animal_disease_injury")->insert([
                    "animals_id" => $animal_id,
                    "disease_injury_id" => $id,
                ]);
            }
        }
        $disease_injuries->update($request->all());
        return Redirect::to("/diseaseinjury")->with(
            "success",
            "Disease/Injury Data has been updated!/"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DiseaseInjury::destroy($id);
        return Redirect::to("/diseaseinjury")->with(
            "success",
            "Adopter Data Deleted!"
        );
    }

    public function restore($id)
    {
        DiseaseInjury::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("diseaseinjury.index")->with(
            "success",
            "Disease/Injury Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        DiseaseInjury::withTrashed()
            ->findOrFail($id)
            ->forceDelete();
        return Redirect::route("diseaseinjury.index")->with(
            "success",
            "Disease/Injury Data Permanently Deleted!"
        );
    }
}
