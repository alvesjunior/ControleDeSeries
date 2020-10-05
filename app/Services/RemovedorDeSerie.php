<?php


namespace App\Services;


use App\{Episodio, Serie,Temporada};
use Illuminate\Support\Facades\DB;


class RemovedorDeSerie
{
    public function removerSerie(int $serieId) : string
    {
        $nomeDaSerie = '';
        DB::transaction(function() use($serieId, &$nomeDaSerie){
            $serie = Serie::find($serieId);
            $nomeDaSerie = $serie->nome;
            $this->removerSerieETemporada($serie);

            $serie->delete();
        });

        return $nomeDaSerie;
    }

    /**
     * @param $serie
     * @throws \Exception
     */
    private function removerSerieETemporada($serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerTemporadas($temporada);
            $temporada->delete();
        });
    }

    /**
     * @param Temporada $temporada
     */
    private function removerTemporadas(Temporada $temporada): void
    {
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}
