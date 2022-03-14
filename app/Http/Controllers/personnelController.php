<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\personnelRequest;
use App\Http\Requests\personnelUpdateController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Personnel;

class personnelController extends Controller
{
    public function login()
    {
        return view("personnels.login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Request $req)
    {
        $check = Personnel::where("email", $req->email)->first();
        if ($check) {
            if (Hash::check($req->password, $check->password)) {
                $req->session()->put("id", $check->personnel_id);
                return redirect("dashboard");
            } else {
                return view("personnels.login");
            }
        } else {
            return view("personnels.login");
        }
    }

    public function dashboard()
    {
        $personnel = [];
        if (Session::has("id")) {
            $personnel = Personnel::where(
                "personnel_id",
                Session::get("id")
            )->first();
        }
        return view("personnels.dashboard", compact("personnel"));
    }

    public function logout()
    {
        if (Session::has("id")) {
            Session::pull("id");
            return redirect("login");
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personnels = Personnel::withTrashed()->paginate(5);
        //$personnels = Personnel::all();
        return view("personnels.index", [
            "personnels" => $personnels,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("personnels.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(personnelRequest $request)
    {
        $personnels = new Personnel();
        $personnels->full_name = $request->input("full_name");
        $personnels->email = $request->input("email");
        $personnels->password = Hash::make($request->input("password"));
        $personnels->role = $request->input("role");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/personnels/", $filename);
            $personnels->images = $filename;
        }
        $personnels->save();
        return Redirect::to("personnel");
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
    public function edit($personnel_id)
    {
        $personnels = Personnel::find($personnel_id);
        return view("personnels.edit")->with("personnels", $personnels);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(personnelUpdateController $request, $personnel_id)
    {
        $personnels = Personnel::find($personnel_id);
        $personnels->full_name = $request->input("full_name");
        $personnels->email = $request->input("email");
        $personnels->password = Hash::make($request->input("password"));
        $personnels->role = $request->input("role");
        if ($request->hasfile("images")) {
            $destination = "uploads/personnels/" . $personnels->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/personnels/", $filename);
            $personnels->images = $filename;
        }
        $personnels->update();
        return Redirect::to("personnel")->with(
            "update",
            "Personnel Data Updated!"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($personnel_id)
    {
        $personnels = Personnel::findOrFail($personnel_id);
        // $destination = 'uploads/personnels/'.$personnels->images;
        //if(File::exists($destination))
        //{
        //  File::delete($destination);
        // }
        $personnels->delete();
        return Redirect::to("personnel")->with(
            "delete",
            "Personnel Data Deleted!"
        );
    }

    public function restore($personnel_id)
    {
        Personnel::onlyTrashed()
            ->findOrFail($personnel_id)
            ->restore();
        return Redirect::route("personnel.index")->with(
            "restore",
            "Personnel Data Restored!"
        );
    }

    public function forceDelete($personnel_id)
    {
        Personnel::withTrashed()
            ->findOrFail($personnel_id)
            ->forceDelete();
        return Redirect::route("personnel.index")->with(
            "force",
            "Personnel Data Permanently Deleted!"
        );
    }
}
