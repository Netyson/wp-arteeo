function togglediv( id ) {
	const div = document.getElementById( id );

	if ( div.className === 'aside-navigation' ) {
		console.log('erste if');

		div.className = 'aside-navigation--expanded';

	} else if ( div.className === 'aside-navigation--expanded' ) {
		console.log('zweite if')
		div.className = 'aside-navigation';

	}
}
