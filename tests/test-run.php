<?php

class CS_Run_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'CS_Run') );
	}

	function test_class_access() {
		$this->assertTrue( cool_shortcode()->run instanceof CS_Run );
	}
}
