<?php
class Controller {
    protected function render(string $view, array $data = []): void {
        extract($data);
        $viewFile = __DIR__ . "/../Views/$view.php";
        if(file_exists($viewFile)){
            require $viewFile;
        } else {
            echo "View $view not found!";
        }
    }

    protected function json(array $data): void {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}
