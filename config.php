<?php

// File types array
$files => [
        "IMG" => ["name" => "IMG"], ["type" => ["*.jpg", "*.jpeg", "*.png", "*.raw"]], 
        "VIDS" => ["name" => "VID"], ["type" => ["*.mov", "*.mpg", "*.mpeg", "*.avi", "*.wmv"]], 
        "PDF" => ["name" => "PDF"], ["type" => ["*.pdf"]], 
        "DOCS" => ["name" => "DOCS"], ["type" => ["*.txt", "*.doc", "*.docx", "*.odt"]]
        ];

// Example project array for reference
$example = array(
    "name" => "Example", 
    "dir" => "example", 
    "itens" => ["Item A", "Item B", "Item C"]
);

// List of all arrays (Will become a function later)
$topics = array($example);

?>