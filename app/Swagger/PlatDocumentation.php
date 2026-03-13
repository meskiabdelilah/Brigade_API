<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class PlatDocumentation
{
    #[OA\Get(
        path: "/api/plats",
        summary: "Get all plats for authenticated user",
        tags: ["Plats"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of plats",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Plat")
                )
            ),
            new OA\Response(
                response: 401,
                description: "Unauthenticated"
            )
        ]
    )]
    public function index() {}

    #[OA\Get(
        path: "/api/plats/{id}",
        summary: "Get a single plat by ID",
        tags: ["Plats"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "ID of the plat",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Plat details",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Plat"
                )
            ),
            new OA\Response(
                response: 401,
                description: "Unauthenticated"
            ),
            new OA\Response(
                response: 403,
                description: "Forbidden"
            ),
            new OA\Response(
                response: 404,
                description: "Plat not found"
            )
        ]
    )]
    public function show() {}

    #[OA\Post(
        path: "/api/plats",
        summary: "Create a new plat",
        tags: ["Plats"],
        security: [["sanctum" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: "object",
                properties: [
                    new OA\Property(
                        property: "name",
                        type: "string",
                        maxLength: 250
                    ),
                    new OA\Property(
                        property: "price",
                        type: "number",
                        format: "float"
                    ),
                    new OA\Property(
                        property: "photo",
                        type: "string",
                        format: "binary",
                        nullable: true
                    )
                ],
                required: ["name","price"]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Plat created successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Plat"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Validation error"
            ),
            new OA\Response(
                response: 401,
                description: "Unauthenticated"
            )
        ]
    )]
    public function store() {}

    #[OA\Put(
        path: "/api/plats/{id}",
        summary: "Update a plat",
        tags: ["Plats"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "ID of the plat to update",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: "object",
                properties: [
                    new OA\Property(
                        property: "name",
                        type: "string",
                        maxLength: 250
                    ),
                    new OA\Property(
                        property: "price",
                        type: "number",
                        format: "float"
                    )
                ],
                required: ["name","price"]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Plat updated successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Plat"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Validation error"
            ),
            new OA\Response(
                response: 401,
                description: "Unauthenticated"
            ),
            new OA\Response(
                response: 403,
                description: "Forbidden"
            ),
            new OA\Response(
                response: 404,
                description: "Plat not found"
            )
        ]
    )]
    public function update() {}

    #[OA\Delete(
        path: "/api/plats/{id}",
        summary: "Delete a plat",
        tags: ["Plats"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "ID of the plat to delete",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Plat deleted successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Plat"
                )
            ),
            new OA\Response(
                response: 401,
                description: "Unauthenticated"
            ),
            new OA\Response(
                response: 403,
                description: "Forbidden"
            ),
            new OA\Response(
                response: 404,
                description: "Plat not found"
            )
        ]
    )]
    public function destroy() {}
}