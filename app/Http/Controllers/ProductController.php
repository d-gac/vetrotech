<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * @OA\Tag(
     *     name="Produkt",
     *     description="Zarządzanie produktami",
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/product",
     *     tags={"Produkt"},
     *     summary="Wyświetl listę produktów",
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
     *   ),
     *
     * )
     */


    /**
     * @return Collection
     */
    public function index():Collection
    {
        return Product::all();
    }

    /**
     * @OA\Get(
     *     path="/api/product/{id}",
     *     tags={"Produkt"},
     *     summary="Wyświetl produkt",
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
     *     description="An ""unexpected"" error"
     *      ),
     *
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     * )
     */


    /**
     * @param int $id
     *
     * @return Product
     */
    public function show(int $id):Product
    {
            return Product::findOrFail($id)
                ->where('id', $id)
                ->first();
    }

    /**
     * @OA\Post (
     *     path="/api/product",
     *     tags={"Produkt"},
     *     summary="Dodaj produkt",
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *     oneOf={
     *      @OA\Schema(type="boolean")
     *           }
     *      ),
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="An ""unexpected"" error"
     *      ),
     *
     *     @OA\RequestBody(
     *
     *        @OA\JsonContent(
     *             type="object",
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Przykładowa nazwa produktu"
     *                      ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="Przykładowy opis produktu"
     *                      ),
     *                      @OA\Property(
     *                         property="status",
     *                         type="string",
     *                         example="1"
     *                      ),
     *        )
     *     ),
     * )
     */


    /**
     * @param ProductRequest $request
     *
     * @return Product
     */
    public function store(ProductRequest $request):Product
    {
        $newItem = new Product;
        $newItem->name = $request->get("name");
        $newItem->description = $request->get("description");
        $newItem->status = $request->get("status");
        $newItem->save();

        return $newItem;
    }

    /**
     * @OA\Put(
     *     path="/api/product/{id}",
     *     tags={"Produkt"},
     *     summary="Edytuj produkt",
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *     oneOf={
     *      @OA\Schema(type="boolean")
     *           }
     *      ),
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
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *        @OA\JsonContent(
     *             type="object",
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Przykładowa zmieniona nazwa produktu"
     *                      ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="Przykładowy zmieniony opis produktu"
     *                      ),
     *                      @OA\Property(
     *                         property="status",
     *                         type="string",
     *                         example="0"
     *                      ),
     *        ),
     *     ),
     * )
     */

    /**
     * @param ProductRequest $request
     * @param int $id
     *
     * @return Product
     */
    public function update(ProductRequest $request, int $id):Product
    {
        $newItem = Product::find($id);
        $newItem->update($request->all());
        return $newItem;
    }

    /**
     * @OA\Delete(
     *     path="/api/product/{id}",
     *     tags={"Produkt"},
     *     summary="Usuń produkt",
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
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     * )
     */


    /**
     * @param int $id
     *
     * @return Product
     */
    public function destroy(int $id):String
    {
        if (Product::find($id)) {
            Product::destroy($id);
            return "Pomyślnie usunięto produkt (ID: " . $id . ")";
        } else {
            return "Produkt (ID: " . $id . ") nie istnieje";
        }
    }


    /**
     * @OA\Tag(
     *     name="Usunięte produkty",
     *     description="Zarządzanie usuniętymi produktami",
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/product/allProduct",
     *     tags={"Usunięte produkty"},
     *     summary="Lista wszystkich utworzonych produktów",
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
     * )
     */


    /**
     * @return Collection
     */
    public function allProduct():Collection
    {
        return Product::withTrashed()->get();
    }


    /**
     * @OA\Get(
     *     path="/api/product/deleted",
     *     tags={"Usunięte produkty"},
     *     summary="Lista usuniętych produktów",
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
     * )
     */


    /**
     * @return Collection
     */
    public function deleted():Collection
    {
        return Product::onlyTrashed()->get();
    }

    /**
     * @OA\Get(
     *     path="/api/product/renew/{id}",
     *     tags={"Usunięte produkty"},
     *     summary="Przywróć produkt",
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
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     * )
     */


    /**
     * @param int $id
     *
     * @return String
     */
    public function renew(int $id):String
    {
        $item = Product::onlyTrashed()
            ->where('id', $id)
            ->first();
        if ($item) {
            Product::where('id', $id)->restore();
            return "Produkt (ID: " . $id . ") został przywrócony";
        } else {
            return "Produkt (ID: " . $id . ") nie został wcześniej usunięty lub nie istnieje";
        }
    }
}
