<nav class="navbar navbar-expand-lg navbar-light bg-light flex-column">
    <div class="container-fluid container">
        <a class="navbar-brand" href="/">Ceramica</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex w-100 mx-5" action="/Product/Search/">
                <input class="form-control me-2" type="search" placeholder="Search" name="q" aria-label="Search" required>
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                if(isset($_SESSION['uid']) and $_SESSION['uid'] != ""){
                    echo '
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Account
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/Profile/">My Profile</a></li>
                                <li><a class="dropdown-item" href="/Profile/Address">Address</a></li>
                                <li><a class="dropdown-item" href="/Orders/">Orders</a></li>';
                                
                                if(isset($_SESSION["utype"]) and $_SESSION['utype'] == "A")
                                {
                                    echo '
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/Admin">Admin Panel</a></li>';
                                }

                                echo '
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/User/Logout.php">Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/Cart/">Cart</a>
                        </li>
                    </ul>
                    ';
                }
                else{
                    echo '
                    <ul class="navbar-nav mb-2 mb-lg-0" style="min-width: max-content;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/User/SignUp.php">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/User/Login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/Cart/">Cart</a>
                        </li>
                    </ul>
                    ';
                }
            ?>
        </div>
    </div>
    <div class="container w-100">
        <div class="w-100 d-flex justify-content-between mt-5 mb-2">
            <a class="text-dark text-decoration-none " aria-current="page" href="/Product/Search/">All Tiles</a>
            <a class="text-dark text-decoration-none " aria-current="page" href="/Product/Search/?cata=wall">Wall Tiles</a>
            <a class="text-dark text-decoration-none " aria-current="page" href="/Product/Search/?cata=kitchen">Kitchen Tiles</a>
            <a class="text-dark text-decoration-none " aria-current="page" href="/Product/Search/?cata=floor">Floor Tiles</a>
            <a class="text-dark text-decoration-none " aria-current="page" href="/Product/Search/?cata=bathroom">Bathroom Tiles</a>
            <a class="text-dark text-decoration-none " aria-current="page" href="/Product/Search/?cata=outdoor">Outdoor Tiles</a>
        </div>
    </div>
</nav>