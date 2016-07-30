<?php

// Filetypes arrays

$img = array(
            "name" => "IMG", 
            "extensions" => ["*.jpg", "*.jpeg", "*.png", "*.raw"]
            ); 
$vids = array(
            "name" => "VID", 
            "extensions" => ["*.mov", "*.mpg", "*.mpeg", "*.avi", "*.wmv"]
            );
$pdf = array(
            "name" => "PDF", 
            "extensions" => ["*.pdf"]
            ); 
$docs = array(
            "name" => "DOCS", 
            "extensions" => ["*.txt", "*.doc", "*.docx", "*.odt"]
            );

// Example project array for reference
$example = array(
    "name" => "Example",
    "description" => "This is an example section. Change this text to describe it.",
    "dir" => "example", 
    "itens" => ["Item A", "Item B", "Item C"],
    "filetypes" => [$img, $docs]
);

$example2 = array(
    "name" => "Example 2", 
    "dir" => "example2", 
    "itens" => ["Item A", "Item B", "Item C"],
    "filetypes" => [$img, $vids]
);

// List of all arrays (Will become a function later)
$topics = array($example, $example2);

?>