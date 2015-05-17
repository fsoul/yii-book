<?php

/**
 * This is the model class for table "books".
 *
 * The followings are the available columns in table 'books':
 * @property integer $id
 * @property string $title
 * @property string $poster_path
 *
 * The followings are the available model relations:
 * @property BooksAuthors[] $booksAuthors
 * @property BooksCategory[] $booksCategories
 */
class Books extends CActiveRecord
{
    public $cat_title;
    public $authors;
    public $checked;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'books';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'required'),
            array('title, poster_path', 'length', 'max' => 255),
            array('poster_path', 'file', 'types' => 'jpg, gif, png'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, poster_path, checked', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'booksAuthors' => array(self::HAS_MANY, 'BooksAuthors', 'book_id'),
            'booksCategories' => array(self::HAS_MANY, 'BooksCategory', 'book_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'poster_path' => 'Poster Path',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('poster_path', $this->poster_path, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Books the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function arr2str($arr, $id)
    {
        foreach ($arr as $item) {
            $value[] = '(' . $id . ',' . $item . ')';
        }
        $res = implode(',', $value);

        return $res;
    }

    protected function afterSave()
    {
        parent::afterSave();

        if (!$this->isNewRecord) {
            BooksCategory::model()->deleteAll(array(
                'condition' => 'book_id=:book_id',
                'params' => array(':book_id' => $this->id),
            ));
            BooksAuthors::model()->deleteAll(array(
                'condition' => 'book_id=:book_id',
                'params' => array(':book_id' => $this->id),
            ));
        }

        $cat_values = $this->arr2str($this->cat_title, $this->id);
        $auth_values = $this->arr2str($this->authors, $this->id);

        $connection = Yii::app()->db;

        $sql1 = "INSERT INTO books_category(book_id, category_id) VALUES" . $cat_values;
        $sql2 = "INSERT INTO books_authors(book_id, author_id) VALUES" . $auth_values;

        $transaction = $connection->beginTransaction();
        try {
            $connection->createCommand($sql1)->execute();
            $connection->createCommand($sql2)->execute();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
        }
    }
}
