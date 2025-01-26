<div class="dtitle w3-container w3-teal w3-center w3-padding-32">
    <h1 class="w3-xxlarge w3-text-white">Accueil Module</h1>
</div>

<div class="w3-container w3-padding-large w3-light-grey">
    <div class="classement-general w3-card w3-white w3-margin-bottom">
        <div class="w3-container w3-teal w3-padding-16">
            <h2>Classement Général</h2>
        </div>
        <div class="w3-responsive">
            <table class="w3-table w3-bordered w3-striped w3-hoverable">
                <thead class="w3-teal">
                    <thead>
                    <tr class="w3-teal">
                        <th>Numéro</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Module</th>
                        <th>Score Total</th>
                    </thead>
                </thead>
                <tbody>
                    <?php if (!empty($classementGeneral)): ?>
                        <?php foreach ($classementGeneral as $etudiant): ?>
                            <tr>
                                <td><?= htmlspecialchars($etudiant['numetu']) ?></td>
                                <td><?= htmlspecialchars($etudiant['nometu']) ?></td>
                                <td><?= htmlspecialchars($etudiant['prenometu']) ?></td>
                                <td><?= htmlspecialchars($etudiant['module']) ?></td>
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
    
    <div class="classement-epreuve w3-card w3-white">
        <div class="w3-container w3-blue w3-padding-16">
            <h2 class="w3-xxlarge w3-text-white w3-center">Classement par Matiére</h2>
        </div>
        <div class="w3-responsive">
            <table class="w3-table w3-bordered w3-striped w3-hoverable">
                <thead>
                    <tr class="w3-blue">
                        <th>Module</th>
                        <th>Matière</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($classementParMatiere)): ?>
                        <?php foreach ($classementParMatiere as $epreuve): ?>
                            <tr>
                                <td><?= htmlspecialchars($epreuve['module']) ?></td>
                                <td><?= htmlspecialchars($epreuve['matiere']) ?></td>
                                <td><?= htmlspecialchars($epreuve['nometu']) ?></td>
                                <td><?= htmlspecialchars($epreuve['prenometu']) ?></td>
                                <td><?= htmlspecialchars($epreuve['score']) ?></td>
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
