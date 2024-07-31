<?php

namespace App\Http\Controllers\admin;

use App\Exports\BannerExport;
use App\Http\Controllers\Controller;
use App\Imports\BannersImport;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get the banners with pagination
        $banners=Banner::orderBy('created_at', 'desc')->paginate(5);

        return view('banners.index', compact('banners'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'required|string',
            'imgUrl' => 'required|string'
        ]);

        $banner=new Banner();
        $banner->name = $request->input('name');
        $banner->details = $request->input('details');
        $banner->imgUrl = $request->input('imgUrl');
        $banner->save();

        Session::flash('message', 'Banner Added Successfully!');
        return response()->json(['banner'=> $banner]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $banner=Banner::find($id);

        return view('banners.view',compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $banner=Banner::find($id);

        return view('banners.update',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $banner=Banner::find($id);
        $request->validate([
            'name' => 'string|max:255',
            'details' => 'string',
            'imgUrl' => 'string'
        ]);

        $banner->name = $request->input('name');
        $banner->details = $request->input('details');
        $banner->imgUrl = $request->input('imgUrl');

        $banner->save();

        Session::flash('message','Banner Updated Successfully!');

        return response()->json(['banner'=>$banner, 'message'=>'Banner Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $banner=Banner::findorfail($id);

        $banner->delete($id);
//        Session::flash('message', 'banner is deleted Successfully!');
        return response()->json(['success'=> true]);
    }

    public function bannerStatus($id)
    {
        $banner=Banner::find($id);

        if($banner){
            $banner->status= !$banner->status;
            $banner->save();

        }

    }



//    get the active banners for showing in home page
    public function acitveBanners()
       {
          $banners=Banner::where('status',true)->get();

          return response()->json(['banners'=> $banners]);

      }

      public function exportBanner()
      {
          return Excel::download(new BannerExport, 'Banners.xlsx');
      }

      public function importBanners(Request $request)
      {
          $request->validate([
              'file' => 'required|mimes:xlsx,csv',
          ]);

          Excel::import(new BannersImport, $request->file('file'));

          Session::flash('message','Banners Imported');
          return back();

      }
}
