function togglediv( id ) {
	const div = document.getElementById( id );

	if ( div.className === 'aside-navigation' ) {
		div.className = 'aside-navigation--expanded';
	} else if ( div.className === 'aside-navigation--expanded' ) {
		div.className = 'aside-navigation';
	}
}
