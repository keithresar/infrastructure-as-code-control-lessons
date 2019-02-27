<?php


/* require all files listed in the directory */
function DirLoader($directory,$name)
{
	if ($loader_dir = dir($directory))  {
   		while ($loader_file = $loader_dir->read()) {
			if (preg_match('/\.php$/', $loader_file) > 0)  include($directory . "/" . $loader_file);
		}
	}
}


function FileLoader($directory,$file)
{
	if (file_exists($directory . "/" . $file . ".php"))  {
		include($directory . "/" . $file . ".php");
		return(1);
	}  else  {
		return(0);
	}
}


function FileLoaderJs($directory,$file)
{
	if (file_exists($directory . "/" . $file . ".js"))  {
		include($directory . "/" . $file . ".js");
		return(1);
	}  else  {
		return(0);
	}
}


function FileLoaderModules($directory,$file)
{
	if (file_exists($directory . "/" . $file . ".php"))  {
		include($directory . "/" . $file . ".php");
		return(1);
	}  else  {
		return(0);
	}
}


function RunModule($name)
{
	$ret = FileLoader("modules",$name);
	if (!$ret)  {
		Error(ERROR,
	          "Unable to access required file.  This error has been logged",
			  "Requested module $name does not exist");
		return(0);
	}

	eval("$name();");

	return(1);
}


?>
