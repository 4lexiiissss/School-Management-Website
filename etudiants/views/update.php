<div class="dtitle w3-container w3-teal">
    <h2>Modifier Fiche étudiant</h2>
</div>
<div class="w3-container w3-padding-large">
    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Informations personnelles</h3>
        </div>
        <div class="w3-container">
            <form method="POST" action="index.php?element=etudiants&action=update&numetu=<?php echo htmlspecialchars($etudiant->getNumetu()); ?>">
                <table class="w3-table w3-striped w3-bordered">
                    <tr>
                        <td><strong>Numéro étudiant</strong></td>
                        <td><input type="text" name="numetu" value="<?php echo htmlspecialchars($etudiant->getNumEtu()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Prénom</strong></td>
                        <td><input type="text" name="prenometu" value="<?php echo htmlspecialchars($etudiant->getprenometu()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Nom</strong></td>
                        <td><input type="text" name="nometu" value="<?php echo htmlspecialchars($etudiant->getnometu()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Date d'anniversaire</strong></td>
                        <td><input type="date" name="datnaietu" value="<?php echo htmlspecialchars($etudiant->getdatnaietu()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Adresse</strong></td>
                        <td><input type="text" name="adretu" value="<?php echo htmlspecialchars($etudiant->getadretu()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Ville</strong></td>
                        <td><input type="text" name="viletu" value="<?php echo htmlspecialchars($etudiant->getviletu()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Code postal</strong></td>
                        <td><input type="text" name="cpetu" value="<?php echo htmlspecialchars($etudiant->getcpetu()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Téléphone</strong></td>
                        <td><input type="text" name="teletu" value="<?php echo htmlspecialchars($etudiant->getTeletu()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Sexe</strong></td>
                        <td>
                            <select name="sexetu" class="w3-select w3-border" required>
                                <option value="M" <?php echo $etudiant->getSexetu() === 'M' ? 'selected' : ''; ?>>Masculin</option>
                                <option value="F" <?php echo $etudiant->getSexetu() === 'F' ? 'selected' : ''; ?>>Féminin</option>
                            </select>
                        </td>
                    </tr>
                </table>
                
                <div class="w3-container w3-teal">
                    <h3>Informations académiques</h3>
                </div>
                <div class="w3-container">
                    <table class="w3-table w3-striped w3-bordered">
                        <tr>
                            <td><strong>Date d'entrée</strong></td>
                            <td><input type="date" name="datentetu" value="<?php echo htmlspecialchars($etudiant->getdatentre()); ?>" required></td>
                        </tr>
                        <tr>
                            <td><strong>Année</strong></td>
                            <td><input type="text" name="annetu" value="<?php echo htmlspecialchars($etudiant->getannetu()); ?>" required></td>
                        </tr>
                        <tr>
                            <td><strong>Remarques</strong></td>
                            <td><input type="text" name="remetu" value="<?php echo htmlspecialchars($etudiant->getremarque()); ?>" required></td>
                        </tr>
                    </table>
                </div>

                <div class="w3-container">
                    <button class="w3-btn w3-teal w3-padding-large" type="submit" name="save">Sauvegarder</button>
                </div>

                <a href="index.php?element=etudiants&action=list" class="w3-button w3-teal">Retour</a>
            </form>
        </div>
    </div>
</div>
