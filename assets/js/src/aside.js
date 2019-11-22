function handleBtnClick( event ) {
	console.log( event );
	 toggleButton(event);
	}

	function handleBtnKeyDown(event) {
	  // Check to see if space or enter were pressed
	  if (event.key === " " || event.key === "Enter" || event.key === "Spacebar") { // "Spacebar" for IE11 support
		// Prevent the default action to stop scrolling when space is pressed
	    event.preventDefault();
	    toggleButton(event.target);
	  }
	}

function toggleButton( element ) {

	const asideNavigation = document.getElementById( 'aside-navigation' );
	// Check to see if the button is pressed
	var pressed = element.getAttribute("aria-pressed");

	// toggle the play state of the audio file
	if ( pressed === 'true' ) {
		asideNavigation.classList.remove( 'aside-navigation' );
		asideNavigation.classList.add( 'aside-navigation--expanded' );
		// Change aria-pressed to the opposite state
		element.setAttribute( 'aria-pressed', 'true' );
	} else {
		asideNavigation.classList.remove( 'aside-navigation--expanded' );
		asideNavigation.classList.add( 'aside-navigation' );
		element.setAttribute( 'aria-pressed', 'false' );
	}
	console.log( pressed );
}
const asideBrandToggler = document.getElementById( 'aside-brand-toggler' );
asideBrandToggler.addEventListener( 'click', toggleButton( asideBrandToggler ) );
