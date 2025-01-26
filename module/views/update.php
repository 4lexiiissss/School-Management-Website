<div class="dtitle w3-container w3-teal">
    <h2>Modifier Fiche module</h2>
</div>

<div class="w3-container w3-padding-large">
    <div class="w3-card-4 w3-margin w3-light-grey">
        <div class="w3-container w3-teal">
            <h3>Informations module</h3>
        </div>
        <div class="w3-container">
            <form method="POST"
                action="index.php?element=module&action=update&nummod=<?php echo htmlspecialchars($module->getnummod()); ?>">
                <table class="w3-table w3-striped w3-bordered">
                    <tr>
                        <td><strong>Numéro</strong></td>
                        <td><input type="text" name="nummod"
                                value="<?php echo htmlspecialchars($module->getnummod()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Nom</strong></td>
                        <td><input type="text" name="nommod"
                                value="<?php echo htmlspecialchars($module->getnommod()); ?>" required></td>
                    </tr>
                    <tr>
                        <td><strong>Coefficient</strong></td>
                        <td><input type="text" name="coefmod"
                                value="<?php echo htmlspecialchars($module->getcoefmod()); ?>" required></td>
                    </tr>
                    
                </table>
        </div>
    </div>

    <div class="w3-container">
            <button class="w3-btn w3-teal w3-padding-large" type="submit" name="save">Sauvegarder</button>
        </div>

    <a href="index.php?element=module&action=list" class="w3-button w3-teal">Retour</a>
    </div>
</div>