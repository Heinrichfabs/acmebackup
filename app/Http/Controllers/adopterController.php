<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\adopterRequest;
use App\Models\Animal;
use App\Models\Adopter;
class adopterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adopters = Adopter::leftJoin(
            "animal_adopter",
            "adopters.id",
            "=",
            "animal_adopter.adopter_id"
        )
            ->leftJoin(
                "animals",
                "animals.id",
                "=",
                "animal_adopter.animals_id"
            )
            ->select(
                "adopters.id",
                "adopters.first_name",
                "adopters.last_name",
                "adopters.phone_number",
                "adopters.images",
                "adopters.deleted_at",
                "animals.animal_name"
            )
            ->orderBy("adopters.id", "ASC")
            ->withTrashed()
            ->paginate(6);
        return view("adopters.index", ["adopters" => $adopters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals = Animal::pluck("animal_name", "id");
        return view("adopters.create", ["animals" => $animals]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(adopterRequest $request)
    {
        $adopters = new Adopter();
        $adopters->first_name = $request->input("first_name");
        $adopters->last_name = $request->input("last_name");
        $adopters->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/adopters/", $filename);
            $adopters->images = $filename;
        }
        $adopters->save();
        if ($request->animals_id) {
            foreach ($request->animals_id as $animals_id) {
                DB::table("animal_adopter")->insert([
                    "animals_id" => $animals_id,
                    "adopter_id" => $adopters->id,
                ]);
            }
        }
        return Redirect::to("/adopter")->with("success", "New Adopter Added!");
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
        $adopters = Adopter::find($id);

        $animal_adopter = DB::table("animal_adopter")
            ->where("adopter_id", $id)
            ->pluck("animals_id")
            ->toArray();

        $animals = Animal::pluck("animal_name", "id");
        return View::make(
            "adopters.edit",
            compact("adopters", "animal_adopter", "animals")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(adopterRequest $request, $id)
    {
        $adopters = Adopter::find($id);
        $animals_id = $request->animals_id;

        if (empty($animals_id)) {
            DB::table("animal_adopter")
                ->where("adopter_id", $id)
                ->delete();
        } else {
            DB::table("animal_adopter")
                ->where("adopter_id", $id)
                ->delete();
            foreach ($animals_id as $animal_id) {
                DB::table("animal_adopter")->insert([
                    "animals_id" => $animal_id,
                    "adopter_id" => $id,
                ]);
            }
        }

        $adopters->first_name = $request->input("first_name");
        $adopters->last_name = $request->input("last_name");
        $adopters->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $destination = "uploads/adopters/" . $adopters->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/adopters/", $filename);
            $adopters->images = $filename;
        }
        $adopters->update();
        return Redirect::to("/adopter")->with(
            "success",
            "Adopter Data Updated!"
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
        Adopter::destroy($id);
        return Redirect::to("/adopter")->with(
            "success",
            "Adopter Data Deleted!"
        );
    }

    public function restore($id)
    {
        Adopter::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("adopter.index")->with(
            "success",
            "Adopter Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        $adopters = Adopter::findOrFail($id);
        $destination = "uploads/adopters/" . $adopters->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $adopters->forceDelete();
        return Redirect::route("adopter.index")->with(
            "success",
            "Adopter Data Permanently Deleted!"
        );
    }
}
