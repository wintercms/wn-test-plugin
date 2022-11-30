<?php namespace Winter\Test\Components;

use Request;

use Cms\Classes\ComponentBase;

class TestInspector extends ComponentBase
{
    /**
     * Gets the details for the component
     */
    public function componentDetails()
    {
        return [
            'name'        => 'TestInspector Component',
            'description' => 'No description provided yet...'
        ];
    }

    /**
     * Returns the properties provided by the component
     */
    public function defineProperties()
    {
        return [
            "refDropdown" => [
                "type"        => "dropdown",
                "title"       => "Reference Dropdown",
                "emptyOption" => "-- Select an option --",
                "showExternalParam" => false,
            ],
            "testObject" => [
                "type" => "object",
                "title" => "Object Test",
                "properties" => [
                    [
                        "property" => "sub",
                        "type" => "dropdown",
                        "title" => "TestObject Sub property",
                        "depends" => ['refDropdown'],
                    ],
                ],
            ],      
            "testObjectList" => [
                "type" => "objectList",
                "title" => "ObjectList Test",                                                                                      
                "titleProperty" => "sub",
                "itemProperties" => [
                    [
                        "property" => "sub",
                        "type" => "dropdown",
                        "title" => "TestObjectList Sub property",
                        "depends" => ['refDropdown'],
                    ],
                ],
            ],
        ];
    }

    public function getTestObjectSubOptions()
    {       
        $slug = Request::input('refDropdown');
        $values = [
            'value1' => [
                'value1.Option1',
                'value1.Option2',
                'value1.Option3',
            ],
            'value2' => [
                'value2.Option1',
                'value2.Option2',
                'value2.Option3',
            ],
            'value3' => [
                'value3.Option1',
                'value3.Option2',
                'value3.Option3',
            ],
        ];
        if ($slug) {
            return $values[$slug];
        } else {
            return [];
        }
    }           

    public function getTestObjectListSubOptions()
    {           
        return $this->getTestObjectSubOptions();
    }           

    public function getRefDropdownOptions()
    {           
        return [
            'value1' => 'Value 1',
            'value2' => 'Value 2',
            'value3' => 'Value 3',
        ];
    }                   
}
