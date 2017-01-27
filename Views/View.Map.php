<?php 
	final class ViewMap extends View {
		public function MakeView ( ) {
			$this -> Scope('Full');
			$this -> Select('main') -> AddClass( 'NoMarginTop' );
			$this -> Select('main') -> LoadTemplate( 'Map' );
			$this -> Select('#Destinations') -> AddClass( 'Active' );

			$this -> Select('title') -> HTML($this -> Data['PageTitle']);
			$this -> Select('head') -> Append('<meta name="keywords" content="' . $this -> Data['PageKeyword'] . '" />');
			$this -> Select('head') -> Append('<meta name="description" content="' . $this -> Data['PageDescription'] . '" />');
		}
	}