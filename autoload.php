<?php

namespace dpeh;

$ignoreFiles = [
	"autoload.php",
	"dp_elementor_helper.php",
	".i.php",
	".git",
	"readme.md",
	"update.php"
];
$ignoreFolders = [
	".git/",
	"theme/"
];


function getDirContents($dir, &$results = array()) {
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $results[] = $path;
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }

    return $results;
}

function endsWith( $haystack, $needle ) {
    $length = strlen( $needle );
    if( !$length ) {
        return true;
    }
    return substr( $haystack, -$length ) === $needle;
}


$files = getDirContents(__dir__);
$filtersFiles = [];

foreach($files as &$file){
	$file = str_replace("\\","/",$file);
	$addFile = true;

	foreach($ignoreFiles as &$iff){
		if(endsWith(strToLower($file),$iff)){
			$addFile = false;
		}
	}

	foreach($ignoreFolders as &$iFol){
		if(strpos(strToLower($file), $iFol) !== false){
			$addFile = false;
		}
		if(!endswith($file,".php")){
			$addFile = false;
		}
	}

	if($addFile == true){
		array_push($filtersFiles,$file);
	}
}

foreach($filtersFiles as &$file){
	if(strpos(strToLower($file), "lib") !== false){
		require_once($file);
	}
}

foreach($filtersFiles as &$file){
	if(strpos(strToLower($file), "lib") === false){
		require_once($file);
	}

}

?>
