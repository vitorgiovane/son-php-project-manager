<?php

namespace Framework;

abstract class ResourcesController
{
  abstract protected function getModel(): string;

  public function index($container, $request)
  {
    return $container[$this->getModel()]->all();
  }

  public function show($container, $request)
  {
    $id = $request->attributes->get(1);
    $conditions = ["id" => $id];
    return $container[$this->getModel()]->get($conditions);
  }

  public function store($container, $request)
  {
    return $container[$this->getModel()]->create($request->request->all());
  }

  public function update($container, $request)
  {

    $id = $request->attributes->get(1);
    $conditions = ["id" => $id];

    return $container[$this->getModel()]->update($conditions, $request->request->all());
  }

  public function destroy($container, $request)
  {

    $id = $request->attributes->get(1);
    $conditions = ["id" => $id];

    return $container[$this->getModel()]->delete($conditions);
  }
}
