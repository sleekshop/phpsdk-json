<?php

namespace Sleekshop\Controller;

use Sleekshop\SleekshopRequest;

class ClassCtl
{

    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Retrieves details for a specific class.
     *
     * @param int $id_class The ID of the class to retrieve details for. Defaults to 0.
     * @return array An associative array containing the class details.
     */
    public function GetClassDetails(int $id_class = 0): array
    {
        return $this->request->get_class_details($id_class);
    }

    /**
     * Retrieves all classes.
     *
     * @param string $name The name of the class to create. Defaults to an empty string.
     * @param string $type The type of the class to create. Defaults to an empty string.
     * @return array An associative array containing all classes.
     */
    public function CreateClass(string $name = "", string $type = ""): array
    {
        return $this->request->create_class($name, $type);
    }

    /**
     * Deletes a specific class.
     *
     * @param int $id_class The ID of the class to be deleted. Defaults to 0.
     * @return array An associative array containing the result of the deletion operation.
     */
    public function DeleteClass(int $id_class = 0): array
    {
        return $this->request->delete_class($id_class);
    }

    /**
     * Creates attributes for a specific class.
     *
     * @param int $id_class The ID of the class for which to create attributes. Defaults to 0.
     * @param array $attributes An array of attributes
     */
    public function CreateClassAttributes(int $id_class = 0, array $attributes = []): array
    {
        return $this->request->create_class_attributes($id_class, $attributes);
    }

    /**
     * Deletes specified attributes from a given class.
     *
     * @param int $id_class The ID of the class from which the attributes will be deleted. Defaults to 0.
     * @param array $attributes An array of attribute names to be deleted from the class.
     * @return array An associative array containing the status of the deletion operation.
     */
    public function DeleteClassAttributes(int $id_class = 0, array $attributes = []): array
    {
        return $this->request->delete_class_attributes($id_class, $attributes);
    }

}