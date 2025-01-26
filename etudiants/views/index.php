<div class="dtitle w3-container w3-teal w3-center w3-padding-32">
    <h1 class="w3-xxlarge w3-text-white">Accueil Étudiants</h1>
</div>

<div class="w3-container w3-padding-large w3-light-grey">
    <div class="classement-general w3-card w3-white w3-margin-bottom">
        <div class="w3-container w3-teal w3-padding-16">
            <h2>Classement Général des Étudiants</h2>
        </div>
        <div class="w3-responsive">
            <table class="w3-table w3-bordered w3-striped w3-hoverable">
                <thead class="w3-teal">
                    <thead>
                    <tr class="w3-teal">
                        <th>Numéro</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Année</th>
                        <th>Score Total</th>
                    </thead>
                </thead>
                <tbody>
                    <?php if (!empty($classementGeneralParAnnee)): ?>
                        <?php foreach ($classementGeneralParAnnee as $etudiant): ?>
                            <tr>
                                <td><?= htmlspecialchars($etudiant['numetu']) ?></td>
                                <td><?= htmlspecialchars($etudiant['nometu']) ?></td>
                                <td><?= htmlspecialchars($etudiant['prenometu']) ?></td>
                                <td><?= htmlspecialchars($etudiant['annetu']) ?></td>
                                <td><?= htmlspecialchars($etudiant['total_score']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="w3-center w3-text-grey">Aucun résultat disponible.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
