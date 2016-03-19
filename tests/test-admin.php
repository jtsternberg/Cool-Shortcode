<?php

class CS_Admin_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'CS_Admin') );
	}

	function test_class_access() {
		$this->assertTrue( cool_shortcode()->admin instanceof CS_Admin );
	}
}
