<div class="dtitle w3-container w3-teal">
    <h2>Modifier Fiche enseigant</h2>
</div>

<div class="w3-container w3-padding-large">
    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Informations personnelles</h3>
        </div>
        <div class="w3-container">
            <form method="POST"
                action="index.php?element=enseignants&action=update&numens=<?php echo htmlspecialchars($enseignant->getnumens()); ?>">
                <table class="w3-table w3-striped w3-bordered">
                    <tr>
                        <td><strong>Prénom</strong></td>
                        <td><input type="text" name="preens"
                                value="<?php echo htmlspecialchars($enseignant->getpreens()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Nom</strong></td>
                        <td><input type="text" name="nomens"
                                value="<?php echo htmlspecialchars($enseignant->getnomens()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Date d'anniversaire</strong></td>
                        <td><input type="date" name="datnaiens"
                                value="<?php echo htmlspecialchars($enseignant->getdatnaiens()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Adresse</strong></td>
                        <td><input type="text" name="adrens"
                                value="<?php echo htmlspecialchars($enseignant->getadrens()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Ville</strong></td>
                        <td><input type="text" name="vilens"
                                value="<?php echo htmlspecialchars($enseignant->getvilens()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Code postal</strong></td>
                        <td><input type="text" name="cpens"
                                value="<?php echo htmlspecialchars($enseignant->getcpens()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Numéro de téléphone</strong></td>
                        <td><input type="text" name="telens"
                                value="<?php echo htmlspecialchars($enseignant->gettelens()); ?>" required></td>
                    </tr>
                </table>
        </div>
    </div>

    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Informations académiques</h3>
        </div>
        <div class="w3-container">
            <table class="w3-table w3-striped w3-bordered">
                <tr>
                    <td><strong>Numéro enseigant</strong></td>
                    <td><input type="text" name="numens"
                            value="<?php echo htmlspecialchars($enseignant->getnumens()); ?>" required></td>
                </tr>
                <tr>
                    <td><strong>Fonction</strong></td>
                    <td>
                        <select name="foncens" class="w3-select w3-border" required>
                            <option value="" disabled <?php echo !$enseignant->getfoncens() ? 'selected' : ''; ?>>
                                Choisissez une fonction</option>
                            <option value="AGREGE" <?php echo $enseignant->getfoncens() === 'AGREGE' ? 'selected' : ''; ?>>Agrégé</option>
                            <option value="CERTIFIE" <?php echo $enseignant->getfoncens() === 'CERTIFIE' ? 'selected' : ''; ?>>Certifié</option>
                            <option value="MAITRE DE CONFERENCES" <?php echo $enseignant->getfoncens() === 'MAITRE DE CONFERENCES' ? 'selected' : ''; ?>>Maître de Conférences</option>
                            <option value="VACATAIRE" <?php echo $enseignant->getfoncens() === 'VACATAIRE' ? 'selected' : ''; ?>>Vacataire</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Date d'embauche</strong></td>
                    <td><input type="date" name="datembens"
                            value="<?php echo htmlspecialchars($enseignant->getdatembens()); ?>" required></td>
                </tr>
            </table>
        </div>

        <div class="w3-container">
            <button class="w3-btn w3-teal w3-padding-large" type="submit" name="save">Sauvegarder</button>
        </div>

        <a href="index.php?element=enseignants&action=list" class="w3-button w3-teal">Retour</a>
    </div>
</div>
</div>