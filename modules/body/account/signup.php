            <form method="POST" action="data/authentication.php?request=signup" class="inscription">
                <div class="test"><input type="text" name="username" placeholder="Nom d'utilisateur" required="required"></div>
                <div><input type="text" name="surname" placeholder="Nom" required="required"></div>
                <div><input type="text" name="name" placeholder="Prénom" required="required"></div>
                <div><input type="email" name="email" placeholder="Adresse e-mail" required="required"></div>
                <div><input type="password" name="password" placeholder="Mot de passe" required="required"></div>
                <div><input type="password" name="passwordConfirm" placeholder="Confirmer mot de passe" required="required"></div>
                <div><input type="submit" value="S'inscrire"  class="button"></div>
            </form>
            <a href="account.php?request=login"><p>Je possède déjà un compte.</p></a>
