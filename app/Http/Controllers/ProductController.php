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
     *     summary="Show list products",
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
     *     @OA\Post (
     *     path="/api/product",
     *     tags={"Products"},
     *     summary="Add product",
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
     *     @OA\RequestBody(
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
     *                         example="Przykładowa opis produktu"
     *                      ),
     *                      @OA\Property(
     *                         property="status",
     *                         type="string",
     *                         example="1"
     *                      ),
     *        ),
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
     *     @OA\Get(
     *     path="/api/product/{id}",
     *     tags={"Products"},
     *     summary="Show one product",
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
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     * )
     */

    public function show($id)
    {
//        if ($id){
//            return $id;
//        }
//        else
//        {
//            return "false";
//        }
        if (Product::find($id)){
            $var = Product::findOrFail($id)
                ->where('id', $id)
                ->first();
            return $var;
        }
        else {
            return "Produkt o tym ID nie istnieje";
        }

    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     *     @OA\Delete(
     *     path="/api/product/{id}",
     *     tags={"Products"},
     *     summary="Delete one product",
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
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     * )
     */

    public function destroy($id)
    {
        if (Product::find($id)){
            return Product::destroy($id);
        }
        else {
            return "Produkt o tym ID nie istnieje";
        }
    }
}
