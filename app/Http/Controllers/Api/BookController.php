<?php

namespace App\Http\Controllers\Api;

use App\Entities\Book;
use App\Entities\Publisher;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Entities\Author;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $totalBooks = $this->entityManager->getRepository(Book::class)->count([]);

        $query = $this->entityManager->getRepository(Book::class)
            ->createQueryBuilder('b')
            ->setFirstResult(($page - 1) * $perPage)
            ->setMaxResults($perPage)
            ->getQuery();

        $books = $query->getResult();

        $paginatedBooks = [
            'data' => BookResource::collection($books),
            'meta' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $totalBooks,
                'total_pages' => ceil($totalBooks / $perPage),
            ]
        ];

        return response()->json($paginatedBooks);
    }

    public function show($id)
    {
        $book = $this->entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            return response()->json(['error' => 'Author not found'], 404);
        }

        return new BookResource($book);
    }

    public function store(BookRequest $request)
    {
        $book = new Book();

        $book->setTitle($request->title);
        $book->setPrice($request->price);
        $book->setStatus($request->status);

        $author = $this->entityManager->getRepository(Author::class)->find($request->author_id);
        if ($author) {
            $book->setAuthor($author);
        }

        $publisher = $this->entityManager->getRepository(Publisher::class)->find($request->publisher_id);
        if ($publisher) {
            $book->setPublisher($publisher);
        }

        $this->entityManager->persist($book);
        $this->entityManager->flush();

        return new BookResource($book);
    }

    public function update(BookRequest $request, $id)
    {
        $book = $this->entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            return response()->json(['error' => 'Author not found'], 404);
        }

        $book->setTitle($request->title);
        $book->setPrice($request->price);
        $book->setStatus($request->status);

        $author = $this->entityManager->getRepository(Author::class)->find($request->author_id);
        if ($author) {
            $book->setAuthor($author);
        }

        $publisher = $this->entityManager->getRepository(Publisher::class)->find($request->publisher_id);
        if ($publisher) {
            $book->setPublisher($publisher);
        }

        $this->entityManager->flush();


        return new BookResource($book);
    }

    public function destroy($id)
    {
        $book = $this->entityManager->getRepository(Book::class)->find($id);
        if (!$book) {
            return response()->json(['error' => 'Author not found'], 404);
        }
        $this->entityManager->remove($book);
        $this->entityManager->flush();

        return response()->json(null, 204);
    }
}
