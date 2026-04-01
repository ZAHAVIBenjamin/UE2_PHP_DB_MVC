<?php 
namespace App\Utils;

use DateTime;
use Exception;

trait Hydrator {
    public function hydrate(array $data): void {
        foreach ($data as $key => $value) {
            $cleanKey = str_replace('_', ' ', strtolower($key));
            $method = 'set' . str_replace(' ', '', ucwords($cleanKey));
            if (method_exists($this, $method)) {
                if (is_string($value) && strpos(strtolower($key), 'date') !== false) {
                    try {
                        $value = new DateTime($value);
                    } catch (Exception $e) {
                        $value = null;
                    }
                }
                
                $this->$method($value);
            }
        }
    }
}