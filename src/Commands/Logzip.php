<?php

namespace Ndarproj\Logzip\Commands;

use DateTimeImmutable;
use Illuminate\Console\Command;
use ZipArchive;

class Logzip extends Command
{
	protected $files = [];
	protected $logsPath;
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'log:zip';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Zip Logs';

	public function __construct()
	{
		parent::__construct();
	}

	public function handle()
	{
		if (config('logzip.log_compress_files') === false) {
			return $this->warn('Logzip is disabled');
		}

		$this->logsPath = storage_path('logs') . '/';

		$zip = new ZipArchive();
		$zipBasename =  config('logzip.log_zip_filename') . '-' . (new DateTimeImmutable)->format('Y-m-d-H-i-s') . '.zip';
		$zipFilename = $this->logsPath . $zipBasename;

		if ($files = scandir($this->logsPath)) {

			//check if zip exists
			if ($zip->open($zipFilename, ZipArchive::CREATE) !== TRUE) {
				error_log("cannot open <$zipFilename>\n");
			}

			$files = preg_grep("/^.*\.(log)$/", $files);

			foreach ($files as $file) {
				$zip->addFile($this->logsPath . '/' . $file, $file);
				array_push($this->files, $file);
			}

			if ($zip->numFiles === 0) {
				return $this->warn('No logs to compress...');
			}

			$zip->close() ? $this->info('Compressed logs created: ' . $zipBasename) : $this->error('Compressing Logs Failed');

			if (config('logzip.log_delete') === true) {
				$this->deleteLogs();
			}
		}
	}

	protected function deleteLogs()
	{
		foreach ($this->files as $file) {
			unlink($this->logsPath . $file);
		}
	}
}
