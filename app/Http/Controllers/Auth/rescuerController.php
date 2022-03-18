<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\rescuerRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use App\Models\Rescuer;

class rescuerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rescuers = Rescuer::leftJoin(
            "animals",
            "rescuers.id",
            "=",
            "animals.rescuer_id"
        )
            ->select(
                "rescuers.id",
                "rescuers.first_name",
                "rescuers.last_name",
                "rescuers.phone_number",
                "rescuers.images",
                "rescuers.deleted_at",
                "animals.animal_name"
            )
            ->orderBy("rescuers.id", "ASC")
            ->withTrashed()
            ->paginate(6);
        return view("rescuers.index", ["rescuers" => $rescuers]);
        //return view("rescuers.index", compact("rescuers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make("rescuers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(rescuerRequest $request)
    {
        $rescuers = new Rescuer();
        $rescuers->first_name = $request->input("first_name");
        $rescuers->last_name = $request->input("last_name");
        $rescuers->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/rescuers/", $filename);
            $rescuers->images = $filename;
        }
        $rescuers->save();
        return Redirect::to("rescuer")->with("success", "New Rescuer Added!");
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
        $rescuers = Rescuer::find($id);
        return View::make("rescuers.edit", compact("rescuers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(rescuerRequest $request, $id)
    {
        $rescuers = Rescuer::find($id);
        $rescuers->first_name = $request->input("first_name");
        $rescuers->last_name = $request->input("last_name");
        $rescuers->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $destination = "uploads/rescuers/" . $rescuers->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/rescuers/", $filename);
            $rescuers->images = $filename;
        }
        $rescuers->update();
        return Redirect::to("rescuer")->with(
            "success",
            "Rescuer Data Updated!"
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
        Rescuer::destroy($id);
        return Redirect::to("rescuer")->with(
            "success",
            "Rescuer Data Deleted!"
        );
    }

    public function restore($id)
    {
        Rescuer::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("rescuer.index")->with(
            "success",
            "Rescuer Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        $rescuers = Rescuer::findOrFail($id);
        $destination = "uploads/rescuers/" . $rescuers->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $rescuers->forceDelete();
        return Redirect::route("rescuer.index")->with(
            "success",
            "Rescuer Data Permanently Deleted!"
        );
    }
}
