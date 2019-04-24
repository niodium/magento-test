<?php

namespace Dev\TodoList\Ui\Component\Listing\Column;

class PageActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource["data"]["items"])) {
            foreach ($dataSource["data"]["items"] as & $item) {
                $name = $this->getData("name");
                $id = "X";
                if(isset($item["todo_id"]))
                {
                    $id = $item["todo_id"];
                }
                $item[$name]["view"] = [
                    "href"=>$this->getContext()->getUrl(
                        "todolist/item/edit",["todo_id"=>$id]),
                    "label"=>__("Edit")
                ];
            }
        }

        return $dataSource;
    }

}
