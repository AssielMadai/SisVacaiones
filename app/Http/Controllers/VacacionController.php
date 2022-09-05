<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vacacion;
use PDF;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;


class VacacionController extends Controller
{
    //
    public function registrarVacacionVista($id){
        $user = DB::select(" select concat_ws(' ', primerNombre,segundoNombre,apellidoPaterno,apellidoMaterno) as nombre,
        timestampdiff(YEAR , fechaInicio, curdate()) as aniosTranscurridos
    from users
 where users.id=$id;");
        foreach ($user as $anio){
            if($anio->aniosTranscurridos <=5){
                $opcion1=15;
            }elseif ($anio->aniosTranscurridos >=6 && $anio->aniosTranscurridos <= 10){
                $opcion1=20;
            }elseif ($anio->aniosTranscurridos >=11){
                $opcion1=30;
            }
            return view('vacacion.registroVacacion', compact('user','opcion1','id'));
        }
    }

    public function registrarVacacion(Request $request,$id){
        $user= User::where("id","=","$id")->select("fechaInicio")->get();
        $fechaInicioVacacion= $request->input('fechaInicio');
        foreach ($user as $item)
            $anios= Carbon::createFromDate($item->fechaInicio)->age;
        if ($anios<=5){
            $fechaFin=$this->añadirDias($fechaInicioVacacion,30);
            $vacacion = new Vacacion();
            $vacacion->id=$id;
            $vacacion->fechaInicio=date('Y-m-d', strtotime($fechaInicioVacacion));
            $vacacion->fechaFin=$fechaFin;
            $vacacion->save();
        }elseif ($anios >=6 && $anios <=10){
            $fechaFin=$this->añadirDias($fechaInicioVacacion,30);
            $vacacion = new Vacacion();
            $vacacion->id=$id;
            $vacacion->fechaInicio=date('Y-m-d', strtotime($fechaInicioVacacion));
            $vacacion->fechaFin=$fechaFin;
            $vacacion->save();
        }elseif ($anios>=11){
            $fechaFin=$this->añadirDias($fechaInicioVacacion,30);
            $vacacion = new Vacacion();
            $vacacion->id=$id;
            $vacacion->fechaInicio=date('Y-m-d', strtotime($fechaInicioVacacion));
            $vacacion->fechaFin=$fechaFin;
            $vacacion->save();
        }
        return redirect(route('vistaRecibo',$vacacion->idVacacion));
    }

    public function añadirDias($fechaInicioVacacion,$dias){
        $fechaInicioVacacion = strtotime($fechaInicioVacacion);
        $diaSemana = min(date('N',$fechaInicioVacacion),5);
        $fechaInicioVacacion -= date('N',$fechaInicioVacacion) * 24 * 60 * 60;
        $semana = (floor( $dias / 5 ) * 2);
        $diasHabiles = $dias + $semana + $diaSemana;
        return date('Y-m-d', strtotime( date("Y-m-d", $fechaInicioVacacion) . " +$diasHabiles day") );
    }

    public function vistaRecibo($id){
        $recibo=DB::select(" select concat_ws(' ', primerNombre,segundoNombre,apellidoPaterno,apellidoMaterno) as nombre,
        v.fechaInicio as inicioVacacio, v.fechaFin as finVacacion
    from users
 join vacacion v on users.id = v.id
 where v.idVacacion=$id;");
        return view('vacacion.vistaRecibo',compact('recibo'));
    }

    public function VerUsuariosVacaciones(){
        $recibo=DB::select("select concat_ws(' ', primerNombre,segundoNombre,apellidoPaterno,apellidoMaterno) as nombre,
        v.fechaInicio as inicioVacacio, v.fechaFin as finVacacion
    from users
 join vacacion v on users.id = v.id;");
        return view('vacacion.usuarioVacacion',compact('recibo'));
    }
    public function recibo(){
        $recibos=DB::select("select concat_ws(' ', primerNombre,segundoNombre,apellidoPaterno,apellidoMaterno) as nombre,
        v.fechaInicio as inicioVacacio, v.fechaFin as finVacacion
    from users
 join vacacion v on users.id = v.id;");

        $pdf = PDF::loadView('vacacion.recibo',['recibos'=>$recibos]);
//        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->download('invoice.pdf');;
    }

}
