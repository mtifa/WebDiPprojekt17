  
    <section class="section_glavni" style="height: 400px">
        <form id="forma3" method="post" name="forma" accept-charset="utf-8" novalidate action="{$phpself}">
                   <h3>{$naslovStranice}</h3>
                    <div id="greskeKor"></div>
                    <div>
                        <label id="labimp1" for="korime">{$korime}</label>

                        <input type="text" id="korime" name="korime" placeholder="korisnicko_ime">
                    </div><br>
                    <div id="greskeLoz"></div>
                    <div>
                        <label id="labimp2"  for="lozinka">{$lozinka}</label>
                        <input type="password" id="lozinka" name="lozinka" placeholder="lozinka" required="required">
                    </div><br>
                    <div>
                        <label id="labimp3"  for="zapamtime">{$zapamtime}</label><br>
                        <input type="radio" id="zapamtime" name="zapamtime" value="DA"> {$da}
                        <input type="radio"  id="zapamtime" name="zapamtime" value="NE"> {$ne}
                    </div><br>

            <input type="submit" name="dvakoraka" value="Dva koraka?">
            <input type="submit" name="jedankorak" value="Jedan korak?"><br><br>
                        <a href="registracija.php">{$registracija}</a>
                        <a href="zab_lozinka.php">Zaboravljena lozinka?</a>
                    {if (isset($_SESSION['korisnik']))}<button id="odjavi_se">Odjava</button>
                    {/if}


                </form>
            
            <div>
                {if ((isset($_SESSION['korisnik'])))}
                    <p>Vaše </p>{$korime}<br>
                    {$lozinka}<br>
                {/if}
            </div>
    </div>   
    </section>
