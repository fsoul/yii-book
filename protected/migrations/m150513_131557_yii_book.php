<?php

class m150513_131557_yii_book extends CDbMigration
{
	public function up()
	{
        $this->createTable('books',array(
            'id'            => 'pk',
            'title'         => 'varchar(255) NOT NULL',
            'poster_path'   => 'varchar(255) NOT NULL'
        ));

        $this->createTable('authors',array(
            'id'            => 'pk',
            'first_name'    => 'varchar(255) NOT NULL',
            'last_name'     => 'varchar(255) NOT NULL'
        ));

        $this->createTable('category',array(
            'id'    => 'pk',
            'title' => 'varchar(255) NOT NULL'
        ));

        $this->createTable('books_category',array(
            'id'            => 'pk',
            'book_id'       => 'int(10)',
            'category_id'   => 'int(10)',
        ));

        $this->createTable('books_authors',array(
            'id'          => 'pk',
            'book_id'     => 'int(10)',
            'author_id'   => 'int(10)',
        ));

        $this->addForeignKey('fk_books_category', 'books_category', 'book_id', 'books', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_books_authors', 'books_authors', 'book_id', 'books', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_category_books', 'books_category', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_authors_books', 'books_authors', 'author_id', 'authors', 'id', 'CASCADE', 'CASCADE');
    }

	public function down()
	{
		echo "m150513_131557_yii_book does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}