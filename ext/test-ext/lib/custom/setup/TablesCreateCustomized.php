<?php

namespace Aimeos\MW\Setup\Task;

class TablesCreateCustomized extends TablesCreateMShop
{
    public function migrate()
    {
        $this->msg( 'Creating customized tables', 0, '' );
        $ds = DIRECTORY_SEPARATOR;

        $files = [
            'db-customized' => 'default' . $ds . 'schema' . $ds . 'customized.php'
        ];
        $this->setupSchema( $files );
    }
}
