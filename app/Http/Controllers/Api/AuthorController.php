<?php

namespace App\Http\Controllers\Api;

use App\Entities\Author;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use Doctrine\ORM\EntityManagerInterface;

class AuthorController extends Controller
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function index()
    {
        $authors = $this->entityManager->getRepository(Author::class)->findAll();
        return AuthorResource::collection($authors);
    }

    public function show($id)
    {
        $author = $this->entityManager->getRepository(Author::class)->find($id);

        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }

        return new AuthorResource($author);
    }

    public function store(AuthorRequest $request)
    {
        $author = new Author();
        $author->setName($request->name);
        $this->entityManager->persist($author);
        $this->entityManager->flush();

        return new AuthorResource($author);
    }

    public function update(AuthorRequest $request, $id)
    {
        $author = $this->entityManager->getRepository(Author::class)->find($id);

        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }
        $author->setName($request->name);
        $this->entityManager->flush();

        return new AuthorResource($author);
    }

    public function destroy($id)
    {
        $author = $this->entityManager->getRepository(Author::class)->find($id);
        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }
        $this->entityManager->remove($author);
        $this->entityManager->flush();

        return response()->json(null, 204);
    }
}
