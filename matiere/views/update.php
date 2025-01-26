<div class="dtitle w3-container w3-teal">
    <h2>Modifier Fiche Matière</h2>
</div>

<div class="w3-container w3-padding-large">
    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Informations Matière</h3>
        </div>
        <div class="w3-container">
            <form method="POST" action="index.php?element=matiere&action=update">
                <table class="w3-table w3-striped w3-bordered">
                    <tr>
                        <td><strong>Numéro matiére</strong></td>
                        <td><input type="text" name="nummat"
                                value="<?php echo htmlspecialchars($matiere->getnummat()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Nom</strong></td>
                        <td><input type="text" name="nommat"
                                value="<?php echo htmlspecialchars($matiere->getnommat()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Coefficient</strong></td>
                        <td><input type="text" name="coefmat"
                                value="<?php echo htmlspecialchars($matiere->getcoefmat()); ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Module</strong></td>
                        <td>
                            <select name="nummod" required>
                                <?php
                                $stmt = $pdo->query("SELECT nummod, nommod FROM modules");
                                while ($module = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $selected = ($matiere->getnummod() == $module['nummod']) ? 'selected' : '';
                                    echo "<option value='{$module['nummod']}' {$selected}>{$module['nommod']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="w3-container">
            <button class="w3-btn w3-teal w3-padding-large" type="submit" name="save">Sauvegarder</button>
        </div>

    <a href="index.php?element=matiere&action=list" class="w3-button w3-teal">Retour</a>
    </div>
</div>