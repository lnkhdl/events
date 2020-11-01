/*
 * On click action - shows or hides top navigation menu on small screens
 */
function toggle() {
    let menu = document.getElementById('top-nav');
    let icon = document.getElementById('toggle-icon');

    menu.classList.toggle('show');
    icon.classList.toggle('change');
}

/*
 * Make link of the current page active in the navigation
 */
const currentLocation = location.href;
const menuItem = document.querySelectorAll('.top-nav a');

for (let i = 0; i < menuItem.length; i++) {
    if (menuItem[i].href === currentLocation) {
        menuItem[i].classList.add('active');
    }
}


/*
 * Make the whole row of an event table clickable
 */
let rows = document.getElementsByClassName('clickable-row');

for (let i = 0; i < rows.length; i++) {
    let row = rows[i];
    row.addEventListener('click', function() {
        let href = this.cells[0].getElementsByTagName('a')[0].href;
        if (href) {
            window.location.assign(href);
        }
    });
}