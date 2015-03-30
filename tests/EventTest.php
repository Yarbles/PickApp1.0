<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Event.php";
    require_once "src/Category.php";
    require_once "src/User.php";

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    class EventTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Event::deleteAll();
            Category::deleteAll();
            User::deleteAll();
        }

        function test_getEvent()
        {
            //Arrange
            $event = "Baseball game";
            $id = 1;
            $test_event = new Event($event, $id);

            //Act
            $result = $test_event->getEventName();

            //Assert
            $this->assertEquals($event, $result);
        }

        function test_getId()
        {
            //Arrange
            $event = "Baseball game";
            $id = 1;
            $test_event = new Event($event, $id);

            //Act
            $result = $test_event->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            //Arrange
            $event = "Baseball game";
            $id = 1;
            $test_event = new Event($event, $id);
            $test_event->save();

            //Act
            $result = Event::getAll();

            //Assert
            $this->assertEquals($test_event, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $event = "Baseball game";
            $id = 1;
            $test_event = new Event($event, $id);
            $test_event->save();
            $event2 = "Bicycle ride";
            $id2 = 2;
            $test_event2 = new Event ($event2, $id2);
            $test_event2->save();

            //Act
            $result = Event::getAll();

            //Assert
            $this->assertEquals([$test_event, $test_event2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $event = "Baseball game";
            $id = 1;
            $test_event = new Event($event, $id);
            $test_event->save();
            $event2 = "Bicycle ride";
            $id2 = 2;
            $test_event2 = new Event ($event2, $id2);
            $test_event2->save();

            //Act
            Event::deleteAll();
            $result = Event::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $event = "Baseball game";
            $id = 1;
            $test_event = new Event($event, $id);
            $test_event->save();
            $event2 = "Bicycle ride";
            $id2 = 2;
            $test_event2 = new Event ($event2, $id2);
            $test_event2->save();

            //Act
            $result = Event::find($test_event->getId());

            //Assert
            $this->assertEquals($test_event, $result);
        }

        function test_updateEvent()
        {
            //Arrange
            $event = "Baseball game";
            $id = 1;
            $test_event = new Event($event, $id);
            $test_event->save();
            $new_event = "Softball game";

            //Act
            $test_event->updateEvent($new_event);

            //Assert
            $this->assertEquals("Softball game", $test_event->getEvent)
        }

        function test_deleteEvent()
        {
            //Arrange
            $event = "Baseball game";
            $id = null;
            $test_event = new Event($event, $id);
            $test_event->save();
            $event2 = "Bicycle ride";
            $id2 = null;
            $test_event2 = new Event ($event2, $id2);
            $test_event2->save();

            //Act
            $test_event->deleteEvent();
            $result = Event::getAll();

            //Assert
            $this->assertEquals([$test_event2], $result)
        }

        function test_addCategory()
        {
            //Arrange
            $event = "Baseball game";
            $id = null;
            $test_event = new Event($event, $id);
            $test_event->save();
            $category = new Category($category, $id2);
            $test_category->save();

            //Act
            $test_event->addCategory($test_category);

            //Assert
            $this->assertEquals($test_event->getCategory(), [$test_category]);
        }

        function test_getCategories()
        {
            //Arrange
            $event = "Baseball game";
            $id = null;
            $test_event = new Event($event, $id);
            $test_event->save();

        }
