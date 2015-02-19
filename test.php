    <?php ob_start() ?> 

        <tr>
            <th></th>

    <?php $tableRows['head'] = ob_end_flush() ?>

    <?php echo '<pre>';
    print_r($tableRows);
    echo '</pre>';
    exit;
// change for changes sake
     ?>
