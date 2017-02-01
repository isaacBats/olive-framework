<?php 

namespace Olive\infrastructure;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class BaseRepository
{
	public $entity_name;

	function __construct()
	{
		$this->entity_name = class_exists( "\\Entity\\".get_class($this))?("\\Entity\\".get_class($this)):"";
		
		global $spot;
		$this->spot = $spot;
		$this->mapper = ($this->entity_name != "")?$this->spot->mapper( $this->entity_name ):NULL;

		// create a log channel
		$this->log = new Logger('luna');
		$this->log->pushHandler(new StreamHandler(__DIR__.'/logs/luna.log', Logger::INFO ) );
	}
}
