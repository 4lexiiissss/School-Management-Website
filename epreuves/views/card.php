<div class="dtitle w3-container w3-teal">
    <h2>Fiche Épreuve</h2>
</div>

<div class="w3-container w3-padding-large">
    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Informations de l'épreuve</h3>
        </div>
        <div class="w3-container">
            <table class="w3-table w3-striped w3-bordered">
                <tr>
                    <td><strong>Numéro Épreuve</strong></td>
                    <td><?= htmlspecialchars($epreuve->getnumepr()); ?></td>
                </tr>
                <tr>
                    <td><strong>Libellé</strong></td>
                    <td><?= htmlspecialchars($epreuve->getlibepr()); ?></td>
                </tr>
                <tr>
                    <td><strong>Enseignant</strong></td>
                    <td>
                        <?php
                        $enseignantStmt = $pdo->prepare("SELECT nomens, preens FROM enseignants WHERE numens = :ensepr");
                        $enseignantStmt->execute([':ensepr' => $epreuve->getensepr()]);
                        $enseignant = $enseignantStmt->fetch(PDO::FETCH_ASSOC);
                        echo htmlspecialchars(($enseignant['preens'] ?? '') . ' ' . ($enseignant['nomens'] ?? ''));
                        ?>

                    </td>
                </tr>
                <tr>
                    <td><strong>Matière</strong></td>
                    <td>
                        <?php
                        $matiereStmt = $pdo->prepare("SELECT nommat FROM matieres WHERE nummat = :matepr");
                        $matiereStmt->execute([':matepr' => $epreuve->getmatepr()]);
                        $matiere = $matiereStmt->fetch(PDO::FETCH_ASSOC);
                        echo htmlspecialchars($matiere['nommat'] ?? '');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Date</strong></td>
                    <td><?= htmlspecialchars($epreuve->getdatepr()); ?></td>
                </tr>
                <tr>
                    <td><strong>Coefficient</strong></td>
                    <td><?= htmlspecialchars($epreuve->getcoefepr()); ?></td>
                </tr>
                <tr>
                    <td><strong>Année</strong></td>
                    <td><?= htmlspecialchars($epreuve->getannepr()); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="w3-container w3-margin-top">
    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Classement des étudiants</h3>
        </div>
        <div class="w3-container">
            <table class="w3-table w3-striped w3-bordered">
                <thead>
                    <tr>
                        <th>Rang</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Note</th>
                        <th>Moyenne Globale</th>
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
                        echo "<td>" . htmlspecialchars($row['note']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['moyenne_globale']) . "</td>";
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
            action="index.php?element=epreuves&action=update&numepr=<?= htmlspecialchars($epreuve->getnumepr()); ?>">
            <input type="hidden" name="numepr" value="<?= htmlspecialchars($epreuve->getnumepr()); ?>">
            <button class="w3-btn w3-teal w3-padding-large" type="submit" name="modifier">Modifier</button>
        </form>
        <form method="POST"
            action="index.php?element=epreuves&action=delete&numepr=<?= htmlspecialchars($epreuve->getnumepr()); ?>"
            style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette épreuve ?');">
            <input type="hidden" name="numepr" value="<?= htmlspecialchars($epreuve->getnumepr()); ?>">
            <button class="w3-btn w3-red w3-padding-large" type="submit" name="supprimer">Supprimer</button>
        </form>

        <a href="index.php?element=epreuves&action=list" class="w3-button w3-teal">Retour</a>
    </div>
</div>