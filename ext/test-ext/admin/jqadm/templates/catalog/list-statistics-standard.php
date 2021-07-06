<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2021
 */

$enc = $this->encoder();

use Illuminate\Support\Facades\DB;
?>

<?php $this->block()->start( 'jqadm_content' ) ?>

    <?= $this->render( $this->config( 'admin/jqadm/partial/confirm', 'dashboard/list-statistics-standard' ) ) ?>

<?php $this->block()->stop() ?>

<?= $this->render( $this->config( 'admin/jqadm/template/page', 'common/page-standard' ) ) ?>
