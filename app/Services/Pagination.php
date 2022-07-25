<?php

namespace app\Services;


class Pagination{

    private $currentPage = 1;
    private $countOfPages = 1;
    private $countOfEntities = 0;
    private $recordsOnPage;

    public function __construct($countOfEntities = 0, $recordsOnPage = 8)
    {
        $this->countOfEntities = $countOfEntities;
        $this->recordsOnPage = $recordsOnPage;
    }

    public function getCountOfPages(){
        $this->countOfPages = ceil($this->countOfEntities / $this->recordsOnPage);
        return $this->countOfPages;
    }

    public function getCurrentPage(){
        if ((isset($_GET['page'])) && (is_numeric($_GET['page'])) && ($_GET['page'] > 0) && ($_GET['page'] <= $this->getcountOfPages())) {
            $this->currentPage = $_GET['page'];
        }
        return $this->currentPage;
    }

    public function getOffset(){
        return ($this->currentPage - 1) * $this->recordsOnPage;
    }

    public function getRecodsOnPage(){
        return $this->recordsOnPage;
    }

}