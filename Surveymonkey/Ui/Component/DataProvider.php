<?php


namespace Wagento\Surveymonkey\Ui\Component;


use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;

class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider {

    private $surveys;

    public function __construct
    (
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        \Wagento\Surveymonkey\Helper\Surveys $surveys,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct(
                $name,
                $primaryFieldName,
                $requestFieldName,
                $reporting,
                $searchCriteriaBuilder,
                $request,
                $filterBuilder,
                $meta,
                $data
        );
        $this->surveys = $surveys;
    }

    public function getData()
    {
        return [];
    }

    private function getSorting($surveys, $sorting) {

    }
}