<div class="dtitle w3-container w3-teal">
    <h2>Fiche étudiant</h2>
</div>

<div class="w3-container w3-padding-large">
    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Informations personnelles</h3>
        </div>
        <div class="w3-container">
            <table class="w3-table w3-striped w3-bordered">
                <tr>
                    <td><strong>Numéro étudiant</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getNumEtu()); ?></td>
                </tr>
                <tr>
                    <td><strong>Prénom</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getprenometu()); ?></td>
                </tr>
                <tr>
                    <td><strong>Nom</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getnometu()); ?></td>
                </tr>
                <tr>
                    <td><strong>Date d'anniversaire</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getdatnaietu()); ?></td>
                </tr>
                <tr>
                    <td><strong>Adresse</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getadretu()); ?></td>
                </tr>
                <tr>
                    <td><strong>Ville</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getviletu()); ?></td>
                </tr>
                <tr>
                    <td><strong>Code postal</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getcpetu()); ?></td>
                </tr>
                <tr>
                    <td><strong>Téléphone</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getTeletu()); ?></td>
                </tr>
                <tr>
                    <td><strong>Sexe</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getsexetu()); ?></td>
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
                    <td><strong>Date d'entrée</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getdatentre()); ?></td>
                </tr>
                <tr>
                    <td><strong>Année</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getannetu()); ?></td>
                </tr>
                <tr>
                    <td><strong>Remarques</strong></td>
                    <td><?php echo htmlspecialchars($etudiant->getremarque()); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Classement de l'Étudiant par Module</h3>
        </div>
        <div class="w3-container">
            <table class="w3-table w3-striped w3-bordered">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($classement as $module) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($module['nommod']) . "</td>";
                        echo "<td>" . htmlspecialchars($module['moyenne']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="w3-container">
        <form method="POST"
            action="index.php?element=etudiants&action=update&numetu=<?php echo htmlspecialchars($etudiant->getNumetu()); ?>">
            <input type="hidden" name="numetu" value="<?php echo htmlspecialchars($etudiant->getNumetu()); ?>">
            <button class="w3-btn w3-teal w3-padding-large" type="submit" name="modifier">Modifier</button>
        </form>
        <form method="POST"
            action="index.php?element=etudiants&action=delete&numetu=<?php echo htmlspecialchars($etudiant->getNumetu()); ?>"
            style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">
            <input type="hidden" name="numetu" value="<?php echo htmlspecialchars($etudiant->getNumetu()); ?>">
            <button class="w3-btn w3-red w3-padding-large" type="submit" name="supprimer">Supprimer</button>
        </form>

        <a href="index.php?element=etudiants&action=list" class="w3-button w3-teal">Retour</a>
    </div>
</div>
