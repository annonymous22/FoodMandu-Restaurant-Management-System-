document.addEventListener("DOMContentLoaded", function () {
    const headerContainer = document.getElementById("header-container");
    headerContainer.innerHTML = `
        <nav class="navbar">
            <div class="logo">Bon Appétit</div>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="About.html">About</a></li>
                <li><a href="Menu.html">Menu</a></li>
                <li><a href="Reservations.html">Reservations</a></li>
                <li><a href="signup.html">Sign Up</a></li>
                <li><a href="#">Wine Bar</a></li>
                <li><a href="#">Bakery</a></li>
                <li><a href="#" class="highlight">Private Dining</a></li>
                <li><a href="#">Gallery</a></li>
            </ul>
        </nav>
    `;
});
