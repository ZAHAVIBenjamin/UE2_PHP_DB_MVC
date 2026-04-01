<?php
namespace App;

class View {
    public static function render(string $page, array $data = []) {
        $file = __DIR__ . '/../templates/' . $page . '.php';      
        
        if (file_exists($file)) {
            extract($data);
            $repo = new \App\Repository\RelationCQERepository();
            $allQuetes = $repo->getAllQuetesNames();       
            $pagesQuetes = array_map(function($nom) {
                return str_replace(' ', '', $nom);
            }, $allQuetes);
            $pagesSansLayout = array_merge($pagesQuetes, ['login', 'inscription']);
            if (in_array($page, $pagesSansLayout)) {
                require_once $file;
            } else {
                ob_start();
                require_once $file;
                $content = ob_get_clean();                
                require_once __DIR__ . '/../templates/layout.php';
            } 
        } else {
            echo "Page non trouvée : " . $page;
        }
    }
}