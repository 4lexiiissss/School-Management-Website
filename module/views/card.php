<div class="dtitle w3-container w3-teal">
    <h2>Fiche module</h2>
</div>

<div class="w3-container w3-padding-large">
    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Informations module</h3>
        </div>
        <div class="w3-container">
            <table class="w3-table w3-striped w3-bordered">
                <tr>
                    <td><strong>Numéro</strong></td>
                    <td><?php echo htmlspecialchars($module->getnummod()); ?></td>
                </tr>
                <tr>
                    <td><strong>Nom</strong></td>
                    <td><?php echo htmlspecialchars($module->getnommod()); ?></td>
                </tr>
                <tr>
                    <td><strong>Coefficient</strong></td>
                    <td><?php echo htmlspecialchars($module->getcoefmod()); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="w3-container w3-teal">
            <h3>Classement Global des Étudiants</h3>
        </div>
        <div class="w3-container">
            <table class="w3-table w3-striped w3-bordered">
                <thead>
                    <tr>
                        <th>Rang</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rang = 1;
                    foreach ($classement as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($rang++) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['moyenne']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <div class="w3-container">
        <form method="POST"
            action="index.php?element=module&action=update&nummod=<?php echo htmlspecialchars($module->getnummod()); ?>">
            <input type="hidden" name="nummod" value="<?php echo htmlspecialchars($module->getnummod()); ?>">
            <button class="w3-btn w3-teal w3-padding-large" type="submit" name="modifier">Modifier</button>
        </form>
        <form method="POST"
            action="index.php?element=module&action=delete&nummod=<?php echo htmlspecialchars($module->getnummod()); ?>"
            style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce module ?');">
            <input type="hidden" name="nummod" value="<?php echo htmlspecialchars($module->getnummod()); ?>">
            <button class="w3-btn w3-red w3-padding-large" type="submit" name="supprimer">Supprimer</button>
        </form>

        <a href="index.php?element=module&action=list" class="w3-button w3-teal">Retour</a>
    </div>
</div>