
        <section class="section_glavni">
            <form id="forma2" method="post" name="forma2" accept-charset="utf-8" action="{$phpself}" novalidate>
                  <h3>{$naslovStranice}</h3>

                   <div>
                    <label for="ime1">Ime</label>
                    
                    <input type="text" id="ime1" name="Ime" maxlength="15" placeholder="Ime">
                    <br>
                    <div>{$greskaIme}</div>
                   </div><br>
                   <div>
                    <label for="prezime1">Prezime</label>
                        
                    <input type="text" id="prezime1" name="Prezime" placeholder="Prezime">
                    <br>
                    <div>{$greskaPre}</div>
                   </div><br>
                   <div>
                    <label for="korime1">Korisničko ime</label>
                        
                    <input type="text" id="korime1" name="Korime" placeholder="korisnicko_ime" required="required">
                    <br>
                    <div>{$greskaKorIme}</div>
                   </div><br>
                   <div>
                    <label for="email1">Email adresa</label>
                        
                    <input type="email" id="email1" name="Email" placeholder="korime@foi.hr" required="required">
                    </div>
                   <br>
                   <div>{$greskaEmail}</div>
                   <br>
                   <div>
                    <label for="lozinka1">Lozinka</label>
                    
                    <input type="password" id="lozinka1" name="Lozinka" placeholder="Lozinka" required="required">
                   </div>
                   <br>
                       <div>{$greskaLoz}</div>
                   <br>
                   <div>
                    <label for="lozinka2">Potvrda lozinke</label>
                    <input type="password" id="lozinka2" name="Potvrdalozinke" placeholder="Lozinka" required="required">
                   </div>
                   <br>
                       <div>{$greskaPonLoz}</div>
                       <br>
                <!--ReCaptha-->
                <div class="g-recaptcha" data-sitekey="6LdsuyUUAAAAAHTEfA6n98al95ZkRL-VvXa2Zeod"></div>

                    <input type="submit" name="submit" value="Registracija">
                <a href="prijava.php">Prijava</a>
            </form>

        </section>
</div>
        
