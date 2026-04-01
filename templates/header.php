    <header>
      <div id="social">
        <div id="rechercher">
          <input
            id="inputRechercher"
            type="text"
            placeholder=" &#128269; Rechercher"
          />
          <button id="buttonRechercher" class="bouttonGo">GO</button>
        </div>
        <div id="divSocial">
          <a
            class="bouttonSocial"
            href="https://www.facebook.com"
            target="_blank"
            ><img src="image/favfacebook (2).png" alt="img facebook"
          /></a>
          <a
            class="bouttonSocial"
            href="https://www.tiktok.com"
            target="_blank"
            ><img src="image/favtiktok (2).png" alt="img titok"
          /></a>
          <a
            class="bouttonSocial"
            href="https://www.x.com"
            target="_blank"
            ><img src="image/favx (2).png" alt="img x"
          /></a>
          
        </div>
      </div>
      <div id="bandeau">
        <a id="logoLink" href="index.php"
          ><img
            id="logo1"
            src="image/logosansfond_5.png"
            alt="img logo"
            height="250px"
            width="250px"
        /></a>
          <div id="titre1">
            <h1>
              <strong>
                LES CHASSES <br />
                DE <br />
                LORTHAN LE FABULEUX</strong
              >
            </h1>
          </div>
      </div>
      <div id="bandeauLog">
    <a class="bouttonSocial" id="lienpanier" href="index.php?page=panier">🛒</a>
    <div id="newLetter"><output id="outputNewLetter"><div id="trainNewLetter"></div></output></div>
    
    <?php if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === true): ?>
        <span>Bienvenue Chasseur : <strong><?php echo htmlspecialchars($_SESSION['user_pseudo'] ?? 'Aventurier'); ?></strong></span>
        <a href= "index.php?action=logout" class="bouttonOut">Quitter</a>
    <?php else: ?>
        <span>Non connecté</span>
    <?php endif; ?>
    <?php
        if($_SESSION['id_role']==2){
          echo "<a class='bouttonOut' href='index.php?page=admin'>ADMIN</a>";
        }
        ?>
    </div>
    </header>

