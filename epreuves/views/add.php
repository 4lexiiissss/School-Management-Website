<div class="dtitle w3-container w3-teal">
    Création d'une nouvelle épreuve
</div>
<form class="w3-container" action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
    <div class="dcontent">
        <div class="w3-row-padding">
            <div class="w3-half">
                <label class="w3-text-blue"><b>Numéro épreuve</b></label>
                <input type="number" class="w3-input w3-border" name="numepr"
                    placeholder="Saisissez le numéro de l'épreuve"
                    value="<?= isset($data['numepr']) ? $data['numepr'] : ''; ?>" required />
            </div>
            <div class="w3-half">
                <label class="w3-text-blue"><b>Libellé</b></label>
                <input type="text" class="w3-input w3-border" name="libepr"
                    placeholder="Saisissez le libellé de l'épreuve"
                    value="<?= isset($data['libepr']) ? $data['libepr'] : ''; ?>" maxlength="20" />
            </div>
        </div>
        <div class="w3-row-padding">
            <div class="w3-half">
                <label class="w3-text-blue"><b>Enseignant</b></label>
                <select class="w3-select w3-border" name="ensepr" required>
                    <option value="" disabled selected>Choisissez un enseignant</option>
                    <?php
                    $stmt = $pdo->query("SELECT numens, nomens FROM enseignants");
                    while ($enseignant = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $selected = isset($data['ensepr']) && $data['ensepr'] == $enseignant['numens'] ? 'selected' : '';
                        echo "<option value='{$enseignant['numens']}' $selected>{$enseignant['nomens']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="w3-half">
                <label class="w3-text-blue"><b>Matière</b></label>
                <select class="w3-select w3-border" name="matepr" required>
                    <option value="" disabled selected>Choisissez une matière</option>
                    <?php
                    $stmt = $pdo->query("SELECT nummat, nommat FROM matieres");
                    while ($matiere = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $selected = isset($data['matepr']) && $data['matepr'] == $matiere['nummat'] ? 'selected' : '';
                        echo "<option value='{$matiere['nummat']}' $selected>{$matiere['nommat']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="w3-row-padding">
            <div class="w3-half">
                <label class="w3-text-blue"><b>Date</b></label>
                <input type="date" class="w3-input w3-border" name="datepr"
                    value="<?= isset($data['datepr']) ? $data['datepr'] : ''; ?>" />
            </div>
            <div class="w3-half">
                <label class="w3-text-blue"><b>Coefficient</b></label>
                <input type="number" class="w3-input w3-border" name="coefepr"
                    placeholder="Saisissez le coefficient"
                    value="<?= isset($data['coefepr']) ? $data['coefepr'] : ''; ?>" required />
            </div>
        </div>
        <div class="w3-row-padding">
            <div class="w3-half">
                <label class="w3-text-blue"><b>Année</b></label>
                <input type="number" class="w3-input w3-border" name="annepr"
                    placeholder="Saisissez l'année de l'épreuve"
                    value="<?= isset($data['annepr']) ? $data['annepr'] : ''; ?>" />
            </div>
        </div>
        <br />
        <div class="w3-row-padding">
            <div class="w3-half w3-right">
                <input class="w3-btn w3-blue-grey" type="submit" name="confirm_envoyer" value="Créer l'épreuve" />
            </div>
            <div class="w3-half">
                <input class="w3-btn w3-red" type="submit" name="cancel" value="Annuler" />
            </div>
        </div>
    </div>
</form>
