<table>
    <tr>
        <td><strong>Прозвішча<strong></td>
        <td><strong>Імя<strong></td>
        <td><strong>Дзень нараджэння<strong></td>
        <td><strong>Адрас<strong></td>
        <td><strong>Тэлефон 1<strong></td>
        <td><strong>Тэлефон 2<strong></td>
        <td><strong>Імэйл<strong></td>
    </tr>    
    <?php foreach ($positions as $position) : ?>
        <tr>
            <td><?= $position["last_name"] ?></td>
            <td><?= $position["first_name"] ?></td>
            <td><?= $position["dob"] ?></td>
            <td><?= $position["address"] ?></td>
            <td><?= $position["phone1"] ?></td>
            <td><?= $position["phone2"] ?></td>
            <td><a href="mailto:<?= $position["email"] ?>"><?= $position["email"] ?></a></td>
        </tr>
    <?php endforeach ?>
</table>
