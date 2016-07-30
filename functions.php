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

// Get all values from specific key in a multidimensional array
function array_value_recursive($key, array $arr){
    $val = array();
    array_walk_recursive($arr, function($v, $k) use($key, &$val){
        if($k == $key) array_push($val, $v);
    });
    return count($val) > 1 ? $val : array_pop($val);
};

// Organizing all lists in alphabetical order 
foreach ($topics as $topic) {
    sort($topic["itens"], SORT_STRING);
};
// Adding the App Title
function the_title() { ?>
    <h1 class='text-primary animated bounceIn' style='color:white;'>WORKFLOW <i class='glyphicon glyphicon-ok'></i></h1><br/>
<?php };

// Adding a message to the App
function the_message() { ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3>WELCOME TO THE WORKFLOW CHECKLIST</h3>
            <p>Hi, and thank you for giving Workflow a try. This app is still in early stages of development, so expect to see many bugs here and there.</p>
            <p>Below, you'll find an automated checklist, generated with the projects and lists that you configured in the config.php file. If you didn't, you should check it right away. This app will create folder based on the list and monitor them for changes, especifically the file types that you've configured for each on of the them.</p>
            <br/>
            <h3>USAGE INSTRUCTIONS</h3>
            <ol>
                <li>
                    <p>Configure the app, access the site once, and access your ftp.</p>
                        
                </li>
                <li>
                    <p>You'll then see a relation of folders, named by category. Inside each one of them, there will be more folder, named after each item inside the category.</p>
                </li>
                <li>
                    <p>Upload the files requested in it's respective folder. The accepted formats for now are *.jpg and *.png for images, *.mov, *.avi, *.mpg for videos, *.doc, *.pdf for adobe pdf, and *.docx or *.odt for documents.</p>
                </li>
                <li>
                    <p>After submitting the files, they'll have their status automatically updated by the app, each respective box will change it's color to yellow, awaiting for a technical revision, to see if everything is ok.</p>
                </li>
                <li>
                    <p>If not problems are found, the box will turn to green after avaliation. Otherwise, one observation will be show in the footer of the box, explaining what needs to be corrected.</p>
                </li>
            </ol>
        </div>
    </div>
<?php };

// The content generator
function the_checklist($topics) {
    // Running through the list of all arrays for the checklist generator
    foreach ($topics as $topic) {
        
        // Printing the array name as title
        print "<div class='row'><div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center'><br/><br/><h2 class='text-left animated fadeIn'>" . $topic["name"] . "</h2><br/><hr class='animated fadeIn' style='border-width:0.3em;border-color:#444444;position:relative;top:-4em;'/></div></div><div class='row'>";
        
        // Checking the array for topic description
        if (isset($topic["description"])) {
            $itemdesc = $topic["obs"];
        } else {
            $itemdesc = null;
        }
        
        // Printing the topic description, if any
        if (isset($itemdesc)) {   
            print "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>" . $itemdesc . "</div><div class='row'>";
        }

        // Running through the itens array
        foreach ($topic["itens"] as $item) {

            // Checking if the directory exists
            if (!file_exists("_" . clean($topic["dir"]) . "/" . clean($item) . "/") && !is_dir("_" . clean($topic["dir"]) . "/" . clean($item) . "/")) {
                mkdir("_" . clean($topic["dir"]) . "/" . clean($item) . "/", 0777, true);
            };
            
            // Checking the file types configured to the list
            $filecheck = null;
            $filecheckbox = null;
            $filelist = null;
            foreach ($topic["filetypes"] as $filetype) {
                $filetypecheckbox = "<span>" . $filetype["name"] . ": </span><input type='checkbox' disabled readonly>";
                foreach ($filetype["extensions"] as $extension) {
                    foreach (glob("_" . clean($topic["dir"]) . "/" . clean($item) . "/" . $extension) as $filepath) {
                        if ($filepath) {
                            $filecheck = $extension;
                        }
                        $filelist .= $filepath . "<br/>";
                        if (isset($filecheck)) {
                            $filetypecheckbox = "<span>" . $filetype["name"] . ": </span><input type='checkbox' checked='checked' disabled readonly>";
                        }
                    } 
                }
                $filecheckbox .= $filetypecheckbox;
            }; 
        

            // Checking the status of file submission and coloring the boxes **** NEEDS FIXING *****
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
            print "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 text-center'><div class='panel " . $status . " animated bounceInUp'><div class='panel-heading'><span class='lead'><strong>" . $item . " " . $statusicon . "</strong></span></div><div class='panel-body'>" . $filecheckbox . "<br/><br/>" . $filelist . "</div><div class='panel-footer'><" . $obsstatus . "><small>" .$obs . "</small></" . $obsstatus . "></div></div></div><div class='clearfix visible-xs-block'></div>";
        };
        print "</div>";
    };
};

?>