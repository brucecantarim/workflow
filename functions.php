<?php

include("config.php");

// Directory name formatter - Usage: clean($array["dir"])
setlocale(LC_ALL, 'en_US.UTF8');
function clean($str, $replace=array(), $delimiter='-') {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$cleanname = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$cleanname = preg_replace('#[^a-zA-Z0-9/_|+ -]#', '', $cleanname);
	$cleanname = strtolower(trim($cleanname, '-'));
	$cleanname = preg_replace('#[/_|+ -]+#', $delimiter, $cleanname);

	return $cleanname;
};

// Organizing all lists in alphabetical order 
foreach ($topics as $topic) {
    sort($topic["itens"], SORT_STRING);
};

// The content generator
function the_checklist() {
    // Running through the list of all arrays for the checklist generator
    foreach ($topics as $topic) {
        
        // Printing the array name as title
        print "<div class='row'><div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center'><br/><br/><h2 class='text-left animated fadeIn'>" . $topic["name"] . "</h2><br/><hr class='animated fadeIn' style='border-width:0.3em;border-color:#444444;position:relative;top:-4em;'/></div></div><div class='row'>";

        // Running through the itens array
        foreach ($topic["itens"] as $item) {

            // Checking if the directory exists
            if (!file_exists("_" . clean($topic["dir"]) . "/" . clean($item) . "/") && !is_dir("_" . clean($topic["dir"]) . "/" . clean($item) . "/")) {
                mkdir("_" . clean($topic["dir"]) . "/" . clean($item) . "/", 0777, true);
            };

            // Checking the file types configured to the list
            foreach ($topic["files"] as $file) {
                foreach ($file["type"] as $extension) {
                    $filelist += glob("_" . clean($topic["dir"]) . "/" . clean($item) . "/" . $extension);
                    if (!empty($filelist)) {
                        $filecheck += "<span>" . $filetype['name'] . ": </span><input type='checkbox' checked='checked' disabled readonly>";
                    } else {
                        $filecheck += "<span>" . $filetype['name'] . ": </span><input type='checkbox' disabled readonly>";
                    };
                }
            }

            // Checking the status of file submission and coloring the boxes
            if (!empty($imglist) AND !empty($pdflist) AND !empty($doclist)) {
                $status = "panel-success";
                $statusicon = "<i class='glyphicon glyphicon-ok'></i>";
            } else if (!empty($imglist) OR !empty($pdflist) OR !empty($doclist)) {
                $status = "panel-warning";
                $statusicon = "";
            } else {
                $status = "panel-danger";
                $statusicon = "";
            }

            // Checking the folder for comments
            if (file_exists("_" . clean($topic["dir"]) . "/" . clean($item) . '/_obs.txt')) {
                $obs = "<i class='glyphicon glyphicon-alert'></i> " . file_get_contents("_" . clean($topic["dir"]) . "/" . clean($item) . '/_obs.txt');
                $obsstatus = "strong";
            } else {
                $obs = "No observation about the files made yet.";
                $obsstatus = "span";
            }

            // Generating the checklist using the variables
            print "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 text-center'><div class='panel " . $status . " animated bounceInUp'><div class='panel-heading'><span class='lead'><strong>" . $item . " " . $statusicon . "</strong></span></div><div class='panel-body'>" . $filecheck . "</div><div class='panel-footer'><" . $obsstatus . "><small>" .$obs . "</small></" . $obsstatus . "></div></div></div><div class='clearfix visible-xs-block'></div>";
        };
        print "</div>";
    };
};

?>