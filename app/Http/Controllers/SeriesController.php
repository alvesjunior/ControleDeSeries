<?php


namespace App\Http\Controllers;


use App\Episodio;
use App\Http\Requests\SeriesRequest;
use App\Mail\NovaSerie;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use App\Temporada;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $series = Serie::query()
            ->orderBy('nome')
            ->get();
        $mensagem = $request->session()->get('mensagem');
        $classBootstrap = $request->session()->get('classBootstrap');


        return view('series.index', compact('series', 'mensagem', 'classBootstrap'));

    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesRequest $request,
                          CriadorDeSerie $criadorDeSerie)
    {
        $request->file('capa')->store('public/serie');

        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporadas,
            $request->capa);

        $request->session()
            ->flash('mensagem',
                "Serie {$serie-> id} {$serie->nome} e suas temporas e episódios criados com sucesso.");
        $request->session()
            ->flash('classBootstrap',
                "alert-success");

        $users = User::all();

        foreach ($users as $user) {
            $email = new NovaSerie(
                $request->nome,
                $request->qtd_temporadas,
                $request->ep_por_temporadas
            );
            $email->subject = "Nova Série Adicionada";

            Mail::to($user)->queue($email);

        }


        return redirect('/series');


        /*
          $serie = Serie::create([
                    'nome' => $nome
                ]);
         $nome = $request->nome;
        echo "Serie com id: {$serie-> id} criada {$serie->nome}";
        */

    }

    public function editarNome(Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($request->id);
        $serie->nome = $novoNome;
        $serie->save();


    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeDaSerie = $removedorDeSerie->removerSerie($request->id);

        $request->session()
            ->flash('mensagem',
                "Série $nomeDaSerie excluida com sucesso");
        $request->session()
            ->flash('classBootstrap',
                "alert-danger");

        return redirect()->route('listar_series');
    }


}
