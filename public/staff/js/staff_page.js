// // Access route URLs from data attributes
// const maindashboardRoute = document.getElementById('route-data').dataset.maindashboard;
// const employeesRoute = document.getElementById('route-data').dataset.employees;

// // Function to load page content
// function loadPage(url) {
//     fetch(url)
//         .then(response => response.text())
//         .then(html => {
//             document.getElementById('main-content').innerHTML = html;
//             // Store the clicked page URL in sessionStorage
//             sessionStorage.setItem('lastPage', url);
//         });
// }

// // Load the last clicked page upon page load
// window.onload = function() {
//     var lastPage = sessionStorage.getItem('lastPage');
//     if (lastPage) {
//         loadPage(lastPage);
//     } else {
//         loadPage(maindashboardRoute);
//     }
// };

// Function to handle logout
function handleLogout(event) {
    event.preventDefault(); // Prevent default form submission
    document.getElementById('logoutForm').submit();
}
