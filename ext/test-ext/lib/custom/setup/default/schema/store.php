<?php
return [
    'table' => [
        'mshop_store' => function ( \Doctrine\DBAL\Schema\Schema $schema ) {

            $table = $schema->createTable( 'mshop_store' );

            $table->addColumn( 'id', 'integer', ['autoincrement' => true] );
            $table->addColumn( 'siteid', 'integer', [] );
            $table->addColumn( 'country', 'string', ['length' => 50, 'notnull' => false] );
            $table->addColumn( 'address', 'string', ['length' => 255, 'notnull' => false] );
            $table->addColumn( 'turnover', 'integer', [] );
            $table->addColumn( 'mtime', 'datetime', [] );
            $table->addColumn( 'ctime', 'datetime', [] );
            $table->addColumn( 'editor', 'string', ['length' => 255] );

            $table->setPrimaryKey( ['id'],'pk_msattmy_id' );

            return $schema;
        },
    ]
];
