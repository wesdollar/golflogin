<?php
require_once FRAMEWORK_PATH . 'Controller.class.php';
class AppController extends Controller
{
	var $models = array();

	function isConvertPossible ($tmp_name) {
		$can_convert = true;

		if (function_exists('memory_get_usage') && ini_get('memory_limit')) {
			$imageInfo = getimagesize($tmp_name);
			$MB = 1048576;
			$K64 = 65536;
			$TWEAKFACTOR = 1.6;
			$memoryNeeded = round(($imageInfo[0] * $imageInfo[1] * $imageInfo['bits'] * $imageInfo['channels'] / 8 + $K64) * $TWEAKFACTOR);
			$memoryNeeded = memory_get_usage() + $memoryNeeded;
			$memory_limit = ini_get('memory_limit');
			
			if ($memory_limit != '')
			{
				$memory_limit = substr($memory_limit, 0, -1) * 1024 * 1024;
			}
			
			if ($memoryNeeded > $memory_limit)
			{
				$memoryNeeded = round($memoryNeeded / 1024 / 1024, 2);
				$can_convert = false;
			}
		}

		return array('ok' => $can_convert, 'memory_needed' => $memoryNeeded, 'memory_limit' => $memory_limit);
	}

	function clearFilesArray ($global_files) {
		$files = array();
		
		foreach ($global_files as $k => $l)
		{
			foreach ($l as $i => $v)
			{
				if (!array_key_exists($i, $files))
				{
					$files[$i] = array();
				}
				
				$files[$i][$k] = $v;
			}
		}
		
		return $files;
	}
}
?>