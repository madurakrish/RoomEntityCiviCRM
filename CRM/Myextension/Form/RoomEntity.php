<?php

require_once 'CRM/Core/Form.php';
//require_once 'api/class.api.php';

/**
 * Form controller class
 *
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC43/QuickForm+Reference
 */
class CRM_Myextension_Form_RoomEntity extends CRM_Core_Form {

  function buildQuickForm() {
	//Add form elements
    $this->add(
      'text', // field type
      'room_label', // field name
      'Room Label', // field label
      $this->getRoomLabel(),
      true // is required
    ); 
    $this->add(
      'text', // field type
      'room_number', // field name
      'Room Number' // field label
    ); 
    $this->add(
      'text', // field type
      'room_floor', // field name
      'Room Floor' // field label
    ); 
    $this->add(
      'text', // field type
      'room_ext', // field name
      'Room Extension' // field label
    ); 
    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => ts('Submit'),
        'isDefault' => TRUE,
      ),
    ));

    //Export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  function postProcess() {  
	//Calling custom function to write to database
	$this->saveToDatabase ();	    
  }  
  
  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

  function getRoomLabel(){
	return;
  }

  //Custom function to write to database
  function saveToDatabase()  {
  
	//Database connection parameters
	$servername = "localhost";
	$username = "root";
	$password = "admin123";
	$dbname = "civicrm";
	
	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	//Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
    $values = $this->exportValues();

	$sql = "INSERT INTO civicrm_room (room_label, room_number, room_floor, room_ext)
	VALUES ('$values[room_label]', '$values[room_number]', '$values[room_floor]', '$values[room_ext]')";
	
	if ($conn->query($sql) === TRUE)
	{
		echo "Record saved successfully";
		}
	 else {
		echo "Save failed. Please try again";
	}	
	
	$conn->close();  
	return;
  }
}
