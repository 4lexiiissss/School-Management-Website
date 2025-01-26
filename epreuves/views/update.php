<div class="dtitle w3-container w3-teal">
    <h2>Modifier fiche Épreuve</h2>
</div>

<div class="w3-container w3-padding-large">
    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Informations Épreuve</h3>
        </div>
        <div class="w3-container">
            <form method="POST"
                action="index.php?element=epreuves&action=update&numepr=<?php echo htmlspecialchars($epreuve->getNumepr()); ?>">
                <table class="w3-table w3-striped w3-bordered">
                    <tr>
                        <td><strong>Numéro Épreuve</strong></td>
                        <td><input type="text" name="numepr"
                                value="<?php echo htmlspecialchars($epreuve->getnumepr()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Libellé</strong></td>
                        <td><input type="text" name="libepr"
                                value="<?php echo htmlspecialchars($epreuve->getLibepr()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Date</strong></td>
                        <td><input type="date" name="datepr"
                                value="<?php echo htmlspecialchars($epreuve->getDatepr()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Matière</strong></td>
                        <td>
                            <select name="matepr" required>
                                <?php
                                $matiereStmt = $pdo->query("SELECT nummat, nommat FROM matieres");
                                while ($matiere = $matiereStmt->fetch(PDO::FETCH_ASSOC)) {
                                    $selected = ($matiere['nummat'] == $epreuve->getMatepr()) ? 'selected' : '';
                                    echo "<option value='{$matiere['nummat']}' {$selected}>{$matiere['nommat']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Enseignant</strong></td>
                        <td>
                            <select name="ensepr" required>
                                <?php
                                $enseignantStmt = $pdo->query("SELECT numens, preens, nomens FROM enseignants");
                                while ($enseignant = $enseignantStmt->fetch(PDO::FETCH_ASSOC)) {
                                    $selected = ($enseignant['numens'] == $epreuve->getEnsepr()) ? 'selected' : '';
                                    echo "<option value='{$enseignant['numens']}' {$selected}>{$enseignant['preens']} {$enseignant['nomens']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Coefficient</strong></td>
                        <td><input type="number" name="coefepr"
                                value="<?php echo htmlspecialchars($epreuve->getCoefepr()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Année</strong></td>
                        <td><input type="number" name="annepr"
                                value="<?php echo htmlspecialchars($epreuve->getAnnepr()); ?>" required></td>
                    </tr>
                </table>
                <input type="hidden" name="numepr" value="<?php echo htmlspecialchars($epreuve->getNumepr()); ?>">
                <button class="w3-btn w3-teal w3-padding-large" type="submit" name="save">Sauvegarder</button>
            </form>
        </div>
    </div>

    <a href="index.php?element=epreuves&action=list" class="w3-button w3-teal">Retour</a>
</div>