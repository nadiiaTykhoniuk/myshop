<?php

namespace Aimeos\MW\Setup\Task;

class TablesCreateStore extends TablesCreateMShop
{
    public function getPreDependencies() : array
    {
        return ['MShopCreateTables', 'MAdminCreateTables'];
    }

    public function getPostDependencies() : array
    {
        return [];
    }

    public function migrate()
    {
        $this->msg( 'Creating store tables', 0, '' );
        $ds = DIRECTORY_SEPARATOR;

        $files = [
            'db-store' => 'default' . $ds . 'schema' . $ds . 'store.php'
        ];
        $this->setupSchema( $files );
    }
}
