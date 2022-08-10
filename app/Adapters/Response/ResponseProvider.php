<?php

namespace App\Adapters\Response;

use App\Adapters\Response\Contracts\ResponseProvider as ResponseInterface;
use App\Exceptions\ResponseCodes;
use App\Transformer\Contracts\Transformer;
use App\Transformer\Contracts\TransformerItem;
use App\Transformer\TransformerFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;

class ResponseProvider implements ResponseInterface
{
    private $header = ['Content-Type' => 'application/vnd.api+json', ];

    public function __construct(
        private ResponseFactory $responseFactory,
        private Transformer $transformer,
        private TransformerFactory $transformerFactory
    ) {
    }

    public function addHeader(array $header)
    {
        $this->header = array_merge($this->header, $header);
    }

    public function getCollection($items, string $type, string $includes = null)
    {
        $modelTransformer = $this->getModelTransformer($type);
        $items = $this->transformer->transformCollection($items, $modelTransformer, $type);

        return $this->responseFactory
            ->make($this->createData($items, $includes), ResponseCodes::OK_CODE)
            ->withHeaders($this->header);
    }

    public function getItem($item, string $type, string $includes = null)
    {
        $modelTransformer = $this->getModelTransformer($type);
        $item = $this->transformer->transformItem($item, $modelTransformer, $type);

        return $this->responseFactory
            ->make($this->createData($item, $includes), ResponseCodes::OK_CODE)
            ->withHeaders($this->header);
    }

    private function createData($data, string $includes = null): array
    {
        return $this->transformer->createData($data, $includes);
    }

    private function getModelTransformer(string $alias): TransformerItem
    {
        return $this->transformerFactory->buildTransformer($alias);
    }

    public function json($data = null, int $statusCode = 200): JsonResponse
    {
        return $this->responseFactory->json($data, $statusCode);
    }

    public function noContent(): JsonResponse
    {
        return $this->json(null, ResponseCodes::NO_CONTENT_CODE);
    }

    public function setArraySerializer(): void
    {
        $this->transformer->setDictionarySerializer();
    }
}
