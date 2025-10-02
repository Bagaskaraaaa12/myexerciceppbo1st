<?php
class NoteHelper {
    public static function countImportant(array $notes): int {
        return count(array_filter($notes, fn($n)=>$n->isImportant()));
    }

    public static function filterByKeyword(array $notes, string $keyword): array {
        return array_filter($notes, fn($n)=>stripos($n->getTitle(),$keyword)!==false || stripos($n->getContent(),$keyword)!==false);
    }
}
