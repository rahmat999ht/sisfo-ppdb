   <!-- header section strats -->
   <header class="header_section">
       <div class="container">
           <nav class="navbar navbar-expand-lg custom_nav-container ">
               <a class="navbar-brand" href="index.php">
                   <span>
                       Sekolah SD
                   </span>
               </a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                   aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
               </button>

               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                       <ul class="navbar-nav  ">
                           <li class="nav-item active">
                               <a class="nav-link" href="index.php"> Home <span class="sr-only">(current)</span></a>
                           </li>
                           <?php if (isset($_SESSION['id_user'])): ?>
                               <!-- Cek jika session username ada -->

                               <li class="nav-item ">
                                   <a class="nav-link" href="pengumuman.php"> Pengumuman </a>
                               </li>

                               <li class="nav-item ">
                                   <a class="nav-link" href="biodata.php"> Biodata </a>
                               </li>

                               <!-- Dropdown Info Profil dan Log Out -->
                               <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                       Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
                                   </a>
                                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                       <a class="dropdown-item" href="function/logout_account.php">Log Out</a>
                                   </div>
                               </li>
                           <?php else: ?>
                               <li class="nav-item">
                                   <a class="call_to-btn btn_white-border mx-4" href="register.php"> Register </a>
                               </li>

                               <li class="nav-item">
                                   <a class="call_to-btn btn_white-border" href="login.php">Login</a>
                               </li>
                           <?php endif; ?>

                       </ul>
                   </div>
           </nav>
       </div>
   </header>

  <!-- end header section -->