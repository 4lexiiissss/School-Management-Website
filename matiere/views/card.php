<div class="dtitle w3-container w3-teal">
    <h2>Fiche Matière</h2>
</div>

<div class="w3-container w3-padding-large">
    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Informations Matière</h3>
        </div>
        <div class="w3-container">
            <table class="w3-table w3-striped w3-bordered">
                <tr>
                    <td><strong>Numéro Matière</strong></td>
                    <td><?php echo htmlspecialchars($matiere->getnummat()); ?></td>
                </tr>
                <tr>
                    <td><strong>Nom</strong></td>
                    <td><?php echo htmlspecialchars($matiere->getnommat()); ?></td>
                </tr>
                <tr>
                    <td><strong>Coefficient</strong></td>
                    <td><?php echo htmlspecialchars($matiere->getcoefmat()); ?></td>
                </tr>
                <tr>
                    <td><strong>Module</strong></td>
                    <td>
                        <?php
                        $moduleStmt = $pdo->prepare("SELECT nommod FROM modules WHERE nummod = :nummod");
                        $moduleStmt->execute([':nummod' => $matiere->getnummod()]); 
                        $module = $moduleStmt->fetch(PDO::FETCH_ASSOC);
                        echo htmlspecialchars($module['nommod'] ?? '');
                        ?>

                    </td>

                </tr>
            </table>
        </div>
    </div>

    <div class="w3-container w3-margin-top">
    <div class="w3-card-4 w3-margin w3-light-grey">
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
            action="index.php?element=matiere&action=update&nummat=<?php echo htmlspecialchars($matiere->getnummat()); ?>">
            <input type="hidden" name="nummat" value="<?php echo htmlspecialchars($matiere->getnummat()); ?>">
            <button class="w3-btn w3-teal w3-padding-large" type="submit" name="modifier">Modifier</button>
        </form>

        <form method="POST"
            action="index.php?element=matiere&action=delete&nummat=<?php echo htmlspecialchars($matiere->getnummat()); ?>"
            style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette matière ?');">
            <input type="hidden" name="nummat" value="<?php echo htmlspecialchars($matiere->getnummat()); ?>">
            <button class="w3-btn w3-red w3-padding-large" type="submit" name="supprimer">Supprimer</button>
        </form>

        <a href="index.php?element=matiere&action=list" class="w3-button w3-teal">Retour</a>
    </div>
</div>