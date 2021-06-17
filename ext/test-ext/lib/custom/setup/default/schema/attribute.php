<?php

//return [
//    'table' => [
//        'mshop_attribute_type' => function ( \Doctrine\DBAL\Schema\Schema $schema ) {
//
//            $table = $schema->getTable( 'mshop_attribute_type' );
//
//            $table->addColumn(  'value', 'string', ['length' => 255] );
//            $table->changeColumn(  'value', ['length' => 64] );
//            $table->dropColumn(  'value' );
//
//            $table->addIndex( ['value'],'idx_msattty_val' );
//            $table->dropIndex( 'unq_msattmy_sid_myval' );
//            $table->renameIndex( 'unq_msattmy_sid_myval', 'unq_msattmy_sid_myval_new' );
//
//            return $schema;
//        },
//    ]
//];
