<div class="dtitle w3-container w3-teal">
    Liste des modules
</div>

<form class="w3-container" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST">
    <input type="text" name="nom" placeholder="Rechercher par nom" value="<?= htmlspecialchars($nomFiltre); ?>">
    <button type="submit">Rechercher</button>
</form>

<table border="1">
    <thead>
        <tr>
            <th>Numéro module</th>
            <th>Nom</th>
            <th>Coefficient</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($modules)): ?>
            <?php foreach ($modules as $module): ?>
                <tr>
                    <td><?= htmlspecialchars($module['nummod']); ?></td>
                    <td><?= htmlspecialchars($module['nommod']); ?></td>
                    <td><?= htmlspecialchars($module['coefmod']); ?></td>
                    <td>
                        <form action="index.php?element=module&action=card" method="POST">
                            <input type="hidden" name="nummod" value="<?= htmlspecialchars($module['nummod']); ?>">
                            <button type="submit" name="voir_module" class="w3-btn w3-blue w3-padding-large w3-block">
                                Voir
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="w3-center">Aucun module trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

