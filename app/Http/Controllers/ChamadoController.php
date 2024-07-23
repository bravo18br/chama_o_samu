<?php

namespace App\Http\Controllers;

use App\Models\Cartao;
use App\Models\Chamado;
use App\Models\Foto;
use App\Models\Ip;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
// use IP2LocationLaravel;
use Ip2location\IP2LocationLaravel\Facade\IP2LocationLaravel;

use function App\Helpers\salvarLog;

class ChamadoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'cartoes_selecionados' => 'required'
        ]);
        $dadosRequest = $request->all();
        $dadosCompletos = array_merge($dadosRequest, ['situacao' => 4]);
        $chamado = Chamado::create($dadosCompletos);

        $userIp = $request->ip();
        $records = IP2LocationLaravel::get($userIp, 'bin');
        $ip = [];
        $ip['chamado_id'] = $chamado->id;
        $ip['user_ip'] = $records['ipAddress'];
        $ip['pais'] = $records['countryCode'];
        $ip['regiao'] = $records['regionName'];
        $ip['cidade'] = $records['cityName'];
        $ip['zip'] = $records['zipCode'];
        $ip['isp'] = $records['isp'];
        Ip::create($ip);

        $chamado->cartao()->syncWithoutDetaching($request->input('cartoes_selecionados'));
        $nivel1 = ['nivel1'];
        $auxiliares = ['voltar', 'cancelar', 'avancar', 'foto', 'registrar'];
        $cartoes_nivel1 = Cartao::whereIn('nivel', $nivel1)->get();
        $cartoes_auxiliares = Cartao::whereIn('nivel', $auxiliares)->get();
        return view('nivel1')->with([
            'cartoes_nivel1' => $cartoes_nivel1,
            'auxiliares' => $cartoes_auxiliares,
            'chamado_id' => $chamado->id
        ]);
    }
    public function put(Request $request)
    {
        try {
            $request_decoded = json_decode($request->getContent());
            $chamado_id = $request_decoded->chamado;
            if (property_exists($request_decoded, 'situacao')) {
                salvarLog('$request_decoded->situacao');
                $situacao = $request_decoded->situacao;
                $chamado = Chamado::findOrFail($chamado_id);
                $chamado->situacao = $situacao;
                $chamado->save();
                return response()->json([
                    'message' => 'Sucesso'
                ], 200);
            }
            if (property_exists($request_decoded, 'anotacao')) {
                salvarLog('$request_decoded->anotacao');
                $anotacao = $request_decoded->anotacao;
                $chamado = Chamado::findOrFail($chamado_id);
                $chamado->anotacao_samu .= $anotacao . "\n";
                $chamado->save();
                return response()->json([
                    'message' => 'Sucesso'
                ], 200);
            }
        } catch (Exception $error) {
            salvarLog('error' . $error);
        }
    }
    public function put_nivel1(Request $request)
    {
        $chamado = Chamado::findOrFail($request->chamado_id);
        $chamado->cartao()->syncWithoutDetaching($request->input('cartoes_selecionados'));

        $nivel2 = ['nivel2'];
        $auxiliares = ['voltar', 'cancelar', 'avancar', 'foto', 'registrar'];
        $cartoes_nivel2 = Cartao::whereIn('nivel', $nivel2)->get();
        $cartoes_auxiliares = Cartao::whereIn('nivel', $auxiliares)->get();
        return view('nivel2')->with([
            'cartoes_nivel2' => $cartoes_nivel2,
            'auxiliares' => $cartoes_auxiliares,
            'chamado_id' => $chamado->id
        ]);
    }
    public function put_nivel2(Request $request)
    {
        $chamado = Chamado::findOrFail($request->chamado_id);
        $chamado->cartao()->syncWithoutDetaching($request->input('cartoes_selecionados'));

        $nivel3 = ['nivel3'];
        $auxiliares = ['voltar', 'cancelar', 'avancar', 'foto', 'registrar'];
        $cartoes_nivel3 = Cartao::whereIn('nivel', $nivel3)->get();
        $cartoes_auxiliares = Cartao::whereIn('nivel', $auxiliares)->get();
        return view('nivel3')->with([
            'cartoes_nivel3' => $cartoes_nivel3,
            'auxiliares' => $cartoes_auxiliares,
            'chamado_id' => $chamado->id
        ]);
    }
    public function put_nivel3(Request $request)
    {
        $chamado = Chamado::findOrFail($request->chamado_id);
        $cartoes_nivel3 = Cartao::where('nivel', 'nivel3')->whereIn('id', $request->input('cartoes_selecionados'))->get();
        $chamado->cartao()->syncWithoutDetaching($cartoes_nivel3);
        $auxiliares = ['cancelar', 'foto', 'registrar'];
        $cartoes_auxiliares = Cartao::whereIn('nivel', $auxiliares)->get();
        return view('nivel4')->with([
            'auxiliares' => $cartoes_auxiliares,
            'chamado_id' => $chamado->id
        ]);
    }
    public function put_nivel4(Request $request)
    {
        $chamado = Chamado::findOrFail($request->chamado_id);
        $atualizacoes = $request->all();
        $atualizacoes['situacao'] = 1;
        $chamado->update($atualizacoes);

        if (!$chamado->foto->isEmpty()) {
            return redirect()->route('monitoramento')->withErrors(['error' => 'O chamado já possui fotos.']);
        }

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('fotos', 'local');
                $url = Storage::url($path);
                $foto = Foto::create([
                    'chamado_id' => $chamado->id,
                    'nome' => $foto->hashName(),
                    'caminho' => $path,
                ]);
                Log::channel('integrado')->info('Foto path interno: ' . $path);
                Log::channel('integrado')->info('Foto path public: ' . $url);
            }
        }
        return redirect()->route('monitoramento');
    }
}
