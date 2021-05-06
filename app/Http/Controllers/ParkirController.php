<?php

namespace App\Http\Controllers;
use App\Models\Parkir;
use Illuminate\Http\Request;

class ParkirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Parkir::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_parkir' => 'required',
            'lokasi_parkir' => 'required',
            'harga' => 'required',
            'jarak' => 'required',
            'jam' => 'required',
            'rating' => 'required',
            'status_lahan' => 'required',
            'total_lahan' => 'required',
            'lahan_tersedia' => 'required',
            'lahan_tidak_tersedia' => 'required',
            'link_map' => 'required',
           'image_parkir' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            

        ]);

            // $file_name = time().'.'.$request->image_parkir->extension();
            // $request->image_parkir->move(public_path('images'),$file_name);

            // return Parkir::create($request->all());

          
    
      
    
            $input = $request->all();
            if ($image_parkir = $request->file('image_parkir')) {
                $destinationPath = 'image/';
                $profileImage = date('YmdHis') . "." . $image_parkir->getClientOriginalExtension();
                $image_parkir->move($destinationPath, $profileImage);
                $input['image_parkir'] = "$profileImage";
    
            }
    
        
    
            Parkir::create($input);
            $response = [
                'message'=>'Added Succesfully',
                'parkir' => $input,
                
                
            ];
    
             return response($response); 
            
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id_parkir
     * @return \Illuminate\Http\Response
     */
    public function show($id_parkir)
    {
        return Parkir::find($id_parkir);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_parkir
     * @param  \App\Parkir  $parkir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_parkir)
    {
        $parkir = Parkir::find($id_parkir);
        $parkir->update($request->all());
    // return $parkir;
    /*$request->validate([
        'nama_parkir' => 'required',
        'lokasi_parkir' => 'required',
        'harga' => 'required',
        'jarak' => 'required',
        'jam' => 'required',
        'rating' => 'required',
        'status_lahan' => 'required',
        'total_lahan' => 'required',
        'lahan_tersedia' => 'required',
        'lahan_tidak_tersedia' => 'required',
        'link_map' => 'required',
       'image_parkir' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        

    ]);
      /* $input = $request->all();

  

       if ($image_parkir = $request->file('image_parkir')) {
           $destinationPath = 'image/';
           $profileImage = date('YmdHis') . "." . $image_parkir->getClientOriginalExtension();
           $image_parkir->move($destinationPath, $profileImage);
           $input['image_parkir'] = "$profileImage";

       }else{
           unset($input['image_parkir']);

       }

         

       $parkir->update($input);*/
        $response = [
			'message'=>'Update Succesfully',
            'parkir' => $parkir,
            
			
        ];

         return response($response); /*

        $parkir = Parkir::find($id);
        if($request->hasFile('image_parkir')){
            $request->validate([
              'image_parkir' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image_parkir')->store('public/image');
            $parkir->image = $path;
        }
        $parkir->nama_parkir = $request->nama_parkir;
        $parkir->lokasi_parkir = $request->lokasi_parkir;
        $parkir->harga = $request->harga;
        $parkir->jarak = $request->jarak;
        $parkir->jam = $request->jam;
        $parkir->rating = $request->rating;
        $parkir->status_lahan = $request->status_lahan;
        $parkir->total_lahan = $request->total_lahan;
        $parkir->lahan_tersedia = $request->lahan_tersedia;
        $parkir->lahan_tidak_tersedia = $request->lahan_tidak_tersedia;
        $parkir->link_map = $request->link_map;
        $parkir->image_parkir = $request->image_parkir;
        $parkir->save();*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_parkir
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_parkir)
    {
        return Parkir::destroy($id_parkir);
        $response = [
			'message'=>'Delete Succesfully',
            
            
		
        ];
        return response($response);
    }

     /**
     * Search for a name
     *
     * @param  str  $nama_parkir
     * @return \Illuminate\Http\Response
     */
    public function search($nama_parkir)
    {
        $search = Parkir::where('nama_parkir', 'like', '%'.$nama_parkir.'%')->get();
        $response = [
			$search
            
		
        ];
        return response($response);

    }
}
