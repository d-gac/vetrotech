<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * @OA\Tag(
     *     name="Products",
     *     description="Products Management",
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/product",
     *     tags={"Products"},
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
     *
     *
     * )
     */

    public function index()
    {
        return Product::all();
    }

    /**
     * @OA\Get(
     *     path="/api/product/{id}",
     *     tags={"Products"},
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

    public function show($id)
    {
        if (Product::find($id)) {
            $var = Product::findOrFail($id)
                ->where('id', $id)
                ->first();
            return $var;
        } else {
            return "Produkt (ID: " . $id . ") nie istnieje";
        }

    }

    /**
     * @OA\Post (
     *     path="/api/product",
     *     tags={"Products"},
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

    public function store(ProductRequest $request)
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
     *     tags={"Products"},
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

    public function update(ProductRequest $request, $id)
    {
        $newItem = Product::find($id);
        if (!$newItem) {
            return "Produkt (ID: " . $id . ") nie istnieje";
        } else {
            $newItem->update($request->all());
            return $newItem;
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/product/{id}",
     *     tags={"Products"},
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

    public function destroy($id)
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
     *     name="Deleted products",
     *     description="Deleted products Management",
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/product/allProduct",
     *     tags={"Deleted products"},
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

    public function allProduct()
    {
        return Product::withTrashed()->get();
    }


    /**
     * @OA\Get(
     *     path="/api/product/deleted",
     *     tags={"Deleted products"},
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

    public function deleted()
    {
        return Product::onlyTrashed()->get();
    }

    /**
     * @OA\Get(
     *     path="/api/product/renew/{id}",
     *     tags={"Deleted products"},
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

    public function renew($id)
    {
        $item = Product::onlyTrashed()
            ->where('id', $id)
            ->first();
        if ($item) {
            Product::where('id', $id)->restore();
            return "Produkt (ID: " . $id . ") został przywrócony";
        } else {
            return "Produkt (ID: " . $id . ") nie został wcześniej usunięty";
        }
    }
}
