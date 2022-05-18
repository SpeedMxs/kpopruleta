<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Picture;
use App\Models\Grupos;
use Illuminate\Support\Facades\DB;
 
class CropImageController extends Controller
{
 
    public function uploadCropImage(Request $request)
    {
        $folderPath = public_path('upload/');
 
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        
        $imageName = uniqid() . '.png';
 
        $imageFullPath = $folderPath.$imageName;
 
        file_put_contents($imageFullPath, $image_base64);

        $nombre = $request->nombre;
        $grupo = $request->grupo;
        $saveFile = new Picture;
        $saveFile->name = $imageName;
        $saveFile->nombre = $nombre;
        $saveFile->grupo_id = $grupo;
        $saveFile->save(); 
    
        return response()->json(['success'=>'Integrante agregado']);
    }
    
    public function inicio()
    {
        $datgrupos=Picture::select('pictures.name','grupos.name as nameg')
        ->join('grupos', 'grupos.id', '=', 'pictures.grupo_id')
        ->where('pictures.nombre', 'LOGO')
        ->get('grupos.id');
        return view('inicio', compact('datgrupos'));
    }
    public function grupos(){
        $datgrupos=Grupos::select(['grupos.name as nameg',DB::raw('COUNT(pictures.grupo_id)-1 as num ')])
        ->join('pictures', 'grupos.id', '=', 'pictures.grupo_id')
        ->groupBy('grupos.name')
        ->get();
        $grupos = Grupos::All();
        $integrantes=Picture::All();
        return view('grupos', compact('datgrupos','grupos','integrantes'));
    }
    public function gruposcrear(Request $request ){

        $name=$request->nombregrupo;
        $tipo=$request->tipo;

        $saveFile = new Grupos;
        $saveFile->name = $name;
        $saveFile->tipo = $tipo;
        $saveFile->save();

        
        return redirect('/grupos');
    }

    public function index($nombre)
    {
        $nombres=Grupos::select('grupos.id')
        ->where('grupos.name',$nombre)->get();

        $integrantes=Picture::select('pictures.name','pictures.nombre')
        ->join('grupos','grupos.id','=','pictures.grupo_id')
        ->where('grupos.name',$nombre)
        ->get();
        return view('welcome',compact('integrantes','nombres','nombre'));
    }
    public function integrantes($name)
    {
        $integrantes=Picture::select('pictures.name','pictures.nombre','pictures.id')
        ->join('grupos', 'grupos.id', '=', 'pictures.grupo_id')
        ->where('grupos.name', $name)
        ->get();
        $tipo=Grupos::Where('name',$name)->get('tipo');
        
        return view('ruleta',compact('integrantes','name','tipo'));
    }
}
