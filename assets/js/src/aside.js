function togglediv( id ) {
    const div = document.getElementById( id ); // aside - nav
    const entryContent = document.getElementsByClassName("entry-content"); // change margin of entry-content
	 
	if ( div.className === 'aside-navigation' ) {
        div.className = 'aside-navigation--expanded';
		for (var i = 0; i < entryContent.length; i++) {
			entryContent[i].style.marginLeft = 10 + "%";
		}
       
	} else if ( div.className === 'aside-navigation--expanded' ) {
		div.className = 'aside-navigation';
			for (var i = 0; i < entryContent.length; i++) {
			entryContent[i].style.marginLeft = "auto";
		}
	}
}
