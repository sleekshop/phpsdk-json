<?php

namespace Sleekshop\Controller;

use Sleekshop\SleekshopRequest;

class WarehouseCtl
{

    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Creates a warehouse entity with the specified parameters.
     *
     * @param string $class The class type of the warehouse entity.
     * @param string $name The name of the warehouse entity.
     * @param int $id_manufacturer The manufacturer ID associated with the warehouse entity.
     * @param array $attributes Additional attributes for the warehouse entity.
     * @param array $metadata Metadata information for the warehouse entity.
     * @return array The response from the request to create a warehouse entity.
     */
    public function CreateWarehouseEntity(string $class = '', string $name = '', int $id_manufacturer = 0, array $attributes = [], array $metadata = []): array
    {
        return $this->request->create_warehouse_entity($class, $name, $id_manufacturer, $attributes, $metadata);
    }

    /**
     * Updates an existing warehouse entity with the provided details.
     *
     * @param int $id_warehouse_entity The ID of the warehouse entity to be updated.
     * @param string $name The new name for the warehouse entity.
     * @param int $id_manufacturer The ID of the manufacturer associated with the warehouse entity.
     * @param array $attributes An array of attributes for the warehouse entity.
     * @param array $metadata Additional metadata relevant to the warehouse entity.
     * @return array The updated warehouse entity details.
     */
    public function UpdateWarehouseEntity(int $id_warehouse_entity, string $name, int $id_manufacturer, array $attributes, array $metadata): array
    {
        return $this->request->update_warehouse_entity($id_warehouse_entity, $name, $id_manufacturer, $attributes, $metadata);
    }

    /**
     * Deletes a warehouse entity identified by the given ID.
     *
     * @param int $id_warehouse_entity The ID of the warehouse entity to be deleted.
     * @return array The result of the deletion operation.
     */
    public function DeleteWarehouseEntity(int $id_warehouse_entity): array
    {
        return $this->request->delete_warehouse_entity($id_warehouse_entity);
    }

    /**
     * Places inventory in the specified warehouse for a given product with the provided quantity.
     *
     * @param int $id_warehouse_entity The unique identifier of the warehouse entity.
     * @param int $id_product The unique identifier of the product.
     * @param int $quantity The quantity of the product to be placed in the inventory.
     * @return array The result of the inventory placement request.
     */
    public function InventoryPlace(int $id_warehouse_entity, int $id_product, int $quantity): array
    {
        return $this->request->inventory_place($id_warehouse_entity, $id_product, $quantity);
    }

    /**
     * Takes inventory from the specified storage for a given element with the provided quantity and note.
     *
     * @param string $storage The designated storage location from which the inventory will be taken.
     * @param string $element_number The unique identifier of the element to be taken from inventory.
     * @param int $quantity The quantity of the element to be taken from the inventory.
     * @param string $note An optional note regarding the inventory take action.
     * @return array The result of the inventory take request.
     */
    public function InventoryTake(string $storage = '', string $element_number = '', int $quantity = 0, string $note = ''): array
    {
        return $this->request->inventory_take($storage, $element_number, $quantity, $note);
    }

    /**
     * Adds a binding for a given product with the specified element number and quantity.
     *
     * @param int $id_product The unique identifier of the product. Default is 0.
     * @param string $element_number The element number to bind to the product. Default is an empty string.
     * @param int $quantity The quantity of the element to be bound. Default is 0.
     * @return array The result of the binding addition request.
     */
    public function AddBind(int $id_product = 0, string $element_number = '', int $quantity = 0): array
    {
        return $this->request->add_binding($id_product, $element_number, $quantity);
    }

    /**
     * Deletes the binding for a specified product and element number.
     *
     * @param int $id_product The unique identifier of the product. Default is 0.
     * @param string $element_number The element number associated with the binding to be deleted.
     * @return array The result of the delete binding request.
     */
    public function DeleteBinding(int $id_product = 0, string $element_number = ''): array
    {
        return $this->request->delete_binding($id_product, $element_number);
    }

}