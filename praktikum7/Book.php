<?php
trait Timestampable {
    public function getCreatedAt(): string {
        return date('Y-m-d H:i:s');
    }
}

interface Lendable {
    public function lend(): void;
    public function returnBook(): void;
}

abstract class AbstractBook {
    abstract public function getInfo(): string;
}

class Book extends AbstractBook implements Lendable, JsonSerializable {
    use Timestampable;

    private string $id;
    private string $title;
    private string $author;
    private bool $isBorrowed = false;

    public const CATEGORY = "Library";

    public function __construct(string $title, string $author) {
        $this->id = uniqid("book_");
        $this->title = $title;
        $this->author = $author;
    }

    // Encapsulation
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $t): void { $this->title = $t; }

    // Polymorphism
    public function getInfo(): string {
        return "{$this->title} oleh {$this->author}";
    }

    // Interface
    public function lend(): void { $this->isBorrowed = true; }
    public function returnBook(): void { $this->isBorrowed = false; }

    // Magic methods
    public function __toString(): string {
        return $this->getInfo();
    }

    public function __clone() {
        $this->id = uniqid("book_");
    }

    public function jsonSerialize(): mixed {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "author" => $this->author,
            "borrowed" => $this->isBorrowed,
            "category" => self::CATEGORY,
            "created" => $this->getCreatedAt()
        ];
    }
}

class BookCollection implements IteratorAggregate {
    private array $books = [];

    public function add(Book $b): void {
        $this->books[] = $b;
    }

    public function remove(string $id): void {
        $this->books = array_filter($this->books, fn($b) => $b->jsonSerialize()["id"] !== $id);
    }

    public function getIterator(): Traversable {
        return new ArrayIterator($this->books);
    }

    public function all(): array {
        return $this->books;
    }
}
