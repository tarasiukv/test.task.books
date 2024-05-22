<?php

namespace App\Http\Controllers\Api;

use App\Entities\Publisher;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;
use App\Http\Resources\PublisherResource;
use Doctrine\ORM\EntityManagerInterface;

class PublisherController extends Controller
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function index()
    {
        $authors = $this->entityManager->getRepository(Publisher::class)->findAll();
        return PublisherResource::collection($authors);
    }

    public function show($id)
    {
        $author = $this->entityManager->getRepository(Publisher::class)->find($id);

        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }

        return new PublisherResource($author);
    }

    public function store(PublisherRequest $request)
    {
        $author = new Publisher();
        $author->setName($request->name);
        $this->entityManager->persist($author);
        $this->entityManager->flush();

        return new PublisherResource($author);
    }

    public function update(PublisherRequest $request, $id)
    {
        $author = $this->entityManager->getRepository(Publisher::class)->find($id);

        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }
        $author->setName($request->name);
        $this->entityManager->flush();

        return new PublisherResource($author);
    }

    public function destroy($id)
    {
        $author = $this->entityManager->getRepository(Publisher::class)->find($id);
        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }
        $this->entityManager->remove($author);
        $this->entityManager->flush();

        return response()->json(null, 204);
    }
}
