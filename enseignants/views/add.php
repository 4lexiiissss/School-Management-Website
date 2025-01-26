<div class="dtitle w3-container w3-teal">
    Création d'un nouvel enseignant

</div>
<form class="w3-container" action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
    <div class="dcontent">
        <div class="w3-row-padding">
            <div class="w3-half">
                <label class="w3-text-blue"><b>Numéro enseignant</b></label>
                <input type="number" class="w3-input w3-border" name="numens" placeholder="Saisissez un numéro enseignant"
                    value="<?= isset($data['numens']) ? $data['numens'] : ''; ?>" />
            </div>
            <div class="w3-half">
                <label class="w3-text-blue"><b>Prénom</b></label>
                <input type="text" class="w3-input w3-border" name="preens" placeholder="Saisissez un prénom"
                    value="<?= isset($data['preens']) ? $data['preens'] : ''; ?>" />
            </div>
            <div class="w3-half">
                <label class="w3-text-blue"><b>Nom</b></label>
                <input type="text" class="w3-input w3-border" name="nomens" placeholder="Saisissez un nom"
                    value="<?= isset($data['nomens']) ? $data['nomens'] : ''; ?>" />
            </div>
            <div class="w3-quarter">
                <label class="w3-text-blue"><b>Date de naissance</b></label>
                <input type="date" class="w3-input w3-border" name="datnaiens"
                    value="<?= isset($data['datnaiens']) ? $data['datnaiens'] : ''; ?>" />
            </div>
            <div class="w3-quarter">
                <label class="w3-text-blue"><b>Adresse</b></label>
                <input type="text" class="w3-input w3-border" name="adrens" placeholder="Saisissez une adresse"
                    value="<?= isset($data['adrens']) ? $data['adrens'] : ''; ?>" />
            </div>
            <div class="w3-quarter">
                <label class="w3-text-blue"><b>Code postal</b></label>
                <input type="number" class="w3-input w3-border" name="cpens" placeholder="Saisissez un code postal"
                    value="<?= isset($data['cpens']) ? $data['cpens'] : ''; ?>" />
            </div>
            <div class="w3-quarter">
                <label class="w3-text-blue"><b>Ville</b></label>
                <input type="text" class="w3-input w3-border" name="vilens" placeholder="Saisissez une ville"
                    value="<?= isset($data['vilens']) ? $data['vilens'] : ''; ?>" />
            </div>
            <div class="w3-half">
                <label class="w3-text-blue"><b>Numéro de téléphone</b></label>
                <input type="number" class="w3-input w3-border" name="telens"
                    placeholder="Saisissez un numéro de téléphone"
                    value="<?= isset($data['telens']) ? $data['telens'] : ''; ?>" />
            </div>
            <div class="w3-half">
                <label class="w3-text-blue"><b>Fonction</b></label>
                <select class="w3-select w3-border" name="foncens">
                    <option value="" disabled <?= !isset($data['foncens']) ? 'selected' : ''; ?>>Choisissez une fonction
                    </option>
                    <option value="AGREGE" <?= isset($data['foncens']) && $data['foncens'] === 'AGREGE' ? 'selected' : ''; ?>>Agrégé</option>
                    <option value="CERTIFIE" <?= isset($data['foncens']) && $data['foncens'] === 'CERTIFIE' ? 'selected' : ''; ?>>Certifié</option>
                    <option value="MAITRE DE CONFERENCES" <?= isset($data['foncens']) && $data['foncens'] === 'MAITRE DE CONFERENCES' ? 'selected' : ''; ?>>Maître de Conférences</option>
                    <option value="VACATAIRE" <?= isset($data['foncens']) && $data['foncens'] === 'VACATAIRE' ? 'selected' : ''; ?>>Vacataire</option>
                </select>
            </div>

            <div class="w3-half">
                <label class="w3-text-blue"><b>Date d'embauche</b></label>
                <input type="date" class="w3-input w3-border" name="datembens"
                    placeholder="Saisissez une date d'embauche"
                    value="<?= isset($data['datembens']) ? $data['datembens'] : ''; ?>" />
            </div>
        </div>
        <br />
        <div class="w3-row-padding">
            <div class="w3-half w3-right">
                <input class="w3-btn w3-blue-grey" type="submit" name="confirm_envoyer" value="Créer l'enseignant" />
            </div>
            <div class="w3-half">
                <input class="w3-btn w3-red" type="submit" name="cancel" value="Annuler" />
            </div>
        </div>
</form>