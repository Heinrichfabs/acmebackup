<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Rescuer;
use App\Models\Adopter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\animalRequest;
class animalController extends Controller
{
    public function search()
    {
        $animals = Animal::leftJoin(
            "animal_disease_injury",
            "animals.id",
            "=",
            "animal_disease_injury.animals_id"
        )
            ->leftJoin(
                "disease_injuries",
                "disease_injuries.id",
                "=",
                "animal_disease_injury.disease_injury_id"
            )
            ->select(
                "disease_injuries.classify",
                "animals.id",
                "animals.animal_name",
                "animals.age",
                "animals.gender",
                "animals.type",
                "animals.images"
            )
            ->orderBy("animals.id", "ASC")
            ->get();
        return view("animals.search", [
            "animals" => $animals,
        ]);
    }

    public function result()
    {
        $result = $_GET["result"];
        $animals = Animal::leftJoin(
            "animal_disease_injury",
            "animals.id",
            "=",
            "animal_disease_injury.animals_id"
        )
            ->leftJoin(
                "disease_injuries",
                "disease_injuries.id",
                "=",
                "animal_disease_injury.disease_injury_id"
            )
            ->select(
                "animals.id",
                "animals.animal_name",
                "animals.age",
                "animals.gender",
                "animals.type",
                "animals.images"
            )

            ->where("animals.animal_name", "LIKE", "%" . $result . "%")
            ->get();
        return view("animals.result", [
            "animals" => $animals,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::join(
            "rescuers",
            "rescuers.id",
            "=",
            "animals.rescuer_id"
        )
            ->leftJoin(
                "animal_adopter",
                "animals.id",
                "=",
                "animal_adopter.animals_id"
            )
            ->leftJoin(
                "adopters",
                "adopters.id",
                "=",
                "animal_adopter.adopter_id"
            )
            ->leftJoin(
                "animal_disease_injury",
                "animals.id",
                "=",
                "animal_disease_injury.animals_id"
            )
            ->leftJoin(
                "disease_injuries",
                "disease_injuries.id",
                "=",
                "animal_disease_injury.disease_injury_id"
            )
            ->select(
                "rescuers.first_name",
                "adopters.first_name as fname",
                "disease_injuries.classify",
                "animals.id",
                "animals.animal_name",
                "animals.age",
                "animals.gender",
                "animals.type",
                "animals.images",
                "animals.rescuer_id",
                "animals.deleted_at"
            )
            ->orderBy("animals.id", "ASC")
            ->withTrashed()
            ->paginate(6);
        return view("animals.index", ["animals" => $animals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rescuers = Rescuer::pluck("first_name", "id");
        return view("animals.create", [
            "rescuers" => $rescuers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(animalRequest $request)
    {
        $animals = new Animal();
        $animals->animal_name = $request->input("animal_name");
        $animals->age = $request->input("age");
        $animals->gender = $request->input("gender");
        $animals->type = $request->input("type");
        $animals->rescuer_id = $request->input("rescuer_id");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/animals/", $filename);
            $animals->images = $filename;
        }
        $animals->save();
        return Redirect::to("/animals")->with("success", "New Animal Added!");
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
        $animals = Animal::find($id);
        $rescuers = Rescuer::pluck("first_name", "id");
        return view("animals.edit", [
            "animals" => $animals,
            "rescuers" => $rescuers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(animalRequest $request, $id)
    {
        $animals = Animal::find($id);
        $animals->animal_name = $request->input("animal_name");
        $animals->age = $request->input("age");
        $animals->gender = $request->input("gender");
        $animals->type = $request->input("type");
        $animals->rescuer_id = $request->input("rescuer_id");
        if ($request->hasfile("images")) {
            $destination = "uploads/animals/" . $animals->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/animals/", $filename);
            $animals->images = $filename;
        }
        $animals->update();
        return Redirect::to("/animals")->with(
            "success",
            "Animal Data Updated!"
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
        Animal::destroy($id);
        return Redirect::to("/animals")->with(
            "success",
            "Animal Data Deleted!"
        );
    }

    public function restore($id)
    {
        Animal::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("animals.index")->with(
            "success",
            "Animal Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        $animals = Animal::findOrFail($id);
        $destination = "uploads/animals/" . $animals->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $animals->forceDelete();
        return Redirect::route("animals.index")->with(
            "success",
            "Animal Data Permanently Deleted!"
        );
    }
}
