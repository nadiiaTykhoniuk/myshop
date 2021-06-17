<?php
//
//return [
//    'table' => [
//        'mshop_attribute_mytable' => function ( \Doctrine\DBAL\Schema\Schema $schema ) {
//
//            $table = $schema->createTable( 'mshop_attribute_mytable' );
//
//            $table->addColumn( 'id', 'integer', ['autoincrement' => true] );
//            $table->addColumn( 'siteid', 'integer', [] );
//            $table->addColumn( 'myvalue', 'string', ['length' => 255, 'notnull' => false] );
//            $table->addColumn( 'mtime', 'datetime', [] );
//            $table->addColumn( 'ctime', 'datetime', [] );
//            $table->addColumn( 'editor', 'string', ['length' => 255] );
//
//            $table->setPrimaryKey( ['id'],'pk_msattmy_id' );
//            $table->addUniqueIndex( ['siteid', 'myvalue'],'unq_msattmy_sid_myval' );
//
//            return $schema;
//        },
//    ]
//
//];
