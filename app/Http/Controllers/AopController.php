<?php

namespace App\Http\Controllers;

use App\Http\Requests\AopRequest;
use App\Models\Aop;
use App\Models\EstadoAop;
use App\Models\EstadoAopRel;
use App\Models\RepresentanteAopRel;
use App\Models\SubSector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AopController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:verFichaAOP')->only('mostrarFichaAOP');
        $this->middleware('can:verificasiAop')->only('evaluacionImpactoAmbiental','controlAmbiental');
        $this->middleware('can:registraAop')->only('registrarAopVista','registraAopFun');
    }

    public function evaluacionImpactoAmbiental()
    {
        if (auth()->user()->hasRole('Recepcionista')) {
            $aops = DB::select("
select m.nombre as munincipio,
       c.nombre as categoria,
       s.nombre as nombreSector,
       aops.nombre as nombreAop,
       concat_ws(' / ',aops.nit,aops.codigoCatastral) as nitCodigo,
       aops.licencia as tieneLicencia,
       aops.idAop as id
from aops join municipios m on aops.idMunicipio = m.idMunicipio
    join categorias c on aops.idCategoria = c.idCategoria
    join sub_sectores ss on aops.idSubSector = ss.idSubSector
    join sectores s on ss.idSector = s.idSector
where aops.licencia=0;");
            return view('aop.EIAverificaAop', compact('aops'));
        } elseif (auth()->user()->hasRole('Jefe de Unidad')) {
            return redirect()->route('mostrarAopEIA');
        } elseif (auth()->user()->hasRole('Legal')) {
            return redirect()->route('vistaMenuRevisionEIA');
        }elseif (auth()->user()->hasRole('Tecnico')) {
            return redirect()->route('vistaMenuRevisionTecnicoEIA');
        } else {
            return "No tiene permisos";
        }
    }

    public function controlAmbiental(){
        if (auth()->user()->hasRole('Recepcionista')) {
            $aops = DB::select("
            select m.nombre as munincipio,
                       c.nombre as categoria,
                       s.nombre as nombreSector,
                       aops.nombre as nombreAop,
                        aops.idAop as idAop,
                       concat_ws(' / ',aops.nit,aops.codigoCatastral) as nitCodigo
                from aops
                join municipios m on aops.idMunicipio = m.idMunicipio
                join categorias c on aops.idCategoria = c.idCategoria
                join sub_sectores ss on aops.idSubSector = ss.idSubSector
                join sectores s on ss.idSector = s.idSector
where aops.licencia=1;");
            return view('aop.controlAmbiental', compact('aops'));
        } elseif (auth()->user()->hasRole('Jefe de Unidad')) {
            return redirect()->route('mostrarAopCCA');
        } elseif (auth()->user()->hasRole('Legal')) {
            return redirect()->route('vistaMenuRevisionCCA');
        }elseif (auth()->user()->hasRole('Tecnico')) {
            return redirect()->route('vistaMenuRevisionTecnicoC');
        } else {
            return "No tiene permisos";
        }

    }
    public function registrarAopVista()
    {
        $categorias = DB::select("select nombre as nombreCategoria, idCategoria as idCategoria from categorias;");
        $sectores = DB::select("select idSector as idSector, nombre as nombreSector from sectores;");
        $representante = DB::select("select ciRepresentante as ci, idRepresentante as id from representantes;");
        $estadoAop = DB::select("select idEstadoAop as idEstado, estado as estado from estado_aops;");
        return view('aop.registrarAop', compact('categorias', 'sectores', 'representante', 'estadoAop'));
    }

    public function registraAopFun(AopRequest $request)
    {
        $municipio = 1;
        $aop = new Aop();
        $aop->idMunicipio = $municipio;
        $aop->idCategoria = $request->input('select-Categoria');
        $aop->idSubSector = $request->input('select-SubSector');

        switch ($request->input('select-Sector')){
            case 1:$aop->idFotoAop = 1;break;
            case 2:$aop->idFotoAop = 2;break;
            case 3:$aop->idFotoAop = 3;break;
            case 4:$aop->idFotoAop = 4;break;
            case 5:$aop->idFotoAop = 5;break;
            case 6:$aop->idFotoAop = 6;break;
            case 7:$aop->idFotoAop = 7;break;
            case 8:$aop->idFotoAop = 8;break;
            case 9:$aop->idFotoAop = 9;break;
            case 10:$aop->idFotoAop = 10;break;
            case 11:$aop->idFotoAop = 11;break;
            case 12:$aop->idFotoAop = 12;break;
            case 13:$aop->idFotoAop = 13;break;
            case 14:$aop->idFotoAop = 14;break;
            case 15:$aop->idFotoAop = 15;break;
            case 16:$aop->idFotoAop = 16;break;
            case 17:$aop->idFotoAop = 17;break;
            case 18:$aop->idFotoAop = 18;break;
            case 19:$aop->idFotoAop = 19;break;
            default: json_encode("No existe foto"); break;
        }
        $aop->nombre = ucwords($request->input('input-nombreAop'));
        $aop->nit = $request->input('input-NIT');
        $aop->codigoCatastral = $request->input('input-CodigoCatastral');
        $aop->activo = true;
        $aop->fechaRegistro = Carbon::now();
        $aop->licencia = 0;
        $aop->save();

        $idAop = $aop->idAop;

        $estado = new EstadoAopRel();
        $estado->idAop = $idAop;
        $estado->idEstadoAop = $request->input('select-Estado');
        $estado->save();

        $representante = new RepresentanteAopRel();
        $representante->idRepresentante= $request->input('representante');
        $representante->idAop=$idAop;
        $representante->save();

        return redirect()->route('mostrarFichaAOP', $idAop);
    }

    public function mostrarFichaAOP($id)
    {
        $aop = DB::select("select aops.idAop as idAop, aops.nombre as nombreAop, fechaRegistro as fecha,c.nombre as categoria,
       s.nombre as sectorNombre, ss.nombre as subsector,aops.licencia as licencia,
       if(aops.codigoCatastral is null,'no aplica',aops.codigoCatastral) as codigoCatastral,
       if(aops.nit is null ,'no aplica',aops.nit) as nit,ea.estado as estado, ear.fecha as fechaestado,m.nombre as municipio,p.nombre as provincia,fa.nombreFoto as foto
from aops
    join categorias c on aops.idCategoria = c.idCategoria
    join sub_sectores ss on aops.idSubSector = ss.idSubSector
    join sectores s on ss.idSector = s.idSector
    join estado_aops_rel ear on aops.idAop = ear.idAop
    join estado_aops ea on ear.idEstadoAop = ea.idEstadoAop
join municipios m on aops.idMunicipio = m.idMunicipio
join provincias p on m.idProvincia = p.idProvincia
join fotos_aop fa on aops.idFotoAop = fa.idFotoAop
where aops.idAop = $id;");

        $historialIrap=DB::select("select i.nombre as irap, t.fechaIngreso as fechaIngreso,if(t.cancelado=1, 'SI', 'NO') as cancelado,
       et.nombre as estado, a2.nombre as nombreArchivo, a2.documento as doc,a.codigoSecundario as idSec
from aops a
join tramites t on a.idAop = t.idAop
join estado_tramite_relacional etr on t.idTramite = etr.idTramite
join estado_tramite et on etr.idEstadoTramite = et.idEstadoTramite
join archivos a2 on t.idTramite = a2.idTramite
join iraps i on t.idIrap = i.idIrap
where a.idAop=$id");
        $irap = DB::select("select idIrap as idIrap, nombre as irap from iraps where tipoIrap='EIA';");

        return view('aop.EIAfichaAOP', compact( 'aop', 'irap','historialIrap'));
    }

    public function mostrarRegistroGeneralC($id)
    {
        $nombre = DB::select("
                    select nombre as nombreAop
                    from aops
                    where idAop = (select max(idAop) from aops)");

        $aop = DB::select("
     select aops.idAop as idAop, aops.nombre as nombreAop, nit as nit,
                               codigoCatastral as codigoCatastral,
                               fechaRegistro as fecha,
                               c.nombre as categoria,
                               s.nombre as sectorNombre,
                               ea.estado as estado,
                               aops.licencia as licencia,
                               case ea.estado
                                   when 'En Funcionamiento' then ea.fechaFuncionamiento
                                   when 'En Proyecto' then ea.fechaProyecto
                                   end as fecha
                        from aops
                        join categorias c on aops.idCategoria = c.idCategoria
                            join sub_sectores ss on aops.idSubSector = ss.idSubSector
                        join sectores s on ss.idSector = s.idSector
                        join estado_aops ea on aops.idAop = ea.idAop
                        where aops.idAop = $id;");

        $irapC = DB::select("select idIrap as idIrap, nombre as irap from iraps where tipoIrap='CCA';");

        return view('aop.registroGeneralControl', compact('nombre', 'aop','irapC'));
    }
    public function funcionFichaAop(){
        return view('aop.fichaAop');
    }

    public function verAOP(){
        $aop = DB::select("
     select aops.idAop as idAop, aops.nombre as nombreAop,
       fechaRegistro as fecha,
       c.nombre as categoria,
       s.nombre as sectorNombre,
       ss.nombre as subsector,
       aops.licencia as licencia,
       if(aops.codigoCatastral is null,'no aplica',aops.codigoCatastral) as codigoCatastral,
       if(aops.nit is null ,'no aplica',aops.nit) as nit,
       ea.estado as estado,
       ear.fecha as fechaestado,
       m.nombre as municipio,
       p.nombre as provincia
from aops
    join categorias c on aops.idCategoria = c.idCategoria
    join sub_sectores ss on aops.idSubSector = ss.idSubSector
    join sectores s on ss.idSector = s.idSector
    join estado_aops_rel ear on aops.idAop = ear.idAop
    join estado_aops ea on ear.idEstadoAop = ea.idEstadoAop
join municipios m on aops.idMunicipio = m.idMunicipio
join provincias p on m.idProvincia = p.idProvincia;");

        $sectores = DB::select("select idSector as idSector, nombre as nombreSector from sectores;");

        return view('aop.VerAop',compact('aop','sectores'));
    }
}
