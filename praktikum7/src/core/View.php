<?php
class View {
    public static function render(string $view, array $data = []): void {
        extract($data);
        $file = __DIR__ . "/../Views/$view.php";
        if(file_exists($file)){
            require $file;
        } else {
            echo "View $view not found!";
        }
    }
}
