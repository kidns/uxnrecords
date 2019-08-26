<?php

include 'header.php';

include '../autoLoad.php';
$ss = new apps_libs_UserIdentity();
$route = new apps_libs_Route(__DIR__);
if($ss->isLogin()==false){
    $route->Redirect('login.php');
} else {


    ?>

    <link href="../media/boostrap/css/dashboard.css" rel="stylesheet">

    <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>

                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Saved reports</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" id="users" href="?tab=users">
                                <span data-feather="file-text"></span>
                                Manage Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?tab=albums">
                                <span data-feather="file-text"></span>
                                Albums
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?tab=artists">
                                <span data-feather="file-text"></span>
                                Artists
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?tab=demo">
                                <span data-feather="file-text"></span>
                                Demo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?tab=promotions">
                                <span data-feather="file-text"></span>
                                Promotions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?tab=artworks">
                                <span data-feather="file-text"></span>
                                Artworks
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
                <?php

                $tab = trim(addslashes(htmlspecialchars($_GET['tab'])));

                    if($tab==="users"){
                        include_once 'users/managerUsers.php';
                        echo ' <script>$("#users").addClass("active");</script>';
                    }


                ?>
                </div>


                </div>
            </main>
        </div>

    </body>
    <?php
    include 'users/add.php';
        }
    include 'footer.php';
    ?>