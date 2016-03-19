<?php

class BaseTest extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'Cool_Shortcode') );
	}
	
	function test_get_instance() {
		$this->assertTrue( cool_shortcode() instanceof Cool_Shortcode );
	}
}
