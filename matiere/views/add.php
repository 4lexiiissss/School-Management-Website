<div class="dtitle w3-container w3-teal">
    Création d'une nouvelle matiere

</div>
<form class="w3-container" action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
    <div class="dcontent">
        <div class="w3-row-padding">
            <div class="w3-half">
                <label class="w3-text-blue"><b>Numéro matiére</b></label>
                <input type="number" class="w3-input w3-border" name="nummat"
                    placeholder="Saisissez un numéro de matiere"
                    value="<?= isset($data['nummat']) ? $data['nummat'] : ''; ?>" />
            </div>
            <div class="w3-half">
                <label class="w3-text-blue"><b>Nom</b></label>
                <input type="text" class="w3-input w3-border" name="nommat"
                    placeholder="Saisissez un nom de matiere"
                    value="<?= isset($data['nommat']) ? $data['nommat'] : ''; ?>" />
            </div>
            <div class="w3-first">
                <label class="w3-text-blue"><b>Coefficient</b></label>
                <input type="number" class="w3-input w3-border" name="coefmat"
                    placeholder="Saisissez un coefficient de matiere"
                    value="<?= isset($data['coefmat']) ? $data['coefmat'] : ''; ?>" />
            </div>
            <div class="w3-row-padding">
                <div class="w3-first">
                    <label class="w3-text-blue"><b>Module</b></label>
                    <select class="w3-select w3-border" name="nummod" required>
                        <option value="" disabled selected>Choisissez un module</option>
                        <?php
                        $stmt = $pdo->query("SELECT nummod, nommod FROM modules");
                        while ($module = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$module['nummod']}'>{$module['nommod']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>


        </div>
        <br />
        <div class="w3-row-padding">
            <div class="w3-half w3-right">
                <input class="w3-btn w3-blue-grey" type="submit" name="confirm_envoyer" value="Créer la matiere" />
            </div>
            <div class="w3-half">
                <input class="w3-btn w3-red" type="submit" name="cancel" value="Annuler" />
            </div>
        </div>
</form>