<div class="dtitle w3-container w3-teal">
    <h2>Fiche enseignant</h2>
</div>

<div class="w3-container w3-padding-large">
    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Informations personnelles</h3>
        </div>
        <div class="w3-container">
            <table class="w3-table w3-striped w3-bordered">
                <tr>
                    <td><strong>Prénom</strong></td>
                    <td><?php echo htmlspecialchars($enseignant->getpreens()); ?></td>
                </tr>
                <tr>
                    <td><strong>Nom</strong></td>
                    <td><?php echo htmlspecialchars($enseignant->getnomens()); ?></td>
                </tr>
                <tr>
                    <td><strong>Date d'anniversaire</strong></td>
                    <td><?php echo htmlspecialchars($enseignant->getdatnaiens()); ?></td>
                </tr>
                <tr>
                    <td><strong>Adresse</strong></td>
                    <td><?php echo htmlspecialchars($enseignant->getadrens()); ?></td>
                </tr>
                <tr>
                    <td><strong>Ville</strong></td>
                    <td><?php echo htmlspecialchars($enseignant->getvilens()); ?></td>
                </tr>
                <tr>
                    <td><strong>Code postal</strong></td>
                    <td><?php echo htmlspecialchars($enseignant->getcpens()); ?></td>
                </tr>
                <tr>
                    <td><strong>Numéro de téléphone</strong></td>
                    <td><?php echo htmlspecialchars($enseignant->gettelens()); ?></td>
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
                    <td><strong>Numéro enseignant</strong></td>
                    <td><?php echo htmlspecialchars($enseignant->getnumens()); ?></td>
                </tr>
                <tr>
                    <td><strong>Fonction</strong></td>
                    <td><?php echo htmlspecialchars($enseignant->getfoncens()); ?></td>
                </tr>
                <tr>
                    <td><strong>Date d'embauche</strong></td>
                    <td><?php echo htmlspecialchars($enseignant->getdatembens()); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="w3-container">
        <form method="POST"
            action="index.php?element=enseignants&action=update&numens=<?php echo htmlspecialchars($enseignant->getnumens()); ?>">
            <input type="hidden" name="numens" value="<?php echo htmlspecialchars($enseignant->getnumens()); ?>">
            <button class="w3-btn w3-teal w3-padding-large" type="submit" name="modifier">Modifier</button>
        </form>
        <form method="POST"
            action="index.php?element=enseignants&action=delete&numens=<?php echo htmlspecialchars($enseignant->getnumens()); ?>"
            style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant ?');">
            <input type="hidden" name="numens" value="<?php echo htmlspecialchars($enseignant->getnumens()); ?>">
            <button class="w3-btn w3-red w3-padding-large" type="submit" name="supprimer">Supprimer</button>
        </form>

        <a href="index.php?element=enseignants&action=list" class="w3-button w3-teal">Retour</a>
    </div>
</div>