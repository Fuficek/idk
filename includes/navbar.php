<header>
        <a class="logo" href="index.php"><img src="IMG/logo.png" alt="logo" height="50"></a>
        <nav>
            <ul class="nav__links">
                <li><a class="nav__links-active" href="tenisky.php">Tenisky</a></li>
                <li><a href="obleceni.html">Oblečení</a></li>
                <li><a href="brands.html">Značky</a></li>
            </ul>
        </nav>
        <a class="cta" href="contact.html">Kontakt</a>
        <div class="overlay">
        <a class="close">&times;</a>
        <div class="overlay__content">
            <a href="tenisky.html">Tenisky</a>
            <a href="obleceni.html">Oblečení</a>
            <a href="brands.html">Značky</a>
            <a href="contact.html">Kontakt</a>
        </div>
    </div>
        <div class="logo-size">
        <?php
            if(isset($_SESSION['user'])){
              echo '
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              ';
            }
            else{
              echo "
                <li><a href='login.php'>LOGIN</a></li>
                <li><a href='signup.php'>SIGNUP</a></li>
              ";
            }
          ?>
        </div>
        <button class="fa fa-bars hamburger menu"></button>
    </header>