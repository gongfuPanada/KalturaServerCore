<?php
/**
 * @package Scheduler
 * @subpackage Cleanup
 */

/**
 * Will run periodically and cleanup directories from old files that have a specific pattern (older than x days) 
 *
 * @package Scheduler
 * @subpackage Cleanup
 */
class KAsyncDirectoryCleanup extends KPeriodicWorker
{
	/* (non-PHPdoc)
	 * @see KBatchBase::getType()
	 */
	public static function getType()
	{
		return KalturaBatchJobType::CLEANUP;
	}
	
	/* (non-PHPdoc)
	 * @see KBatchBase::getJobType()
	 */
	public function getJobType()
	{
		return self::getType();
	}
	
	/* (non-PHPdoc)
	 * @see KBatchBase::run()
	*/
	public function run($jobs = null)
	{
		KalturaLog::info("Directory Cleanup is running");
		
		$path = $this->getAdditionalParams("path");
		$pattern = $this->getAdditionalParams("pattern");
		$simulateOnly = $this->getAdditionalParams("simulateOnly");
		$minutesOld = $this->getAdditionalParams("minutesOld");
		$searchPath = $path . $pattern;
		KalturaLog::debug("Searching [$searchPath]");
		
		if($this->getAdditionalParams("usePHP"))
		{
			$this->deleteFilePHP($searchPath, $minutesOld, $simulateOnly);
		}
		else
		{
			$this->deleteFilesLinux($searchPath, $minutesOld, $simulateOnly);
		}
	}
	
	public function deleteFilesLinux($searchPath, $minutesOld, $simulateOnly)
	{
		$command = "find $searchPath -mmin +$minutesOld -exec rm -rf {} \;";
		KalturaLog::info("Executing command: $command");
		
		$returnedValue = null;
		passthru($command, $returnedValue);
		KalturaLog::info("Returned value [$returnedValue]");
	}
	
	public function deleteFilesPHP($searchPath, $minutesOld, $simulateOnly)
	{
		$secondsOld = $minutesOld * 60;
		
		$files = glob ( $searchPath);
		KalturaLog::debug("Found [" . count ( $files ) . "] to scan");
		
		$now = time();
		KalturaLog::debug("The time now is: " . date('c', $now));
		KalturaLog::debug("Deleting files that are " . $secondsOld ." seconds old (modified before " . date('c', $now - $secondsOld) . ")");
		$deletedCount = 0;
		foreach ( $files as $file )
		{
			$filemtime = filemtime($file);
			if ($filemtime > $now - $secondsOld) 
				continue;
			
			if ( $simulateOnly )
			{
				KalturaLog::debug( "Simulating: Deleting file [$file], it's last modification time was " . date('c', $filemtime)); 
				continue;
			}
			
			KalturaLog::debug("Deleting file [$file], it's last modification time was " . date('c', $filemtime));
			$res = @unlink ( $file );
			if ( ! $res ){
				KalturaLog::debug("Error: problem while deleting [$file]");
				continue;	
			}
			$deletedCount++;
		}
		KalturaLog::debug("Deleted $deletedCount files");
	}
}
