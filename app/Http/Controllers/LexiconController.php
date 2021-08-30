<?php

namespace App\Http\Controllers;

use App\Models\Lexicon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class LexiconController extends Controller
{
    // php artisan db:seed --class=LexiconSeeder -- all codes
    /**
     * @OA\Tag(
     *     name="Słownik",
     *     description="Zarządzanie słownikiem",
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/lexicon/{type}/{id}",
     *     tags={"Słownik"},
     *     summary="Wyświetl słownik",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *      ),
     *
     *     @OA\Parameter(
     *         in="path",
     *         name="type",
     *         required=true,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=false,
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     * )
     */

    /**
     * @param string $type
     * @param int|null $id
     *
     * @return Collection
     */
    public function lexicon(string $type, int $id = null): Collection
    {
        if ($id) {

            return Lexicon::where('type', $type)
                ->where('code_id', $id)
                ->where('status', 1)
                ->get();

        } else {

            return Lexicon::where('type', $type)
                ->where('status', 1)
                ->get();
        }
    }

}
