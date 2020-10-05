<?php


namespace App\Services;


use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie,
        int $qtd_temporadas,
        int $ep_temporada,
        ?string $capa): Serie
    {
        $serie = DB::transaction(function () use ($nomeSerie, $qtd_temporadas, $ep_temporada,$capa) {
            $serie = Serie::create([
                'nome' => $nomeSerie,
                'capa'=> $capa]);
            $qtdtemporadas = $qtd_temporadas;

            for ($i = 1; $i <= $qtdtemporadas; $i++) {
                $temporada = $serie->temporadas()->create(['numero' => $i]);

                for ($j = 1; $j <= $ep_temporada; $j++) {
                    $temporada->episodios()->create(['numero' => $j]);
                }
            }
            return $serie;
        });

        return $serie;
    }

}
