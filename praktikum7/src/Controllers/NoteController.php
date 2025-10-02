<?php
require_once __DIR__ . '/../Models/Note.php';
require_once __DIR__ . '/../Models/NoteCollection.php';
require_once __DIR__ . '/../Helpers/NoteHelper.php';
require_once __DIR__ . '/../Core/Controller.php';

class NoteController extends Controller {
    private NoteCollection $notes;

    public function __construct(string $storage) {
        $this->notes = new NoteCollection($storage);
    }

    public function index(): void {
        $allNotes = iterator_to_array($this->notes);
        $importantCount = NoteHelper::countImportant($allNotes);
        $this->render('notes/index', ['notes'=>$allNotes, 'importantCount'=>$importantCount]);
    }

    public function add(array $data): void {
        $note = new Note($data['title']??'', $data['content']??'', $data['important']??false);
        $this->notes->add($note);
        $this->json(['status'=>'ok']);
    }

    public function delete(string $id): void {
        $this->notes->delete($id);
        $this->json(['status'=>'ok']);
    }

    public function update(string $id, array $data): void {
        $this->notes->update($id, $data['title']??'', $data['content']??'');
        $this->json(['status'=>'ok']);
    }

    public function toggleImportant(string $id): void {
        $this->notes->toggleImportant($id);
        $this->json(['status'=>'ok']);
    }
}
