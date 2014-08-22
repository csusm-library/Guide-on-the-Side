<?php

class DATABASE_CONFIG {

	var $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'guideside',
		'password' => 'CaQBPHs9Mf9pqebe',
		'database' => 'guide_dev',
    'encoding' => 'UTF8',
	);
	var $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'guideside',
		'password' => 'CaQBPHs9Mf9pqebe',
		'database' => 'guide_dev',
    'encoding' => 'UTF8',
	);
  var $array = array(
    'datasource' => 'Datasources.Array',
  );
  var $zendSearchLucene = array(
	  'datasource' => 'LuceneSource.ZendSearchLuceneSource',
	  'indexFile' => 'lucene', // stored in the cache dir.
	  'driver' => '',
	  'source' => 'search_indices',
    'analyzer' => 'StandardAnalyzer_Analyzer_Standard_English'
  );


  function __construct() {
    $user_config = Configure::read('user_config');
    $this->default = array_merge($this->default, $user_config['database']);
  }

}
?>