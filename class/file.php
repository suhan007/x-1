<?php



class file {

	/**
	 *  @brief append some content into file
	 *  
	 *  @param [in] $filename file name(path) to append
	 *  @param [in] $somecontent some content to append
	 *  @return 0 if success otherwise false.
	 *  
	 *  @details This code is coming from PHP document.
	 */
	static function append($filename, $somecontent)
	{
			// In our example we're opening $filename in append mode.
			// The file pointer is at the bottom of the file hence
			// that's where $somecontent will go when we fwrite() it.
			if (!$handle = fopen($filename, 'a')) {
				 return -1;
			}

			// Write $somecontent to our opened file.
			if (fwrite($handle, $somecontent) === FALSE) {
				return -2;
			}

			// echo "Success, wrote ($somecontent) to file ($filename)";

			fclose($handle);
			return 0;
	}
}
